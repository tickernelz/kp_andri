@extends('layouts.main')

@push('title', 'Pendaftaran Lansia')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Pendaftaran Peserta Baru Lansia</h4>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <x-alert position="top" message="{{ session('success') }}"
                                 type="success"/>
                    @endif
                    <div class="new-user-info">
                        <form action="{{ route('lansia.pendaftaran.post') }}" method="post">
                            @csrf
                            <div class="row mb-4">
                                <x-input-text name="nama" classes="" value=""
                                              type="" form="" label="Nama Lansia"/>
                                <x-input-text name="nik" classes="" value=""
                                              type="" form="" label="Nomor Induk Kependudukan"/>
                                <x-input-text name="kk" classes="" value=""
                                              type="" form="" label="Nomor Kartu Keluarga"/>
                                <x-text-area name="alamat" classes="" form="" label="Alamat"/>
                                <div class="form-group">
                                    <label class="form-label">Jenis Kelamin</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="Laki-Laki"
                                               name="kelamin" id="Laki-Laki" checked>
                                        <label class="form-check-label" for="Laki-Laki">
                                            Laki-Laki
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="Perempuan"
                                               name="kelamin" id="Perempuan">
                                        <label class="form-check-label" for="Perempuan">
                                            Perempuan
                                        </label>
                                    </div>
                                </div>
                                <x-flatpickr value="" name="tanggal_lahir" label="Tanggal Lahir" form="" classes=""/>
                                <x-input-text name="hp" classes="" value=""
                                              type="number" form="" label="No. HP"/>
                                <x-input-text name="golongan_darah" classes="" value=""
                                              type="" form="" label="Golongan Darah"/>
                                <x-text-area name="riwayat_penyakit" classes="" form="" label="Riwayat Penyakit"/>
                                <x-text-area name="riwayat_alergi" classes="" form="" label="Riwayat Alergi"/>
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
