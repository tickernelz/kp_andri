@extends('layouts.main')

@push('title', 'Ubah Pengaturan')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Pengaturan Website</h4>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <x-alert position="top" message="{{ session('success') }}"
                                 type="success"/>
                    @endif
                    <div class="new-user-info">
                        <form action="{{ route('pengaturan.ubah') }}" method="post">
                            @csrf

                            <div class="row">
                                <x-input-text name="nama_aplikasi" classes="" value="{{ $pengaturan->nama_aplikasi ?? old('nama_aplikasi') }}"
                                              type="" form="" label="Nama Website"/>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('home') }}" class="btn btn-secondary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
@endpush
