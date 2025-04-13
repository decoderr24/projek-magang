<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Masyarakat;

class DashboardController extends Controller
{
    public function index() {
        return view('pages.admin.dashboard', [
            'pengaduan' => Pengaduan::count(),
            'proses' => Pengaduan::where('status', 'proses')->count(),
            'selesai' => Pengaduan::where('status', 'selesai')->count(),
            'masyarakat' => Masyarakat::count(),
        ]);
    }
}
