<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'jenis_laporan',
        'periode_awal',
        'periode_akhir',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
