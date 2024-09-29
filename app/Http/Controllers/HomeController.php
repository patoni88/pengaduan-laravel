<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Feedback;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $filter = $request->query('filter');

        $waitingCount = Feedback::where('status', 'waiting')->count();
        $approvedCount = Feedback::where('status', 'approved')->count();
        $pendingCount = Feedback::where('status', 'pending')->count();
        $rejectedCount = Feedback::where('status', 'rejected')->count();
        $finishedCount = Feedback::where('status', 'finished')->count();
        $processCount = Feedback::where('status', 'process')->count();

        $query = DB::table('pengaduans')
        ->join('feedback', 'pengaduans.id', '=', 'feedback.id')
        ->select('pengaduans.*', 'feedback.status')
        ->orderBy('pengaduans.id', 'asc');
        // ->where('feedback.status', '!=', 'finished')
        // ->Where('feedback.status', '!=', 'rejected')
        // ->paginate(10)
        // ->onEachSide(1)
        // ->fragment('pengaduan');

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

        $data = $query->paginate(10)->onEachSide(1)->fragment('pengaduan');

        return view('dashboard', compact('data', 'waitingCount', 'approvedCount', 'rejectedCount', 'pendingCount', 'finishedCount', 'processCount', 'search', 'filter'));
        // return view('dashboard')->with('data', $data,);
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
