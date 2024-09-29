<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;
// use Barryvdh\DomPDF\Facade\Pdf as PDF;
use PDF;

class PengaduanController extends Controller
{
    private $_client;

    public function __construct()
    {
        $this->_client = new Client([
            'base_uri' => 'http://localhost:8000/send-message/'
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $filter = $request->query('filter');
    
        $query = DB::table('pengaduans')
            ->join('feedback', 'pengaduans.id', '=', 'feedback.id')
            // ->select('pengaduans.*', 'feedback.status')
            ->orderBy('pengaduans.id', 'asc')
            ->where('feedback.status', '!=', 'finished')
            ->where('feedback.status', '!=', 'rejected');
    
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
    
        return view('pengaduan.index')->with([
            'data' => $data,
            'search' => $search,
            'filter' => $filter
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = DB::table('feedback')
            ->join('users', 'users.id', '=', 'feedback.update_user_by_id') // Join dengan tabel users
            ->select('users.name')
            ->first();

        $data = DB::table('pengaduans')
            ->join('feedback', 'pengaduans.id', '=', 'feedback.id')
            ->select('pengaduans.*', 'feedback.*')
            ->where('pengaduans.id', $id)
            ->first();
        
        $id = $data->nomor;
        $html = view('pengaduan.print', compact('data', 'user'))->render();
        $dompdf = PDF::loadHTML($html);
        $dompdf->setPaper('A4', 'portrait');
        $fileName = 'PENGADUAN ' . $id . '.pdf'; // Ganti dengan nama file yang diinginkan
        return $dompdf->download($fileName);

        // 
        // $html = view('pengaduan.print', compact('data', 'user'))->render();
        // $dompdf = new Dompdf();
        // $dompdf->loadHtml($html);
        // $dompdf->setPaper('A4', 'portrait');
        // $dompdf->render();
        // $fileName = 'LAPORAN_PENGADUAN_' . $id . '.pdf';
        // return $dompdf->stream($fileName);

        // return view('pengaduan.print', compact('data', 'user'));
    }
        //
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = DB::table('feedback')
            ->join('users', 'users.id', '=', 'feedback.update_user_by_id') // Join dengan tabel users
            ->select('users.name')
            ->first();

        $data = DB::table('pengaduans')
            ->join('feedback', 'pengaduans.id', '=', 'feedback.id')
            // ->select('pengaduans.*', 'feedback.status')
            ->where('pengaduans.id', $id)
            ->first();

        // Cek status kontak pada tabel blokir
        $isBlocked = DB::table('block')
        ->where('kontak', $data->kontak)
        ->exists();
        return view('pengaduan.detail', compact('data', 'user', 'isBlocked'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $userId = Auth::id();
        $newStatus = $request->input('status');

        $request->validate([
            'status' => 'required',
            'keterangan' => 'required',
        ]);

        $feedback = Feedback::join('pengaduans', 'feedback.id', '=', 'pengaduans.id')
                ->findOrFail($id);
        
        $kontak = $feedback->kontak;
        $nomor = $feedback->nomor;
        $status = $feedback->status;
        $tgl = $feedback->created_at;
        $formattedDate = date('j F Y', strtotime($tgl));
        $formattedTime = date('H:i', strtotime($tgl));

//         if ($newStatus === 'waiting') {
//             $waitingReason = $request->input('keterangan');
//             $feedback->waiting_reason = $waitingReason;
//             $feedback->waiting_updated_at = Carbon::now();

//             // Mengirim data JSON ke URL dengan menggunakan Guzzle
//             $message = 'Hallo wargi Desa Dampit. 

// Mohon maaf, Pengaduan Anda dengan nomor ' . $nomor . ' pada ' . $formattedDate . ' pukul ' . $formattedTime . ' dengan status ' . $status . '. Menunggu persetujuan perangkat Desa Dampit. Mohon ditunggu info selanjutnya.
            
// Alasan: ' . $waitingReason;

//             $this->sendMessage($kontak, $message);
//         }
        if ($newStatus === 'approved') {
            $approvedReason = $request->input('keterangan');
            $feedback->approved_reason = $approvedReason;
            $feedback->approved_updated_at = Carbon::now();

            $message = 'Hallo wargi Desa Dampit. 

Selamat, pengaduan Anda dengan nomor ' . $nomor . ' pada ' . $formattedDate . ' pukul ' . $formattedTime . ' dengan status ' . $status . '. Telah disetujui dan akan ditindak lanjut. Mohon ditunggu info selanjutnya.

Alasan: ' . $approvedReason;

            $this->sendMessage($kontak, $message);
        }
        if ($newStatus === 'rejected') {
            $rejectedReason = $request->input('keterangan');
            $feedback->rejected_reason = $rejectedReason;
            $feedback->rejected_updated_at = Carbon::now();

            $message = 'Hallo warga Desa Dampit. 

Mohon maaf. pengaduan Anda dengan nomor ' . $nomor . ' pada ' . $formattedDate . ' pukul ' . $formattedTime . ' dengan status ' . $status . '. Telah ditolak. Periksa kembali laporan Anda. Terima kasih.

Alasan: ' . $rejectedReason;

            $this->sendMessage($kontak, $message);
        }
        if ($newStatus === 'process') {
            $processReason = $request->input('keterangan');
            $feedback->process_reason = $processReason;
            $feedback->process_updated_at = Carbon::now();

            $message = 'Hallo warga Desa Dampit. 

Kabar gembira bagi kita semua. pengaduan Anda dengan nomor ' . $nomor . ' pada ' . $formattedDate . ' pukul ' . $formattedTime . ' dengan status ' . $status . '. Sedang dalam proses tindak lanjut. Mohon ditunggu info selanjutnya.

Alasan: ' . $processReason;

            $this->sendMessage($kontak, $message);
        }
        if ($newStatus === 'pending') {
            $pendingReason = $request->input('keterangan');
            $feedback->pending_reason = $pendingReason;
            $feedback->pending_updated_at = Carbon::now();

            $message = 'Hallo warga Desa Dampit. 

Mohon maaf. pengaduan Anda dengan nomor ' . $nomor . ' pada ' . $formattedDate . ' pukul ' . $formattedTime . ' dengan status ' . $status . '. Laporan sedang ditinjau ulang. Mohon ditunggu info selanjutnya.

Alasan: ' . $pendingReason;

            $this->sendMessage($kontak, $message);
        }
        if ($newStatus === 'finished') {
            $finishedReason = $request->input('keterangan');
            $feedback->finished_reason = $finishedReason;
            $feedback->finished_updated_at = Carbon::now();

            $message = 'Hallo warga Desa Dampit. 

Selamat. Pengaduan yang Anda dengan nomor ' . $nomor . ' pada ' . $formattedDate . ' pukul ' . $formattedTime . ' dengan status ' . $status . '. Telah selesai ditindak lanjut. Terima kasih atas pastisipasi Anda. 

Alasan: ' . $finishedReason;

            $this->sendMessage($kontak, $message);
        }

        $feedback->status = $newStatus;
        $feedback->update_user_by_id = $userId;
        $feedback->save();

        return redirect()->back()->with('success', 'Status updated successfully.');
    }

    private function sendMessage($kontak, $message)
    {
        $data = [
            'number' => $kontak,
            'message' => $message
        ];

        try {
            $response = $this->_client->post('/send-message', [
                'json' => $data
            ]);

            // Lakukan penanganan respons jika diperlukan
            // ...

            return $response;
        } catch (Exception $e) {
            // Penanganan kesalahan jika pengiriman gagal
            // ...

            return null;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Temukan data pengaduan berdasarkan ID
        $pengaduan = Pengaduan::findOrFail($id);
    
        // Hapus data feedback terkait jika ada
        $feedback = Feedback::where('id', $id)->first();
        if ($feedback) {
            $feedback->delete();
        }
    
        // Hapus data pengaduan
        $pengaduan->delete();
    
        return redirect()->back()->with('error', 'Data deleted successfully.');
    }
}
