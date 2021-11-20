<?php

namespace App\Http\Controllers;

use App\Models\Lansia;
use App\Models\Pemeriksaan;
use App\Models\PeriksaLansia;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PdfReport;

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

    public function laporan_pemeriksaan(Request $request)
    {
        $fromDate = $request->input('dari_tanggal');
        $toDate = $request->input('sampai_tanggal');

        if ($fromDate >= $toDate) {
            return back()->with('error', 'Tanggal Akhir Tidak Boleh Kurang Dari Tanggal Awal');
        }

        $title = 'Laporan Pemeriksaan Lansia';

        $meta = [
            'Dari Tanggal' => Carbon::parse($fromDate)->formatLocalized('%d %B %Y'),
            'Sampai Tanggal' => Carbon::parse($toDate)->formatLocalized('%d %B %Y'),
        ];

        $data = PeriksaLansia::with('imunisasi')->whereHas('pemeriksaan', function ($q) use ($toDate, $fromDate) {
            $q->whereBetween('tanggal', [$fromDate, $toDate]);
        });

        $columns = [
            'Nama' => function ($data) {
                return $data->pemeriksaan->peserta->nama ?? 'Kosong';
            },
            'Usia' => function ($data) {
                return Carbon::parse($data->pemeriksaan->peserta->tanggal_lahir)->age.' Tahun' ?? 'Kosong';
            },
            'Berat Badan' => function ($data) {
                return $data->berat_badan ?? 'Kosong';
            },
            'Tekanan Darah' => function ($data) {
                return $data->tekanan_darah ?? 'Kosong';
            },
            'Gula Darah' => function ($data) {
                return $data->gula_darah ?? 'Kosong';
            },
            'Kolesterol' => function ($data) {
                return $data->kolesterol ?? 'Kosong';
            },
            'Asam Urat' => function ($data) {
                return $data->asam_urat ?? 'Kosong';
            },
            'Keluhan' => function ($data) {
                return $data->pemeriksaan->keluhan ?? 'Kosong';
            },
            'Penanganan' => function ($data) {
                return $data->pemeriksaan->penanganan ?? 'Kosong';
            },
            'Catatan' => function ($data) {
                return $data->pemeriksaan->catatan ?? 'Kosong';
            },
        ];

        // Generate Report with flexibility to manipulate column class even manipulate column value (using Carbon, etc).
        return PdfReport::of($title, $meta, $data, $columns)
            ->editColumns(['Nama', 'Usia', 'Berat Badan', 'Tekanan Darah', 'Gula Darah', 'Kolesterol', 'Asam Urat', 'Keluhan', 'Penanganan', 'Catatan'], [
                'class' => 'center bolder',
            ])
            ->setOrientation('landscape')
            ->stream();
    }

    public function laporan_kehadiran(Request $request)
    {
        $fromDate = $request->input('dari_tanggal');
        $toDate = $request->input('sampai_tanggal');

        if ($fromDate >= $toDate) {
            return back()->with('error', 'Tanggal Akhir Tidak Boleh Kurang Dari Tanggal Awal');
        }

        $title = 'Laporan Kehadiran Lansia';

        $meta = [
            'Dari Tanggal' => Carbon::parse($fromDate)->formatLocalized('%d %B %Y'),
            'Sampai Tanggal' => Carbon::parse($toDate)->formatLocalized('%d %B %Y'),
        ];

        $data = Lansia::with('peserta')->whereBetween('created_at', [$fromDate, $toDate]);

        $columns = [
            'Nama' => function ($data) {
                return $data->peserta->nama ?? 'Kosong';
            },
            'Usia' => function ($data) {
                return Carbon::parse($data->peserta->tanggal_lahir)->age.' Tahun' ?? 'Kosong';
            },
            'Kelamin' => function ($data) {
                return $data->peserta->kelamin ?? 'Kosong';
            },
            'Alamat' => function ($data) {
                return $data->peserta->alamat ?? 'Kosong';
            },
            'Kehadiran' => function ($data) use ($toDate, $fromDate) {
                if (Pemeriksaan::whereBetween('tanggal', [$fromDate, $toDate])->where('peserta_id', $data->peserta->id)->first()) {
                    return 'Hadir';
                }

                return 'Tidak Hadir';
            },
        ];

        // Generate Report with flexibility to manipulate column class even manipulate column value (using Carbon, etc).
        return PdfReport::of($title, $meta, $data, $columns)
            ->editColumns(['Nama', 'Usia', 'Kelamin', 'Alamat', 'Kehadiran'], [
                'class' => 'center bolder',
            ])
            ->setOrientation('landscape')
            ->stream();
    }
}
