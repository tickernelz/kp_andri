<?php

namespace App\Http\Controllers;

use App\Models\Lansia;
use App\Models\Pemeriksaan;
use App\Models\PeriksaLansia;
use Illuminate\Http\Request;

class PeriksaLansiaController extends Controller
{
    public function pemeriksaan()
    {
        return view('data.lansia.pemeriksaan.index');
    }

    public function pemeriksaan_cari(Request $request)
    {
        $tanggal = $request->input('tanggal');
        $data_lansia = Lansia::with('peserta')->get();

        return view('data.lansia.pemeriksaan.index', compact('tanggal', 'data_lansia'));
    }

    public function pemeriksaan_input(int $id, string $tanggal)
    {
        $data = Lansia::with('peserta')->firstWhere('peserta_id', $id);

        return view('data.lansia.pemeriksaan.input', compact('tanggal', 'data'));
    }

    public function pemeriksaan_store(Request $request, int $id, string $tanggal)
    {
        $request->validate([
            'berat_badan' => 'required|string',
            'tekanan_darah' => 'required|string',
            'gula_darah' => 'required|string',
            'kolesterol' => 'required|string',
            'asam_urat' => 'required|string',
            'tanggal' => 'required|string',
            'keluhan' => 'required|string',
            'penanganan' => 'nullable|string',
            'catatan' => 'nullable|string',
        ]);

        $pemeriksaan = new Pemeriksaan();
        $pemeriksaan->peserta_id = $id;
        $pemeriksaan->tanggal = $request->input('tanggal');
        $pemeriksaan->keluhan = $request->input('keluhan');
        $pemeriksaan->penanganan = $request->input('penanganan');
        $pemeriksaan->catatan = $request->input('catatan');
        $pemeriksaan->save();

        $lansia = new PeriksaLansia();
        $lansia->berat_badan = $request->input('berat_badan');
        $lansia->tekanan_darah = $request->input('tekanan_darah');
        $lansia->gula_darah = $request->input('gula_darah');
        $lansia->kolesterol = $request->input('kolesterol');
        $lansia->asam_urat = $request->input('asam_urat');
        $lansia->pemeriksaan()->associate($pemeriksaan);
        $lansia->save();

        return redirect()->route('lansia.pemeriksaan.cari.tanggal', $tanggal)->with('message', 'Data Berhasil Ditambahkan!');
    }

    public function pemeriksaan_edit(int $id, string $tanggal)
    {
        $data = Pemeriksaan::with('periksa_lansia', 'peserta')->firstWhere([['peserta_id', '=', $id], ['tanggal', '=', $tanggal]]);

        return view('data.lansia.pemeriksaan.edit', compact('tanggal', 'data'));
    }

    public function pemeriksaan_update(Request $request, int $id, string $tanggal)
    {
        $data = PeriksaLansia::with('pemeriksaan')->firstWhere('id', $id);

        $request->validate([
            'berat_badan' => 'required|string',
            'tekanan_darah' => 'required|string',
            'gula_darah' => 'required|string',
            'kolesterol' => 'required|string',
            'asam_urat' => 'required|string',
            'tanggal' => 'required|string',
            'keluhan' => 'required|string',
            'penanganan' => 'nullable|string',
            'catatan' => 'nullable|string',
        ]);

        $data->pemeriksaan->tanggal = $request->input('tanggal');
        $data->pemeriksaan->keluhan = $request->input('keluhan');
        $data->pemeriksaan->penanganan = $request->input('penanganan');
        $data->pemeriksaan->catatan = $request->input('catatan');
        $data->berat_badan = $request->input('berat_badan');
        $data->tekanan_darah = $request->input('tekanan_darah');
        $data->gula_darah = $request->input('gula_darah');
        $data->kolesterol = $request->input('kolesterol');
        $data->asam_urat = $request->input('asam_urat');
        $data->pemeriksaan->save();
        $data->save();

        return redirect()->route('lansia.pemeriksaan.cari.tanggal', $tanggal)->with('message', 'Data Berhasil Diperbarui!');
    }
}
