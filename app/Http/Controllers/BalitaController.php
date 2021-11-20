<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use App\Models\Peserta;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PdfReport;

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

    public function laporan_pendaftaran(Request $request)
    {
        $fromDate = $request->input('dari_tanggal');
        $toDate = $request->input('sampai_tanggal');

        if ($fromDate >= $toDate) {
            return back()->with('error', 'Tanggal Akhir Tidak Boleh Kurang Dari Tanggal Awal');
        }

        $title = 'Laporan Pendaftaran Balita';

        $meta = [
            'Dari Tanggal' => Carbon::parse($fromDate)->formatLocalized('%d %B %Y'),
            'Sampai Tanggal' => Carbon::parse($toDate)->formatLocalized('%d %B %Y'),
        ];

        $data = Balita::with('peserta')->whereBetween('created_at', [$fromDate, $toDate]);

        $columns = [
            'Nama' => function ($data) {
                return $data->peserta->nama ?? 'Kosong';
            },
            'Nama Ayah' => function ($data) {
                return $data->ayah ?? 'Kosong';
            },
            'Nama Ibu' => function ($data) {
                return $data->ibu ?? 'Kosong';
            },
            'NIK' => function ($data) {
                return $data->peserta->nik ?? 'Kosong';
            },
            'KK' => function ($data) {
                return $data->peserta->kk ?? 'Kosong';
            },
            'Alamat' => function ($data) {
                return $data->peserta->alamat ?? 'Kosong';
            },
            'Kelamin' => function ($data) {
                return $data->peserta->kelamin ?? 'Kosong';
            },
            'Tanggal Lahir' => function ($data) {
                return Carbon::parse($data->peserta->tanggal_lahir)->formatLocalized('%d %B %Y') ?? 'Kosong';
            },
            'HP' => function ($data) {
                return $data->peserta->hp ?? 'Kosong';
            },
        ];

        // Generate Report with flexibility to manipulate column class even manipulate column value (using Carbon, etc).
        return PdfReport::of($title, $meta, $data, $columns)
            ->editColumns(['Nama', 'Nama Ayah', 'Nama Ibu', 'NIK', 'KK', 'Alamat', 'Kelamin', 'Tanggal Lahir', 'HP'], [
                'class' => 'center bolder',
            ])
            ->setOrientation('landscape')
            ->stream();
    }

    public function destroy(int $id)
    {
        Peserta::find($id)->delete();

        return back()->with('message', 'Data Berhasil Dihapus!');
    }
}
