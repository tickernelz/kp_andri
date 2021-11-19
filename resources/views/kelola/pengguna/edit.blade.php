@extends('layouts.main')

@push('title', 'Edit Pengguna')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Informasi Pengguna</h4>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <x-alert position="top" message="{{ session('success') }}"
                                 type="success"/>
                    @endif
                    <div class="new-user-info">
                        <form action="{{ route('pengguna.update', $user->id) }}" method="post">
                            @csrf
                            @method('put')

                            <div class="row">
                                <x-input-text name="nip" classes="" value="{{ $user->nip }}"
                                              type="number" form="" label="NIP">
                                </x-input-text>

                                <x-input-text name="nama" classes="" value="{{ $user->nama }}"
                                              type="" form="" label="Nama">
                                </x-input-text>

                                <x-input-text name="hp" classes="" value="{{ $user->hp }}"
                                              type="number" form="" label="No. HP">
                                </x-input-text>

                                <x-select form="" name="peran" label="Peran" classes="">
                                    @foreach($roles as $li)
                                        <option @if($user->roles->first()->id == $li->id) selected
                                                @endif value="{{ $li->id }}">{{ $li->name }}</option>
                                    @endforeach
                                </x-select>

                                <x-input-text name="email" form="" classes="" value="{{ $user->email }}"
                                              type="email" label="Email">
                                </x-input-text>
                            </div>
                            <hr>
                            <h5 class="mb-3">Keamanan</h5>
                            <div class="row">
                                <x-input-text name="username" form="" classes="" value="{{ $user->username }}"
                                              type="" label="Username">
                                </x-input-text>

                                <x-input-text name="password" form="" classes="" value=""
                                              type="password" label="Password">
                                </x-input-text>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('pengguna.index') }}" class="btn btn-secondary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
@endpush
