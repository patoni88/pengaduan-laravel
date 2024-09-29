<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use View;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Menampilkan semua data
        $data = DB::table('users')
        ->orderBy('users.id', 'asc')
        ->paginate(20)
        ->fragment('pengaduan');

        return view('users.index')->with('data', $data); // Mengirimkan data pengguna ke tampilan
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
        // Validate the user input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create a new user record
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        return redirect()->route('users.index')->with('success', 'Data pengguna berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi request jika diperlukan

        // Temukan user berdasarkan ID
        $user = User::findOrFail($id);

        // Lakukan perubahan status user
        if ($user->status == 'active') {
            $user->status = 'inactive';
        } else {
            $user->status = 'active';
        }

        // Simpan perubahan ke database
        $user->save();

        // Redirect atau berikan respon sesuai kebutuhan aplikasi Anda
        // Contoh: Redirect kembali ke halaman sebelumnya
        return redirect()->back()->with('warning', 'Status user berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id); // Menemukan data pengguna berdasarkan ID atau lemparkan exception jika tidak ditemukan
        $user->delete(); // Menghapus data pengguna

        return redirect()->route('users.index')->with('error', 'Data pengguna berhasil dihapus');
    }
}
