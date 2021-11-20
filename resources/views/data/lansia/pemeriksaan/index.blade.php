@extends('layouts.main')

@push('title', 'List Lansia')

@section('content')
    <div class="modal fade" id="laporan-pemeriksaan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('lansia.pemeriksaan.laporan') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Cetak Laporan Pemeriksaan</h5>
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

    <div class="modal fade" id="laporan-kehadiran" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('lansia.pemeriksaan.kehadiran.laporan') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Cetak Laporan Kehadiran</h5>
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

    <div class="col-sm-8" style="float:none;margin:auto;">
        <form action="{{ route('lansia.pemeriksaan.cari') }}" method="get">
            @csrf
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Tanggal Pemeriksaan</h4>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" style="margin-right: 6px" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#laporan-kehadiran">
                            Laporan Kehadiran
                        </button>
                        <button type="button" style="margin-right: 6px" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#laporan-pemeriksaan">
                            Laporan Pemeriksaan
                        </button>
                        <button type="submit" class="btn btn-soft-primary">Cari</button>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <x-alert position="top" message="{{ session('success') }}"
                                 type="success"/>
                    @endif
                    @if (session('error'))
                        <x-alert position="top" message="{{ session('error') }}"
                                 type="warning"/>
                    @endif
                    <x-flatpickr classes="" label="Pilih Tanggal" name="tanggal" form="" value="{{ $tanggal ?? '' }}"/>
                </div>
            </div>
        </form>
    </div>

    @if (Request::has('tanggal'))
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Tabel Lansia</h4>
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
                                <th>Nama Lansia</th>
                                <th>Alamat</th>
                                <th>Kelamin</th>
                                <th>Tanggal Lahir</th>
                                <th>Kehadiran</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($data_lansia as $li)
                                @if(\App\Models\Pemeriksaan::firstWhere([['peserta_id','=',$li->peserta->id],['tanggal','=',$tanggal]]))
                                    <tr>
                                        <td>{{ $loop->iteration ?? 'Kosong' }}</td>
                                        <td>{{ $li->peserta->nama ?? 'Kosong' }}</td>
                                        <td>{{ $li->peserta->alamat ?? 'Kosong' }}</td>
                                        <td>{{ $li->peserta->kelamin ?? 'Kosong' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($li->peserta->tanggal_lahir)->formatLocalized('%d %B %Y') ?? 'Kosong' }}</td>
                                        <td>Hadir</td>
                                        <td>
                                            <a href="{{ route('lansia.pemeriksaan.edit', [$li->peserta->id, $tanggal]) }}"
                                               class="btn btn-success">Ubah</a>
                                        </td>
                                    </tr>
                                @else
                                    <tr class="table-danger">
                                        <td>{{ $loop->iteration ?? 'Kosong' }}</td>
                                        <td>{{ $li->peserta->nama ?? 'Kosong' }}</td>
                                        <td>{{ $li->peserta->alamat ?? 'Kosong' }}</td>
                                        <td>{{ $li->peserta->kelamin ?? 'Kosong' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($li->peserta->tanggal_lahir)->formatLocalized('%d %B %Y') ?? 'Kosong' }}</td>
                                        <td>Tidak Hadir</td>
                                        <td>
                                            <a href="{{ route('lansia.pemeriksaan.input', [$li->peserta->id, $tanggal]) }}"
                                               class="btn btn-warning">Periksa</a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>
    <script>
        $(".flatpickr").flatpickr(
            {
                locale: "id"
            }
        );
    </script>
    <script>
        $(document).ready(function () {
            $('#table').DataTable({
                responsive: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/id.json'
                }
            });
        });
    </script>
@endpush
