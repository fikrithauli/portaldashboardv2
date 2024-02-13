<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'user_id', 'dashboard_id',
        // Tambahkan field lain yang diperlukan untuk permissions
    ];

    // Definisikan relasi dengan User dan Dashboard jika diperlukan
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dashboard()
    {
        return $this->belongsTo(Dashboard::class);
    }
}
