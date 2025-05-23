<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Tanggapan;

class PengaduanController extends Controller
{
    public function index($status) {
        $pengaduan = Pengaduan::where('status', $status)->orderBy('tgl_pengaduan', 'desc')->get();
        //dd($status);
        
        return view('pages.admin.pengaduan.index', compact('pengaduan', 'status'));
    }
    
    public function pengaduanDitinjau(Request $request, $id_pengaduan) 
    {
        try {
            $pengaduan = Pengaduan::findOrFail($id_pengaduan);
            $pengaduan->status = 'ditinjau';
            $pengaduan->save();
            
            return response()->json('success');
        } catch (\Exception $e) {
            \Log::error('Pengaduan Ditinjau Error: ' . $e->getMessage());
            return response()->json('failure', 500);
        }
    }
    
    public function show($id_pengaduan) {
        $pengaduan = Pengaduan::where('id_pengaduan', $id_pengaduan)->first();
        $tanggapan = Tanggapan::where('id_pengaduan', $id_pengaduan)->first();

        return view('pages.admin.pengaduan.show', [
            'pengaduan' => $pengaduan,
            'tanggapan' => $tanggapan
        ]);
    }

    public function destroy(Request $request, $id_pengaduan) {
        if($id_pengaduan == 'id_pengaduan') {
            $id_pengaduan = $request->id_pengaduan;
        }
    
        $pengaduan = Pengaduan::find($id_pengaduan);
        $pengaduan->delete();
    
        if($request->ajax()) {
            return 'success';
        }
    
        return redirect()->route('pengaduan.index', ['status' => '0']);
    }
    
}