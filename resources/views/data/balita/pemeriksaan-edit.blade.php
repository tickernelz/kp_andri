@extends('layouts.main')

@push('title', 'Pemeriksaan Balita')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Pemeriksaan Peserta Balita</h4>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <x-alert position="top" message="{{ session('success') }}"
                                 type="success"/>
                    @endif
                    <div class="new-user-info">
                        <form action="{{ route('balita.pemeriksaan.update', $data->periksa_balitas->first()->id) }}"
                              method="post">
                            @csrf
                            <div class="row mb-4">
                                <div class="form-group">
                                    <label class="form-label">Nama Balita</label>
                                    <input type="text" class="form-control"
                                           value="{{ $data->peserta->nama }}" readonly>
                                </div>
                                <x-flatpickr value="{{ $data->tanggal }}" name="tanggal" label="Tanggal Pemeriksaan"
                                             form="" classes=""/>
                                <x-input-text name="berat_badan" classes=""
                                              value="{{ $data->periksa_balitas->first()->berat_badan }}"
                                              type="number" form="" label="Berat Badan (kg)"/>
                                <x-input-text name="tinggi_badan" classes=""
                                              value="{{ $data->periksa_balitas->first()->tinggi_badan }}"
                                              type="number" form="" label="Tinggi Badan (cm)"/>
                                <x-input-text name="lingkar_kepala" classes=""
                                              value="{{ $data->periksa_balitas->first()->lingkar_kepala }}"
                                              type="number" form="" label="Lingkar Kepala (cm)"/>
                                <x-select classes="" name="imunisasi" label="Imunisasi" form="">
                                    @foreach($imunisasi as $li)
                                        <option @if($data->periksa_balitas->first()->imunisasi_id === $li->id) selected
                                                @endif value="{{ $li->id }}">{{ $li->nama }}</option>
                                    @endforeach
                                </x-select>
                                <x-text-area name="keluhan" classes="" form="" label="Keluhan">
                                    {{ $data->keluhan }}
                                </x-text-area>
                                <x-text-area name="penanganan" classes="" form="" label="Penanganan">
                                    {{ $data->penanganan }}
                                </x-text-area>
                                <x-text-area name="catatan" classes="" form="" label="Catatan">
                                    {{ $data->penanganan }}
                                </x-text-area>
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
