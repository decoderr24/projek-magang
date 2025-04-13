<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Masyarakat;

class MasyarakatController extends Controller
{
    public function index() {

        $masyarakat = Masyarakat::all();

        return view('pages.admin.masyarakat.index', compact('masyarakat'));
    }

    public function show($nik) {

        $masyarakat = Masyarakat::where('nik', $nik)->first();

        return view('pages.admin.masyarakat.show', compact('masyarakat'));
    }

     public function destroy(Request $request, $nik) {

        if($nik = 'nik') {
            $nik = $request->nik;
        }

        $masyarakat = Masyarakat::find($nik);

        $masyarakat->delete();

        if($request->ajax()) {
            return 'success';
        }

        return redirect()->route('masyarakat.index');
    }
}
