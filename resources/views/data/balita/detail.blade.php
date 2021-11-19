@extends('layouts.main')

@push('title', 'List Balita')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Data Balita</h4>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('balita.list') }}" class="btn btn-soft-primary">Kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    <p class="lead">Nama Balita: {{ $data_balita->peserta->nama }}</p>
                    <div class="table-responsive">
                        <table id="table" class="table">
                            <tbody>
                            <tr>
                                <th class="fw-bolder">Nama Ayah</th>
                                <td>:</td>
                                <td>{{ $data_balita->ayah ?? 'Kosong'  }}</td>
                            </tr>
                            <tr>
                                <th class="fw-bolder">Nama Ibu</th>
                                <td>:</td>
                                <td>{{ $data_balita->ibu ?? 'Kosong'  }}</td>
                            </tr>
                            <tr>
                                <th class="fw-bolder">NIK</th>
                                <td>:</td>
                                <td>{{ $data_balita->peserta->nama ?? 'Kosong'  }}</td>
                            </tr>
                            <tr>
                                <th class="fw-bolder">KK</th>
                                <td>:</td>
                                <td>{{ $data_balita->peserta->kk ?? 'Kosong'  }}</td>
                            </tr>
                            <tr>
                                <th class="fw-bolder">Alamat</th>
                                <td>:</td>
                                <td>{{ $data_balita->peserta->alamat ?? 'Kosong'  }}</td>
                            </tr>
                            <tr>
                                <th class="fw-bolder">Kelamin</th>
                                <td>:</td>
                                <td>{{ $data_balita->peserta->kelamin ?? 'Kosong'  }}</td>
                            </tr>
                            <tr>
                                <th class="fw-bolder">Tanggal Lahir</th>
                                <td>:</td>
                                <td>{{ \Carbon\Carbon::parse($data_balita->peserta->tanggal_lahir)->formatLocalized('%d %B %Y') ?? 'Kosong' }}</td>
                            </tr>
                            <tr>
                                <th class="fw-bolder">No. HP</th>
                                <td>:</td>
                                <td>{{ $data_balita->peserta->hp ?? 'Kosong'  }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
@endpush
