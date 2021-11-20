@extends('layouts.main')

@push('title', 'Profile')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Profile') }}</h1>

    <div class="row">

        <div class="col-lg-8 order-lg-1">
            <div class="card shadow mb-4">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger border-left-danger" role="alert">
                            <ul class="pl-4 my-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('success'))
                        <x-alert position="top" message="{{ session('success') }}"
                                 type="success"/>
                    @endif
                    <form method="POST" action="{{ route('profile.update') }}" autocomplete="off">
                        @csrf
                        @method('PUT')

                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="nip">NIP<span
                                                class="small text-danger"></span></label>
                                        <input type="text" id="nip" class="form-control" name="nip" placeholder="NIP"
                                               value="{{ old('nip', Auth::user()->nip) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="name">Nama<span
                                                class="small text-danger">*</span></label>
                                        <input type="text" id="nama" class="form-control" name="nama" placeholder="Nama"
                                               value="{{ old('nama', Auth::user()->nama) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="email">Email<span
                                                class="small text-danger"></span></label>
                                        <input type="email" id="email" class="form-control" name="email"
                                               placeholder="example@example.com"
                                               value="{{ old('email', Auth::user()->email) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="hp">No. HP<span
                                                class="small text-danger"></span></label>
                                        <input type="text" id="hp" class="form-control" name="hp" placeholder="No. HP"
                                               value="{{ old('hp', Auth::user()->hp) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="username">Username<span
                                                class="small text-danger">*</span></label>
                                        <input type="text" id="username" class="form-control" name="username"
                                               placeholder="Username"
                                               value="{{ old('username', Auth::user()->username) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="current_password">Password Sekarang</label>
                                        <input type="password" id="current_password" class="form-control"
                                               name="current_password" placeholder="Current password">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="new_password">Password Baru</label>
                                        <input type="password" id="new_password" class="form-control"
                                               name="new_password" placeholder="New password">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="confirm_password">Konfirmasi Password Baru</label>
                                        <input type="password" id="confirm_password" class="form-control"
                                               name="password_confirmation" placeholder="Confirm password">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
@endpush
