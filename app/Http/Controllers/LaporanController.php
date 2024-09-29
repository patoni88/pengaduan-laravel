<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
    
        // Mengambil data pengaduan berdasarkan filter bulan dan tahun
        $query = DB::table('pengaduans')
            ->join('feedback', 'pengaduans.id', '=', 'feedback.id')
            ->orderBy('pengaduans.id', 'desc')
            ->where(function ($query) use ($bulan, $tahun) {
                if ($bulan) {
                    $query->whereMonth('feedback.updated_at', $bulan);
                }
                if ($tahun) {
                    $query->whereYear('feedback.updated_at', $tahun);
                }
            })
            ->where(function ($query) {
                $query->where('feedback.status', 'finished');
            });
    
        $data = $query->paginate(10)->onEachSide(2)->fragment('pengaduan');
    
        return view('laporan.index', compact('data', 'bulan', 'tahun'));
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
