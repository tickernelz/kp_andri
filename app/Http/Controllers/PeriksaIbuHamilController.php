<?php

namespace App\Http\Controllers;

use App\Models\IbuHamil;
use App\Models\Pemeriksaan;
use App\Models\PeriksaIbuHamil;
use Illuminate\Http\Request;

class PeriksaIbuHamilController extends Controller
{
    public function pemeriksaan()
    {
        return view('data.ibu_hamil.pemeriksaan.index');
    }

    public function pemeriksaan_cari(Request $request)
    {
        $tanggal = $request->input('tanggal');
        $data = IbuHamil::with('peserta')->get();

        return view('data.ibu_hamil.pemeriksaan.index', compact('tanggal', 'data'));
    }

    public function pemeriksaan_input(int $id, string $tanggal)
    {
        $data = IbuHamil::with('peserta')->firstWhere('peserta_id', $id);

        return view('data.ibu_hamil.pemeriksaan.input', compact('tanggal', 'data'));
    }

    public function pemeriksaan_store(Request $request, int $id, string $tanggal)
    {
        $request->validate([
            'berat_badan' => 'required|string',
            'tekanan_darah' => 'required|string',
            'bulan_kehamilan' => 'required|string',
            'tinggi_fundus' => 'required|string',
            'denyut_jantung_janin' => 'required|string',
            'lingkar_lengan_atas' => 'required|string',
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

        $ibuhamil = new PeriksaIbuHamil();
        $ibuhamil->berat_badan = $request->input('berat_badan');
        $ibuhamil->tekanan_darah = $request->input('tekanan_darah');
        $ibuhamil->bulan_kehamilan = $request->input('bulan_kehamilan');
        $ibuhamil->tinggi_fundus = $request->input('tinggi_fundus');
        $ibuhamil->denyut_jantung_janin = $request->input('denyut_jantung_janin');
        $ibuhamil->lingkar_lengan_atas = $request->input('lingkar_lengan_atas');
        $ibuhamil->pemeriksaan()->associate($pemeriksaan);
        $ibuhamil->save();

        return redirect()->route('ibu_hamil.pemeriksaan.cari.tanggal', $tanggal)->with('message', 'Data Berhasil Ditambahkan!');
    }

    public function pemeriksaan_edit(int $id, string $tanggal)
    {
        $data = Pemeriksaan::with('periksa_ibu_hamil', 'peserta')->firstWhere([['peserta_id', '=', $id], ['tanggal', '=', $tanggal]]);

        return view('data.ibu_hamil.pemeriksaan.edit', compact('tanggal', 'data'));
    }

    public function pemeriksaan_update(Request $request, int $id, string $tanggal)
    {
        $data = PeriksaIbuHamil::with('pemeriksaan')->firstWhere('id', $id);

        $request->validate([
            'berat_badan' => 'required|string',
            'tekanan_darah' => 'required|string',
            'bulan_kehamilan' => 'required|string',
            'tinggi_fundus' => 'required|string',
            'denyut_jantung_janin' => 'required|string',
            'lingkar_lengan_atas' => 'required|string',
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
        $data->bulan_kehamilan = $request->input('bulan_kehamilan');
        $data->tinggi_fundus = $request->input('tinggi_fundus');
        $data->denyut_jantung_janin = $request->input('denyut_jantung_janin');
        $data->lingkar_lengan_atas = $request->input('lingkar_lengan_atas');
        $data->pemeriksaan->save();
        $data->save();

        return redirect()->route('ibu_hamil.pemeriksaan.cari.tanggal', $tanggal)->with('message', 'Data Berhasil Diperbarui!');
    }
}
