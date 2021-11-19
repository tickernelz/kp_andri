@extends('layouts.main')

@push('title', 'List Lansia')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Data Lansia</h4>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('lansia.list') }}" class="btn btn-soft-primary">Kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    <p class="lead">Nama Lansia: {{ $data_lansia->peserta->nama }}</p>
                    <div class="table-responsive">
                        <table id="table" class="table">
                            <tbody>
                            <tr>
                                <th class="fw-bolder">Golongan Darah</th>
                                <td>:</td>
                                <td>{{ $data_lansia->golongan_darah ?? 'Kosong'  }}</td>
                            </tr>
                            <tr>
                                <th class="fw-bolder">Riwayat Penyakit</th>
                                <td>:</td>
                                <td>{{ $data_lansia->riwayat_penyakit ?? 'Kosong'  }}</td>
                            </tr>
                            <tr>
                                <th class="fw-bolder">Riwayat Alergi</th>
                                <td>:</td>
                                <td>{{ $data_lansia->riwayat_alergi ?? 'Kosong'  }}</td>
                            </tr>
                            <tr>
                                <th class="fw-bolder">NIK</th>
                                <td>:</td>
                                <td>{{ $data_lansia->peserta->nama ?? 'Kosong'  }}</td>
                            </tr>
                            <tr>
                                <th class="fw-bolder">KK</th>
                                <td>:</td>
                                <td>{{ $data_lansia->peserta->kk ?? 'Kosong'  }}</td>
                            </tr>
                            <tr>
                                <th class="fw-bolder">Alamat</th>
                                <td>:</td>
                                <td>{{ $data_lansia->peserta->alamat ?? 'Kosong'  }}</td>
                            </tr>
                            <tr>
                                <th class="fw-bolder">Kelamin</th>
                                <td>:</td>
                                <td>{{ $data_lansia->peserta->kelamin ?? 'Kosong'  }}</td>
                            </tr>
                            <tr>
                                <th class="fw-bolder">Tanggal Lahir</th>
                                <td>:</td>
                                <td>{{ \Carbon\Carbon::parse($data_lansia->peserta->tanggal_lahir)->formatLocalized('%d %B %Y') ?? 'Kosong' }}</td>
                            </tr>
                            <tr>
                                <th class="fw-bolder">No. HP</th>
                                <td>:</td>
                                <td>{{ $data_lansia->peserta->hp ?? 'Kosong'  }}</td>
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
