<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = "pengaduans";
    protected $guarded = ['id'];
    protected $fillable = [
        // kolom lain yang dapat diisi massal,
        'nomor',
        'kontak',
        'nama',
        'deskripsi',
        'lokasi',
        'gambar,'
    ];

    public function feedback(): HasOne
    {
        return $this->hasOne(Feedback::class);
    }
}
