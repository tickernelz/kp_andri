<?php

namespace App\Http\Controllers;

use App\Models\Pengaturan;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    public function index()
    {
        $pengaturan = Pengaturan::firstWhere('id', 1);

        return view('lainnya.pengaturan.index', compact(
            'pengaturan',
        ));
    }

    public function ubah(Request $request)
    {
        $pengaturan = Pengaturan::firstWhere('id', 1);

        $request->validate([
            'nama_aplikasi' => 'required|string',
        ]);

        $pengaturan->nama_aplikasi = $request->input('nama_aplikasi');
        $pengaturan->save();

        return back()->with('success', 'Data Berhasil Diubah!');
    }
}
