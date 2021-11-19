@extends('layouts.main')

@push('title', 'Pemeriksaan Lansia')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Pemeriksaan Peserta Lansia</h4>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <x-alert position="top" message="{{ session('success') }}"
                                 type="success"/>
                    @endif
                    <div class="new-user-info">
                        <form action="{{ route('lansia.pemeriksaan.store', [$data->peserta->id, $tanggal]) }}" method="post">
                            @csrf
                            <div class="row mb-4">
                                <div class="form-group">
                                    <label class="form-label">Nama Lansia</label>
                                    <input type="text" class="form-control"
                                           value="{{ $data->peserta->nama }}" readonly>
                                </div>
                                <x-flatpickr value="{{ $tanggal }}" name="tanggal" label="Tanggal Pemeriksaan" form="" classes=""/>
                                <x-input-text name="berat_badan" classes="" value=""
                                              type="" form="" label="Berat Badan (kg)"/>
                                <x-input-text name="tekanan_darah" classes="" value=""
                                              type="" form="" label="Tekanan Darah"/>
                                <x-input-text name="gula_darah" classes="" value=""
                                              type="" form="" label="Gula Darah"/>
                                <x-input-text name="kolesterol" classes="" value=""
                                              type="" form="" label="Kolesterol"/>
                                <x-input-text name="asam_urat" classes="" value=""
                                              type="" form="" label="Asam Urat"/>
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
