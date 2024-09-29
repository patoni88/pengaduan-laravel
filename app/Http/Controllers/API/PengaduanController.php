<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $now = Carbon::now();
        $tahun = $now->format('Y');

        // Ambil nomor urut terakhir untuk tahun saat ini
        $nomorUrutTerakhir = Pengaduan::whereYear('created_at', $tahun)->count();

        // Buat nomor surat baru dengan format "Tahun/NomorUrut"
        $nomorSuratBaru = 'SP/DMPT' . '/' . $tahun . '/' . str_pad($nomorUrutTerakhir + 1, 3, '0', STR_PAD_LEFT);

        $kontak = $request->input('kontak');

        // Memeriksa dan mengubah format nomor telepon
        if (substr($kontak, 0, 2) == '62') {
            $kontak = '0' . substr($kontak, 2);
        }

        if (strpos($kontak, '@c.us') !== false) {
            $kontak = str_replace('@c.us', '', $kontak);
        }

        // Validasi request jika diperlukan

        // Simpan data pengaduan
        $pengaduan = new Pengaduan();
        $pengaduan->nomor = $nomorSuratBaru;
        $pengaduan->kontak = $kontak;
        $pengaduan->nama = $request->input('nama');
        $pengaduan->alamatTinggal = $request->input('alamatTinggal');
        $pengaduan->deskripsi = $request->input('deskripsi');
        $pengaduan->lokasi = $request->input('lokasi');
        $pengaduan->gambar1 = $request->input('gambar1');
        $pengaduan->gambar2 = $request->input('gambar2');
        $pengaduan->gambar3 = $request->input('gambar3');

        // Simpan gambar (gambar)
        // if ($request->hasFile('gambar')) {
        //     $gambar = $request->file('gambar');
        //     $gambarPath = $gambar->store('gambar', 'public');
        //     $pengaduan->gambar = $gambarPath;
        // }

        $pengaduan->save();

        // Simpan data feedback
        $feedback = new Feedback();
        $feedback->id = $pengaduan->id;
        $feedback->status = 'waiting';
        $feedback->save();

        // Berikan respon sesuai kebutuhan aplikasi Anda
        return response()->json(['message' => 'Pengaduan berhasil disimpan'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
