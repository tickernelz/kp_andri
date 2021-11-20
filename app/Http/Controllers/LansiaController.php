<?php

namespace App\Http\Controllers;

use App\Models\Lansia;
use App\Models\Peserta;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PdfReport;

class LansiaController extends Controller
{
    public function pendaftaran()
    {
        return view('data.lansia.pendaftaran');
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
        $peserta->kelamin = $request->input('kelamin');
        $peserta->tanggal_lahir = $request->input('tanggal_lahir');
        $peserta->hp = $request->input('hp');
        $peserta->save();

        $lansia = new Lansia();
        $lansia->golongan_darah = $request->input('golongan_darah');
        $lansia->riwayat_penyakit = $request->input('riwayat_penyakit');
        $lansia->riwayat_alergi = $request->input('riwayat_alergi');
        $lansia->peserta()->associate($peserta);
        $lansia->save();

        return back()->with('success', 'Data Berhasil Ditambahkan!');
    }

    public function edit(int $id)
    {
        $data = Lansia::with('peserta')->firstWhere('id', $id);

        return view('data.lansia.edit', compact('data'));
    }

    public function edit_store(Request $request, int $id)
    {
        $data = Lansia::with('peserta')->firstWhere('id', $id);

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
        $data_lansia = Lansia::with('peserta')->get();

        return view('data.lansia.list', compact('data_lansia'));
    }

    public function detail(int $id)
    {
        $data_lansia = Lansia::with('peserta')->firstWhere('id', $id);

        return view('data.lansia.detail', compact('data_lansia'));
    }

    public function laporan_pendaftaran(Request $request)
    {
        $fromDate = $request->input('dari_tanggal');
        $toDate = $request->input('sampai_tanggal');

        if ($fromDate >= $toDate) {
            return back()->with('error', 'Tanggal Akhir Tidak Boleh Kurang Dari Tanggal Awal');
        }

        $title = 'Laporan Pendaftaran Lansia';

        $meta = [
            'Dari Tanggal' => Carbon::parse($fromDate)->formatLocalized('%d %B %Y'),
            'Sampai Tanggal' => Carbon::parse($toDate)->formatLocalized('%d %B %Y'),
        ];

        $data = Lansia::with('peserta')->whereBetween('created_at', [$fromDate, $toDate]);

        $columns = [
            'Nama' => function ($data) {
                return $data->peserta->nama ?? 'Kosong';
            },
            'Golongan Darah' => function ($data) {
                return $data->golongan_darah ?? 'Kosong';
            },
            'Riwayat Penyakit' => function ($data) {
                return $data->riwayat_penyakit ?? 'Kosong';
            },
            'Riwayat Alergi' => function ($data) {
                return $data->riwayat_alergi ?? 'Kosong';
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
            ->editColumns(['Nama', 'Golongan Darah', 'Riwayat Penyakit', 'Riwayat Alergi', 'NIK', 'KK', 'Alamat', 'Kelamin', 'Tanggal Lahir', 'HP'], [
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
