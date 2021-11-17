@extends('layouts.main')

@push('title', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Tabel Pengguna</h4>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('message'))
                        <x-alert position="top" message="{{ session('message') }}"
                                 type="success"/>
                    @endif
                    <div class="table-responsive">
                        <table id="table" class="table table-striped text-center">
                            <thead>
                            <tr>
                                <th style="width: 5%">#</th>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No. HP</th>
                                <th>Peran</th>
                                <th>Username</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration ?? 'Kosong' }}</td>
                                    <td>{{ $user->nip ?? 'Kosong' }}</td>
                                    <td>{{ $user->nama ?? 'Kosong' }}</td>
                                    <td>{{ $user->email ?? 'Kosong' }}</td>
                                    <td>{{ $user->hp ?? 'Kosong' }}</td>
                                    <td>{{ $user->roles->first()->name ?? 'Kosong' }}</td>
                                    <td>{{ $user->username ?? 'Kosong' }}</td>
                                    <td>
                                        <form action="{{ route('pengguna.destroy', $user->id) }}" method="post">
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="{{ route('pengguna.edit', $user->id) }}"
                                                   class="btn btn-primary">Edit</a>
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Yakin Mau Dihapus?')">Hapus
                                                </button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            $('#table').DataTable({
                responsive: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/id.json'
                }
            });
        });
    </script>
@endpush
