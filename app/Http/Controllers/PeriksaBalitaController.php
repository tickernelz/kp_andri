<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use App\Models\Imunisasi;
use App\Models\Pemeriksaan;
use App\Models\PeriksaBalita;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PdfReport;

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

    public function laporan_pemeriksaan(Request $request)
    {
        $fromDate = $request->input('dari_tanggal');
        $toDate = $request->input('sampai_tanggal');

        if ($fromDate >= $toDate) {
            return back()->with('error', 'Tanggal Akhir Tidak Boleh Kurang Dari Tanggal Awal');
        }

        $title = 'Laporan Pemeriksaan Balita';

        $meta = [
            'Dari Tanggal' => Carbon::parse($fromDate)->formatLocalized('%d %B %Y'),
            'Sampai Tanggal' => Carbon::parse($toDate)->formatLocalized('%d %B %Y'),
        ];

        $data = PeriksaBalita::with('imunisasi')->whereHas('pemeriksaan', function ($q) use ($toDate, $fromDate) {
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
            'Tinggi Badan' => function ($data) {
                return $data->tinggi_badan ?? 'Kosong';
            },
            'Lingkar Kepala' => function ($data) {
                return $data->lingkar_kepala ?? 'Kosong';
            },
            'Imunisasi' => function ($data) {
                return $data->imunisasi->nama ?? 'Kosong';
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
            ->editColumns(['Nama', 'Usia', 'Berat Badan', 'Tinggi Badan', 'Lingkar Kepala', 'Imunisasi', 'Keluhan', 'Penanganan', 'Catatan'], [
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

        $title = 'Laporan Kehadiran Balita';

        $meta = [
            'Dari Tanggal' => Carbon::parse($fromDate)->formatLocalized('%d %B %Y'),
            'Sampai Tanggal' => Carbon::parse($toDate)->formatLocalized('%d %B %Y'),
        ];

        $data = Balita::with('peserta')->whereBetween('created_at', [$fromDate, $toDate]);

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
