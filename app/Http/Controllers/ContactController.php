<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use View;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        //Menampilkan semua data
        $query = DB::table('block')
        ->orderBy('block.id', 'asc');

        if (!empty($search)) {
            $query->where(function ($innerQuery) use ($search) {
                $innerQuery->where('block.kontak', 'like', '%'.$search.'%')
                    ->orWhere('block.nama', 'like', '%'.$search.'%');
            });
        }

        $data = $query->paginate(10)->onEachSide(2)->fragment('pengaduan');

        // Mengirimkan data pengguna ke tampilan
        return view('contact.index')->with([
            'data' => $data,
            'search' => $search
        ]);
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
        $request->validate([
            'kontak' => 'required',
            'nama' => 'required',
            // validasi atribut lain yang diperlukan
        ]);

        $kontak = $request->input('kontak');
        $nama = $request->input('nama');
    
        $blockedContact = new Contact();
        $blockedContact->kontak = $kontak;
        $blockedContact->nama = $nama;
    
        // // Modifikasi nomor kontak jika berawalan 0
        // if (substr($kontak, 0, 1) === '0') {
        //     $kontak = '62' . substr($kontak, 1);
        // }
    
        // // Tambahkan karakter '@c.us' pada akhir kontak
        // $kontak .= '@c.us';
    
        // Cek apakah kontak sudah ada dalam database
        $existingContact = Contact::where('kontak', $kontak)->first();
        if ($existingContact) {
            return redirect()->back()->with('error', 'Kontak sudah ter-blokir.');
        }

        // Simpan entitas ke database
        $blockedContact->save();

    
        // Contact::create([
        //     'kontak' => $kontak,
        //     'nama' => $request->input('nama'),
        //     // atribut lain yang diperlukan
        // ]);
    
        return redirect()->back()->with('success', 'Kontak berhasil ditambahkan.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id); // Menemukan data kontak berdasarkan ID atau lemparkan exception jika tidak ditemukan
        $contact->delete(); // Menghapus data kontak
    
        return redirect()->back()->with('error', 'Kontak berhasil dihapus.');
    }
}
