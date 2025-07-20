<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tanaman extends Model
{
    use HasFactory;

    protected $table = 'tanamans';
    protected $fillable = ['nama', 'deskripsi', 'gambar'];
}

