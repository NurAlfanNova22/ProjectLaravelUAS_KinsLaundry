<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pesanan extends Model
{
    use HasFactory;

    protected $fillable = ['nama_pelanggan', 'email_pelanggan', 'jenis_laundry', 'berat', 'total_harga', 'tanggal_pesanan', 'status'];
}