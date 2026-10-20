<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'jumlah',
        'tanggal',
        'keterangan',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}