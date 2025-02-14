<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Exception;

use App\Models\User;

class MicrosoftController extends Controller
{
    private $clientId;
    private $clientSecret;
    private $redirectUri;
    private $authorityUrl;
    private $resource;

    public function __construct()
    {
        $this->clientId = env('MICROSOFT_CLIENT_ID');
        $this->clientSecret = env('MICROSOFT_CLIENT_SECRET');
        $this->redirectUri = env('MICROSOFT_REDIRECT_URI');
        $this->authorityUrl = env('MICROSOFT_AUTHORITY');
        $this->resource = env('MICROSOFT_RESOURCE');
    }

    public function index()
    {
        $state = bin2hex(random_bytes(16)); // Generate state parameter untuk keamanan
        Session::put('auth_state', $state);

        $authUrl = $this->authorityUrl . '/oauth2/v2.0/authorize?' . http_build_query([
            'client_id' => $this->clientId,
            'response_type' => 'code',
            'redirect_uri' => $this->redirectUri,
            'response_mode' => 'query',
            'scope' => 'openid User.Read email profile offline_access',
            'state' => $state,
        ]);

        return redirect($authUrl);
    }

    public function authorized(Request $request)
    {
        $code = $request->query('code');
        $state = $request->query('state');

        if ($state !== Session::get('auth_state')) {
            return redirect('/login')->with('error', 'Invalid state parameter');
        }

        try {
            $response = Http::asForm()->post($this->authorityUrl . '/oauth2/v2.0/token', [
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
                'grant_type' => 'authorization_code',
                'redirect_uri' => $this->redirectUri,
                'code' => $code,
            ]);

            $tokenData = $response->json();

            $userResponse = Http::withHeaders([
                'Authorization' => 'Bearer ' . $tokenData['access_token'],
            ])->get($this->resource . 'v1.0/me');

            $userData = $userResponse->json();

            $givenName = $userData['givenName'] ?? null;
            $microsoftID = $userData['id'] ?? null;
            $jobTitle = $userData['jobTitle'] ?? null;
            $mail = $userData['mail'] ?? null;

            // Cek apakah user sudah ada di database
            $user = User::where('microsoft_id', $microsoftID)->first();

            if (!$user) {
                // Jika belum ada, buat user baru dengan password MD5
                $user = User::create([
                    'name' => $givenName,
                    'email' => $mail,
                    'password' => md5('123'), // Gunakan MD5
                    'microsoft_id' => $microsoftID,
                    'job_title' => $jobTitle,
                    'role_id' => 2, // Default role
                ]);
            } else {
                // Jika user sudah ada, hanya update updated_at
                $user->touch();
            }

            // Catat setiap login ke tabel detail_logins
            DB::table('detail_logins')->insert([
                'user_id' => $user->id,
                'last_login_ip' => $request->ip(),
                'last_login_browser' => 'Chrome on Windows', // Bisa diambil dari User-Agent jika perlu
                'last_login_location' => 'Indonesia', // Bisa pakai API geolocation jika perlu
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            // Login user dengan Laravel Authentication
            Auth::login($user);

            return redirect('/home')->with('success', "Welcome, {$givenName}!");
        } catch (Exception $e) {
            return redirect('/login')->with('error', 'Error while fetching access token or user data');
        }
    }
}
