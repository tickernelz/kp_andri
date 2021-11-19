<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use App\Models\Imunisasi;
use App\Models\Pemeriksaan;
use App\Models\PeriksaBalita;
use Illuminate\Http\Request;

class PeriksaBalitaController extends Controller
{
    public function pemeriksaan()
    {
        return view('data.balita.pemeriksaan.index');
    }

    public function pemeriksaan_cari(Request $request)
    {
        $tanggal = $request->input('tanggal');
        $data_balita = Balita::with('peserta')->get();

        return view('data.balita.pemeriksaan.index', compact('tanggal', 'data_balita'));
    }

    public function pemeriksaan_input(int $id, string $tanggal)
    {
        $data = Balita::with('peserta')->firstWhere('peserta_id', $id);
        $imunisasi = Imunisasi::get();

        return view('data.balita.pemeriksaan.input', compact('tanggal', 'data', 'imunisasi'));
    }

    public function pemeriksaan_store(Request $request, int $id, string $tanggal)
    {
        $request->validate([
            'tanggal' => 'required|string',
            'berat_badan' => 'required|string',
            'tinggi_badan' => 'required|string',
            'lingkar_kepala' => 'required|string',
            'keluhan' => 'required|string',
            'penanganan' => 'nullable|string',
            'catatan' => 'nullable|string',
            'imunisasi' => 'required|string',
        ]);

        $pemeriksaan = new Pemeriksaan();
        $pemeriksaan->peserta_id = $id;
        $pemeriksaan->tanggal = $request->input('tanggal');
        $pemeriksaan->keluhan = $request->input('keluhan');
        $pemeriksaan->penanganan = $request->input('penanganan');
        $pemeriksaan->catatan = $request->input('catatan');
        $pemeriksaan->save();

        $balita = new PeriksaBalita();
        $balita->berat_badan = $request->input('berat_badan');
        $balita->tinggi_badan = $request->input('tinggi_badan');
        $balita->lingkar_kepala = $request->input('lingkar_kepala');
        $balita->imunisasi_id = $request->input('imunisasi');
        $balita->pemeriksaan()->associate($pemeriksaan);
        $balita->save();

        return redirect()->route('balita.pemeriksaan.cari.tanggal', $tanggal)->with('message', 'Data Berhasil Ditambahkan!');
    }

    public function pemeriksaan_edit(int $id, string $tanggal)
    {
        $data = Pemeriksaan::with('periksa_balita', 'peserta')->firstWhere([['peserta_id', '=', $id], ['tanggal', '=', $tanggal]]);
        $imunisasi = Imunisasi::get();

        return view('data.balita.pemeriksaan.edit', compact('tanggal', 'data', 'imunisasi'));
    }

    public function pemeriksaan_update(Request $request, int $id, string $tanggal)
    {
        $data = PeriksaBalita::with('pemeriksaan')->firstWhere('id', $id);

        $request->validate([
            'tanggal' => 'required|string',
            'berat_badan' => 'required|string',
            'tinggi_badan' => 'required|string',
            'lingkar_kepala' => 'required|string',
            'keluhan' => 'required|string',
            'penanganan' => 'nullable|string',
            'catatan' => 'nullable|string',
            'imunisasi' => 'required|string',
        ]);

        $data->pemeriksaan->tanggal = $request->input('tanggal');
        $data->pemeriksaan->keluhan = $request->input('keluhan');
        $data->pemeriksaan->penanganan = $request->input('penanganan');
        $data->pemeriksaan->catatan = $request->input('catatan');
        $data->berat_badan = $request->input('berat_badan');
        $data->tinggi_badan = $request->input('tinggi_badan');
        $data->lingkar_kepala = $request->input('lingkar_kepala');
        $data->imunisasi_id = $request->input('imunisasi');
        $data->pemeriksaan->save();
        $data->save();

        return redirect()->route('balita.pemeriksaan.cari.tanggal', $tanggal)->with('message', 'Data Berhasil Diperbarui!');
    }
}
