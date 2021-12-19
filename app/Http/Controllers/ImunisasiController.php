<?php

namespace App\Http\Controllers;

use App\Models\Imunisasi;
use Illuminate\Http\Request;

class ImunisasiController extends Controller
{
    public function index()
    {
        $data = Imunisasi::get();

        return view('kelola.imunisasi.list', [
            'title' => 'List Imunisasi',
            'data' => $data,
        ]);
    }

    public function create()
    {
        return view('kelola.imunisasi.create', [
            'title' => 'Tambah Imunisasi',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|unique:imunisasis',
            'kegunaan' => 'nullable|string',
            'stok' => 'required|integer',
        ]);

        $data = new Imunisasi();
        $data->nama = $request->input('nama');
        $data->kegunaan = $request->input('kegunaan');
        $data->stok = $request->input('stok');
        $data->save();

        return back()->with('success', 'Data Berhasil Ditambahkan!');
    }

    public function edit(int $id)
    {
        $data = Imunisasi::firstWhere('id', $id);

        return view('kelola.imunisasi.edit', [
            'title' => 'Edit Imunisasi',
            'data' => $data,
        ]);
    }

    public function update(Request $request, int $id)
    {
        $data = Imunisasi::firstWhere('id', $id);

        $request->validate([
            'nama' => 'required|string|unique:imunisasis,nama,'.$data->id,
            'kegunaan' => 'nullable|string',
            'stok' => 'required|integer',
        ]);

        $data->nama = $request->input('nama');
        $data->kegunaan = $request->input('kegunaan');
        $data->stok = $request->input('stok');
        $data->save();

        return back()->with('success', 'Data Berhasil Diperbarui!');
    }

    public function destroy(int $id)
    {
        $data = Imunisasi::firstWhere('id', $id);
        $data->delete();

        return back()->with('message', 'Data Berhasil Dihapus!');
    }
}
