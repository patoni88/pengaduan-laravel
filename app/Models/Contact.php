<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $table = "block";
    protected $fillable = [
        // kolom lain yang dapat diisi massal,
        'kontak',

    ];
}
