@extends('layouts.main')

@push('title', 'List Ibu Hamil')

@section('content')
    <div class="modal fade" id="laporan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('ibu_hamil.list.laporan') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Cetak Laporan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <x-flatpickr value="" name="dari_tanggal" label="Dari Tanggal" form="" classes=""/>
                        <x-flatpickr value="" name="sampai_tanggal" label="Sampai Tanggal" form="" classes=""/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Cetak</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Tabel Ibu Hamil</h4>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#laporan">
                            Cetak Laporan
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('message'))
                        <x-alert position="top" message="{{ session('message') }}"
                                 type="success"/>
                    @endif
                    <div class="table-responsive">
                        <table id="table" class="table table-striped text-center">
                            <thead>
                            <tr>
                                <th style="width: 5%">#</th>
                                <th>Nama Ibu Hamil</th>
                                <th>Alamat</th>
                                <th>Tanggal Lahir</th>
                                <th>Tanggal Daftar</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($data as $li)
                                <tr>
                                    <td>{{ $loop->iteration ?? 'Kosong' }}</td>
                                    <td>{{ $li->peserta->nama ?? 'Kosong' }}</td>
                                    <td>{{ $li->peserta->alamat ?? 'Kosong' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($li->peserta->tanggal_lahir)->formatLocalized('%d %B %Y') ?? 'Kosong' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($li->peserta->created_at)->formatLocalized('%d %B %Y') ?? 'Kosong' }}</td>
                                    <td>
                                        <form action="{{ route('ibu_hamil.destroy', $li->peserta->id) }}" method="post">
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="{{ route('ibu_hamil.edit', $li->id) }}"
                                                   class="btn btn-primary">Edit</a>
                                                <a href="{{ route('ibu_hamil.detail', $li->id) }}"
                                                   class="btn btn-success">Lihat</a>
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Yakin Mau Dihapus?')">Hapus
                                                </button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>
    <script>
        $(document).ready(function () {
            $('#table').DataTable({
                responsive: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/id.json'
                }
            });
            $(".flatpickr").flatpickr(
                {
                    locale: "id"
                }
            );
        });
    </script>
@endpush
