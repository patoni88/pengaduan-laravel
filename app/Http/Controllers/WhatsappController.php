<?php

namespace App\Http\Controllers;

use App\Models\WhatsApp;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class WhatsAppController extends Controller
{
    public function index(Request $request)
    {
        $data = '1234123412341234';
        
        $qrcode = QrCode::size(300)->generate($data);

        return view('whatsapp.index', compact('qrcode'));
        // // Inisialisasi klien Guzzle
        // $client = new Client();

        // // Lakukan permintaan GET ke endpoint '/whatsapp'
        // $response = $client->get('http://localhost:8000');

        // // Periksa kode status permintaan
        // if ($response->getStatusCode() === 200) {
        //     // Baca dan dekodekan data JSON dari respons
        //     $data = json_decode($response->getBody(), true);

        //     // Ambil nilai qr dari data
        //     $qrCode = $data['qr'];

        //     // Kirim nilai qrCode ke halaman view
        //     return view('whatsapp.index', compact('qrCode'));
        // }

        // // Penanganan kasus ketika permintaan gagal atau tidak berhasil
        // // Misalnya, tampilkan pesan error atau halaman fallback

        // return view('whatsapp.error');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(whatsapp $whatsapp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(whatsapp $whatsapp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, whatsapp $whatsapp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(whatsapp $whatsapp)
    {
        //
    }
}
