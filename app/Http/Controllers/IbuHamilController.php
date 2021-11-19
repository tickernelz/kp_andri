<?php

namespace App\Http\Controllers;

use App\Models\IbuHamil;
use App\Models\Peserta;
use Illuminate\Http\Request;

class IbuHamilController extends Controller
{
    public function pendaftaran()
    {
        return view('data.ibu_hamil.pendaftaran');
    }

    public function pendaftaran_store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'nik' => 'nullable|numeric',
            'kk' => 'nullable|numeric',
            'alamat' => 'nullable|string',
            'tanggal_lahir' => 'required|string',
            'hp' => 'nullable|numeric',
            'golongan_darah' => 'required|string',
            'riwayat_penyakit' => 'required|string',
            'riwayat_alergi' => 'required|string',
        ]);

        $peserta = new Peserta();
        $peserta->nama = $request->input('nama');
        $peserta->nik = $request->input('nik');
        $peserta->kk = $request->input('kk');
        $peserta->alamat = $request->input('alamat');
        $peserta->kelamin = 'Perempuan';
        $peserta->tanggal_lahir = $request->input('tanggal_lahir');
        $peserta->hp = $request->input('hp');
        $peserta->save();

        $ibu_hamil = new IbuHamil();
        $ibu_hamil->golongan_darah = $request->input('golongan_darah');
        $ibu_hamil->riwayat_penyakit = $request->input('riwayat_penyakit');
        $ibu_hamil->riwayat_alergi = $request->input('riwayat_alergi');
        $ibu_hamil->peserta()->associate($peserta);
        $ibu_hamil->save();

        return back()->with('success', 'Data Berhasil Ditambahkan!');
    }

    public function edit(int $id)
    {
        $data = IbuHamil::with('peserta')->firstWhere('id', $id);

        return view('data.ibu_hamil.edit', compact('data'));
    }

    public function edit_store(Request $request, int $id)
    {
        $data = IbuHamil::with('peserta')->firstWhere('id', $id);

        $request->validate([
            'nama' => 'required|string',
            'nik' => 'nullable|numeric',
            'kk' => 'nullable|numeric',
            'alamat' => 'nullable|string',
            'tanggal_lahir' => 'required|string',
            'hp' => 'nullable|numeric',
            'golongan_darah' => 'required|string',
            'riwayat_penyakit' => 'required|string',
            'riwayat_alergi' => 'required|string',
        ]);

        $data->peserta->nama = $request->input('nama');
        $data->peserta->nik = $request->input('nik');
        $data->peserta->kk = $request->input('kk');
        $data->peserta->alamat = $request->input('alamat');
        $data->peserta->tanggal_lahir = $request->input('tanggal_lahir');
        $data->peserta->hp = $request->input('hp');
        $data->golongan_darah = $request->input('golongan_darah');
        $data->riwayat_penyakit = $request->input('riwayat_penyakit');
        $data->riwayat_alergi = $request->input('riwayat_alergi');
        $data->peserta->save();
        $data->save();

        return back()->with('success', 'Data Berhasil Diperbarui!');
    }

    public function list()
    {
        $data = IbuHamil::with('peserta')->get();

        return view('data.ibu_hamil.list', compact('data'));
    }

    public function detail(int $id)
    {
        $data = IbuHamil::with('peserta')->firstWhere('id', $id);

        return view('data.ibu_hamil.detail', compact('data'));
    }

    public function destroy(int $id)
    {
        Peserta::find($id)->delete();

        return back()->with('message', 'Data Berhasil Dihapus!');
    }
}
