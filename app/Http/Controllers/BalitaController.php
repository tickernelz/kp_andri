<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use App\Models\Peserta;
use Illuminate\Http\Request;

class BalitaController extends Controller
{
    public function pendaftaran()
    {
        return view('data.balita.pendaftaran');
    }

    public function pendaftaran_store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'nik' => 'nullable|numeric',
            'kk' => 'nullable|numeric',
            'alamat' => 'nullable|string',
            'kelamin' => 'required|string',
            'tanggal_lahir' => 'required|string',
            'ayah' => 'required|string',
            'ibu' => 'required|string',
            'hp' => 'nullable|numeric',
        ]);

        $peserta = new Peserta();
        $peserta->nama = $request->input('nama');
        $peserta->nik = $request->input('nik');
        $peserta->kk = $request->input('kk');
        $peserta->alamat = $request->input('alamat');
        $peserta->kelamin = $request->input('kelamin');
        $peserta->tanggal_lahir = $request->input('tanggal_lahir');
        $peserta->hp = $request->input('hp');
        $peserta->save();

        $balita = new Balita();
        $balita->ayah = $request->input('ayah');
        $balita->ibu = $request->input('ibu');
        $balita->peserta()->associate($peserta);
        $balita->save();

        return back()->with('success', 'Data Berhasil Ditambahkan!');
    }

    public function edit(int $id)
    {
        $data = Balita::with('peserta')->firstWhere('id', $id);

        return view('data.balita.edit', compact('data'));
    }

    public function edit_store(Request $request, int $id)
    {
        $data = Balita::with('peserta')->firstWhere('id', $id);

        $request->validate([
            'nama' => 'required|string',
            'nik' => 'nullable|numeric',
            'kk' => 'nullable|numeric',
            'alamat' => 'nullable|string',
            'kelamin' => 'required|string',
            'tanggal_lahir' => 'required|string',
            'ayah' => 'required|string',
            'ibu' => 'required|string',
            'hp' => 'nullable|numeric',
        ]);

        $data->peserta->nama = $request->input('nama');
        $data->peserta->nik = $request->input('nik');
        $data->peserta->kk = $request->input('kk');
        $data->peserta->alamat = $request->input('alamat');
        $data->peserta->kelamin = $request->input('kelamin');
        $data->peserta->tanggal_lahir = $request->input('tanggal_lahir');
        $data->peserta->hp = $request->input('hp');
        $data->ayah = $request->input('ayah');
        $data->ibu = $request->input('ibu');
        $data->peserta->save();
        $data->save();

        return back()->with('success', 'Data Berhasil Diperbarui!');
    }

    public function list()
    {
        $data_balita = Balita::with('peserta')->get();

        return view('data.balita.list', compact('data_balita'));
    }

    public function detail(int $id)
    {
        $data_balita = Balita::with('peserta')->firstWhere('id', $id);

        return view('data.balita.detail', compact('data_balita'));
    }

    public function destroy(int $id)
    {
        Peserta::find($id)->delete();

        return back()->with('message', 'Data Berhasil Dihapus!');
    }
}
