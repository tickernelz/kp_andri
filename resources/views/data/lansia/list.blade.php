@extends('layouts.main')

@push('title', 'List Lansia')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Tabel Lansia</h4>
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
                                <th>Nama Lansia</th>
                                <th>Alamat</th>
                                <th>Kelamin</th>
                                <th>Tanggal Lahir</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($data_lansia as $li)
                                <tr>
                                    <td>{{ $loop->iteration ?? 'Kosong' }}</td>
                                    <td>{{ $li->peserta->nama ?? 'Kosong' }}</td>
                                    <td>{{ $li->peserta->alamat ?? 'Kosong' }}</td>
                                    <td>{{ $li->peserta->kelamin ?? 'Kosong' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($li->peserta->tanggal_lahir)->formatLocalized('%d %B %Y') ?? 'Kosong' }}</td>
                                    <td>
                                        <form action="{{ route('lansia.destroy', $li->peserta->id) }}" method="post">
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="{{ route('lansia.edit', $li->id) }}"
                                                   class="btn btn-primary">Edit</a>
                                                <a href="{{ route('lansia.detail', $li->id) }}"
                                                   class="btn btn-success">Lihat</a>
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
