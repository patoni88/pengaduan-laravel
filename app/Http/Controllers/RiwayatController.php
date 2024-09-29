<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pengaduan;

class RiwayatController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $filter = $request->query('filter');
    
        $query = DB::table('pengaduans')
            ->join('feedback', 'pengaduans.id', '=', 'feedback.id')
            ->select('pengaduans.*', 'feedback.status')
            ->orderBy('pengaduans.id', 'desc')
            ->where('feedback.status', '=', 'finished')
            ->orWhere('feedback.status', '=', 'rejected');
    
        if (!empty($search)) {
            $query->where(function ($innerQuery) use ($search) {
                $innerQuery->where('pengaduans.nomor', 'like', '%'.$search.'%')
                    ->orWhere('pengaduans.kontak', 'like', '%'.$search.'%')
                    ->orWhere('pengaduans.nama', 'like', '%'.$search.'%')
                    ->orWhere('feedback.status', 'like', '%'.$search.'%');
            });
        }

        if (!empty($filter)) {
            $query->where('feedback.status', $filter);
        }
    
        $data = $query->paginate(10)->onEachSide(2)->fragment('pengaduan');
    
        return view('riwayat.index')->with([
            'data' => $data,
            'search' => $search,
            'filter' => $filter
        ]);
    }
}
