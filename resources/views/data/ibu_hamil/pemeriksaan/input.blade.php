@extends('layouts.main')

@push('title', 'Pemeriksaan Ibu Hamil')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Pemeriksaan Peserta Ibu Hamil</h4>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <x-alert position="top" message="{{ session('success') }}"
                                 type="success"/>
                    @endif
                    <div class="new-user-info">
                        <form action="{{ route('ibu_hamil.pemeriksaan.store', [$data->peserta->id, $tanggal]) }}" method="post">
                            @csrf
                            <div class="row mb-4">
                                <div class="form-group">
                                    <label class="form-label">Nama Ibu Hamil</label>
                                    <input type="text" class="form-control"
                                           value="{{ $data->peserta->nama }}" readonly>
                                </div>
                                <x-flatpickr value="{{ $tanggal }}" name="tanggal" label="Tanggal Pemeriksaan" form="" classes=""/>
                                <x-input-text name="berat_badan" classes="" value=""
                                              type="" form="" label="Berat Badan (kg)"/>
                                <x-input-text name="tekanan_darah" classes="" value=""
                                              type="" form="" label="Tekanan Darah"/>
                                <x-input-text name="bulan_kehamilan" classes="" value=""
                                              type="" form="" label="Bulan Kehamilan"/>
                                <x-input-text name="tinggi_fundus" classes="" value=""
                                              type="" form="" label="Tinggi Fundus"/>
                                <x-input-text name="denyut_jantung_janin" classes="" value=""
                                              type="" form="" label="Denyut Jantung Janin"/>
                                <x-input-text name="lingkar_lengan_atas" classes="" value=""
                                              type="" form="" label="Lingkar Lengan Atas"/>
                                <x-text-area name="keluhan" classes="" form="" label="Keluhan"/>
                                <x-text-area name="penanganan" classes="" form="" label="Penanganan"/>
                                <x-text-area name="catatan" classes="" form="" label="Catatan"/>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
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
        $(".flatpickr").flatpickr(
            {
                locale: "id"
            }
        );
    </script>
@endpush
