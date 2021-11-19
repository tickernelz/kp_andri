@extends('layouts.main')

@push('title', 'Edit Imunisasi')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Informasi Imunisasi</h4>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <x-alert position="top" message="{{ session('success') }}"
                                 type="success"/>
                    @endif
                    <div class="new-user-info">
                        <form action="{{ route('imunisasi.update', $data->id) }}" method="post">
                            @csrf
                            @method('put')

                            <div class="row">
                                <x-input-text name="nama" classes="" value="{{ $data->nama }}"
                                              type="" form="" label="Nama"/>

                                <x-input-text name="kegunaan" classes="" value="{{ $data->kegunaan }}"
                                              type="" form="" label="Kegunaan"/>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('imunisasi.index') }}" class="btn btn-secondary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
@endpush
