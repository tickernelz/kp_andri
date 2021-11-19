@extends('layouts.main')

@push('title', 'List Ibu Hamil')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Tabel Ibu Hamil</h4>
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
                                <th>Nama Ibu Hamil</th>
                                <th>Alamat</th>
                                <th>Tanggal Lahir</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($data as $li)
                                <tr>
                                    <td>{{ $loop->iteration ?? 'Kosong' }}</td>
                                    <td>{{ $li->peserta->nama ?? 'Kosong' }}</td>
                                    <td>{{ $li->peserta->alamat ?? 'Kosong' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($li->peserta->tanggal_lahir)->formatLocalized('%d %B %Y') ?? 'Kosong' }}</td>
                                    <td>
                                        <form action="{{ route('ibu_hamil.destroy', $li->peserta->id) }}" method="post">
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="{{ route('ibu_hamil.edit', $li->id) }}"
                                                   class="btn btn-primary">Edit</a>
                                                <a href="{{ route('ibu_hamil.detail', $li->id) }}"
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
