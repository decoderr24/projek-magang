<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
// use Barryvdh\DomPDF\PDF;
// use Barryvdh\DomPDF\Facade as PDF;
use Barryvdh\DomPDF\Facade as PDF;




class LaporanController extends Controller
{
    public function index() {

        return view('pages.admin.laporan.index');
    }

    public function laporan(Request $request) {
        date_default_timezone_set('Asia/Bangkok');

        $date_from = $request->input('date_from');
        $date_to = $request->input('date_to');

        $pengaduan = Pengaduan::query();

        if($date_from) {
            $pengaduan->where('tgl_pengaduan', '>=', $date_from ?? '2021-01-01 00:00:00')->where('tgl_pengaduan', '<=', $date_to . ' 23:59:59' ?? date('Y-m-d H:i:s'));
        }

        return view('pages.admin.laporan.index', [
            'pengaduan' => $pengaduan->get(),
            'from' => $date_from,
            'to' => $date_to,
        ]);
    }

    public function export(Request $request) {
        date_default_timezone_set('Asia/Bangkok');

        $date_from = $request->input('date_from');
        $date_to = $request->input('date_to');

        $pengaduan = Pengaduan::query();

        if($date_from) {
            $pengaduan->where('tgl_pengaduan', '>=', $date_from . ' ' . '00:00:00')->where('tgl_pengaduan', '<=', $date_to . ' 23:59:59' ?? date('Y-m-d H:i:s'));
        }
        $pengaduan = Pengaduan::all();
        $pdf = PDF::loadview('pages.admin.laporan.export',['pengaduan'=>$pengaduan]);
    	return $pdf->download('laporan.pdf');
    }
}
