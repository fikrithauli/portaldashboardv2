<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;

use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::check() && Auth::user()->role_id != 1) {
                return redirect()->route('login');
            }

            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $user = Auth::user();

        // Pengecekan apakah pengguna memiliki sesi dan role yang sesuai
        if (!$user || !$user->role_id) {
            return redirect()->route('login');
        }

        // Lakukan pengambilan data hanya jika role_id adalah 1
        if ($user->role_id == 1) {
            $dashboards = DB::table('dashboards')
                ->select('dashboards.*', DB::raw('COUNT(broadcasts.dashboards_id) as total_recipient'))
                ->leftJoin('broadcasts', 'dashboards.id', '=', 'broadcasts.dashboards_id')
                ->groupBy('dashboards.id')
                ->orderByDesc('dashboards.id')
                ->get();

            $recipients = DB::table('recipients')
                ->select(
                    'recipients.id AS recipient_id',
                    'recipients.name AS recipient_name',
                    'recipients.email',
                    'recipients.job_title',
                    DB::raw('(SELECT COUNT(*) FROM broadcasts WHERE broadcasts.recipients_id = recipients.id) AS total_dashboards')
                )
                ->orderBy('recipients.id')
                ->get();



            $activeRecipientCount = DB::table('recipients')
                ->where('is_active', 'yes')
                ->count();

            $activeDashboardsCount = DB::table('dashboards')
                ->where('is_active', 'yes')
                ->count();

            return view('user-management.overview', compact('user', 'dashboards', 'recipients', 'activeRecipientCount', 'activeDashboardsCount'));
        } else {
            return redirect()->route('login'); // Pengguna dengan role_id bukan 1 akan diarahkan ke halaman login
        }
    }


    public function add_recepient(Request $request)
    {
        $user = Auth::user();

        $dashboards = DB::table('dashboards')
            ->select('id', 'name') // Ganti dengan kolom yang sesuai
            ->orderBy('id')
            ->get();

        $recipients = DB::table('recipients')
            ->select('id', 'email') // Ganti dengan kolom yang sesuai
            ->orderBy('id')
            ->get();

        return view('user-management.recepient_add', compact('user', 'dashboards', 'recipients'));
    }

    public function searchRecipientDetails(Request $request)
    {
        $recipientId = $request->input('recipient_id');

        $recipient = DB::table('recipients')
            ->where('id', $recipientId)
            ->first();

        return response()->json(['success' => true, 'results' => $recipient]);
    }

    public function showRecipientDashboards($recipient_id)
    {
        $user = Auth::user();

        $recipient = DB::table('recipients')->find($recipient_id);

        if (!$recipient) {
            abort(404); // Tampilkan halaman 404 jika penerima tidak ditemukan
        }

        $dashboards = DB::table('dashboards')
            ->select('recipients.name AS recipient_name', 'broadcasts.dashboards_id', 'recipients.email', 'dashboards.id', 'dashboards.name AS dashboard_name', 'broadcasts.created_at AS created_time', 'broadcasts.is_active', 'broadcasts.recipients_id')
            ->join('broadcasts', 'dashboards.id', '=', 'broadcasts.dashboards_id')
            ->join('recipients', 'broadcasts.recipients_id', '=', 'recipients.id')
            ->where('broadcasts.recipients_id', $recipient_id)
            ->get();

        // Query tambahan untuk mendapatkan nama penerima
        $recipientName = DB::table('recipients')
            ->where('id', $recipient_id)
            ->value('email');

        $recipientsId  = DB::table('broadcasts')
            ->where('recipients_id', $recipient_id)
            ->value('recipients_id');

        return view('user-management.recipient_dashboards', compact('recipientsId', 'recipientName', 'recipient', 'dashboards', 'user'));
    }

    public function showRecipients($id)
    {
        $dashboard = DB::table('dashboards')->find($id);

        if (!$dashboard) {
            abort(404);
        }

        $recipients = DB::table('broadcasts')
            ->where('broadcasts.dashboards_id', $id)
            ->join('recipients', 'recipients.id', '=', 'broadcasts.recipients_id')
            ->join('dashboards', 'dashboards.id', '=', 'broadcasts.dashboards_id')
            ->select('recipients.name AS recipient_name', 'recipients.job_title', 'dashboards.name AS dashboard_name', 'broadcasts.created_at AS broadcast_time', 'recipients.email', 'broadcasts.flag', 'broadcasts.id', 'broadcasts.is_active')
            ->addSelect('broadcasts.recipients_id') // Tambahkan recipients_id ke select
            ->get();

        // Query tambahan untuk mendapatkan nama penerima
        $dashboardName = DB::table('dashboards')
            ->where('id', $id)
            ->value('name');

        // Query tambahan untuk mendapatkan id dashboard
        $dashboardID = DB::table('dashboards')
            ->where('id', $id)
            ->value('id');

        // Query tambahan untuk mendapatkan recipients_id
        $recipientsId = DB::table('broadcasts')
            ->where('dashboards_id', $id)
            ->value('recipients_id');

        return view('user-management.recipients', compact('recipientsId', 'dashboardID', 'dashboardName', 'dashboard', 'recipients'));
    }


    public function changeStatus(Request $request, $id)
    {
        $isActive = $request->input('isActive');

        try {
            DB::table('broadcasts')
                ->where('id', $id)
                ->update(['is_active' => $isActive]);

            return response()->json(['message' => 'Status updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error updating status'], 500);
        }
    }

    public function updateStatus($dashboardId, $recipientsId)
    {
        $newIsActive = request('isActive');

        // Gunakan Query Builder untuk mengubah is_active berdasarkan dashboardId dan recipientsId
        DB::table('broadcasts')
            ->where('dashboards_id', $dashboardId)
            ->where('recipients_id', $recipientsId)
            ->update(['is_active' => $newIsActive]);

        return response()->json(['message' => 'Status updated successfully']);
    }




    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'          => 'required|max:255',
            'email'         => 'required|max:255',
            'job_title'     => 'required|max:255',
            'flag'          => 'required|in:to,cc,bcc',
        ]);

        $existingRecipient = DB::table('recipients')
            ->where('email', $validatedData['email'])
            ->first();

        if (!$existingRecipient) {
            $recipientId = DB::table('recipients')->insertGetId([
                'name'      => $validatedData['name'],
                'email'     => $validatedData['email'],
                'job_title' => $validatedData['job_title'],
                'is_active' => $request->has('is_active') ? 'yes' : 'no',
            ]);

            return redirect()->route('add-recipient')->with('success', 'Recipient registered successfully.');
        } else {
            $recipientId = $existingRecipient->id;
        }

        if (!empty($request->input('dashboards'))) {
            foreach ($request->input('dashboards') as $dashboardId) {
                // Check if the combination of dashboardId and recipientId already exists
                $existingBroadcast = DB::table('broadcasts')
                    ->where('dashboards_id', $dashboardId)
                    ->where('recipients_id', $recipientId)
                    ->first();

                if (!$existingBroadcast) {
                    DB::table('broadcasts')->insert([
                        'dashboards_id' => $dashboardId,
                        'recipients_id' => $recipientId,
                        'flag'         => $validatedData['flag'],
                        'is_active'    => 'yes',
                    ]);
                } else {
                    // Set flash data to inform the user about the duplicate entry
                    return redirect()->route('add-recipient')->with('error', 'Duplicate entry for dashboard and recipient.');
                }
            }
        }

        return redirect()->route('user-management')->with('success', 'Data added successfully');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:2048',
        ]);

        if ($request->hasFile('file')) {
            try {
                $filePath = $request->file('file')->getRealPath();
                $spreadsheet = IOFactory::load($filePath);
                $worksheet = $spreadsheet->getActiveSheet();

                $startRow = 2;

                foreach ($worksheet->getRowIterator($startRow) as $row) {
                    $cellIterator = $row->getCellIterator();
                    $cellIterator->setIterateOnlyExistingCells(false);

                    $rowData = [];
                    foreach ($cellIterator as $cell) {
                        $rowData[] = $cell->getValue();
                    }

                    if (!empty($rowData)) {
                        $dashboardNames = explode(',', $rowData[3]);
                        $validDashboardIds = DB::table('dashboards')
                            ->whereIn('name', $dashboardNames)
                            ->pluck('id')
                            ->toArray();

                        if (count($validDashboardIds) == count($dashboardNames)) {
                            // All dashboard names are valid, proceed with insertion

                            $recipientId = DB::table('recipients')->insertGetId([
                                'name' => $rowData[0],
                                'email' => $rowData[1],
                                'job_title' => $rowData[2],
                                'is_active' => 'yes',
                                'created_at' => now(),
                            ]);

                            $flag = $rowData[4]; // Ambil nilai Flag dari kolom E

                            foreach ($validDashboardIds as $dashboardId) {
                                // Check if the combination of recipient and dashboard already exists
                                $existingBroadcast = DB::table('broadcasts')
                                    ->where('recipients_id', $recipientId)
                                    ->where('dashboards_id', $dashboardId)
                                    ->first();

                                if (!$existingBroadcast) {
                                    DB::table('broadcasts')->insert([
                                        'dashboards_id' => $dashboardId,
                                        'recipients_id' => $recipientId,
                                        'flag' => $flag,
                                        'is_active' => 'yes',
                                        'created_at' => now(),
                                    ]);
                                }
                            }
                        } else {
                            return redirect()->route('add-recipient')->with('error', 'The upload process is not permitted, please double check the data you uploaded!');
                        }
                    }
                }

                return redirect()->route('user-management')->with('success', 'Recipients uploaded successfully');
            } catch (\Exception $e) {
                return redirect()->route('user-management')->with('error', 'Failed to upload recipients');
            }
        }

        return redirect()->route('user-management')->with('error', 'Failed to upload recipients');
    }





    public function add_dashboards(Request $request)
    {
        $user = Auth::user();

        return view('user-management.dashboards_add', compact('user'));
    }

    public function storeDashboards(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'name'          => 'required|max:255',
            'category'      => 'required',
            'description'    => 'required',
            'pic'           => 'required',
        ]);

        // Menggunakan query builder untuk menyimpan data categories baru
        DB::table('dashboards')->insert([
            'name'          => $validatedData['name'],
            'category'      => $validatedData['category'],
            'is_active'     => 'yes',
            'description'    => $validatedData['description'],
            'pic'           => $validatedData['pic'],
        ]);

        // Redirect atau berikan respons sesuai kebutuhan
        return redirect()->route('user-management')->with('success', 'Dashboards added successfully');
    }
}
