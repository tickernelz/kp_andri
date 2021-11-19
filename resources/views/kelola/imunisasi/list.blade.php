@extends('layouts.main')

@push('title', 'List Imunisasi')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Tabel Imunisasi</h4>
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
                                <th>Nama</th>
                                <th>Kegunaan</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($data as $li)
                                <tr>
                                    <td>{{ $loop->iteration ?? 'Kosong' }}</td>
                                    <td>{{ $li->nama ?? 'Kosong' }}</td>
                                    <td>{{ $li->kegunaan ?? 'Kosong' }}</td>
                                    <td>
                                        <form action="{{ route('imunisasi.destroy', $li->id) }}" method="post">
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="{{ route('imunisasi.edit', $li->id) }}"
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
