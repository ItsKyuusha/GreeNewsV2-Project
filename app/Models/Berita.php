<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Berita extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul', 'isi', 'gambar', 'publisher', 'tanggal', 'published'
    ];

    // Menambahkan properti $dates
    protected $dates = ['tanggal'];
}
