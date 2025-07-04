@extends('layout.app')
@section('content')
    <div class="d-flex justify-content-between">
        <h2 class="mb-4">Daftar Karyawan</h2>
        <a href="{{ route('karyawan.create') }}" class="btn btn-primary mb-4">Tambah Data</a>
    </div>
        <div class="mb-3">
            <form action="{{ route('karyawan.index') }}" method="GET">
                <input type="text" name="key" id="searchInput" class="form-control" placeholder="Cari nama karyawan...">
            </form>
        </div>

        @if(session('success'))
        <div class="alert alert-success alert-outline-success fade show mb-6" role="alert">
            <div class="alert-icon">
                <i class="flaticon2-checkmark"></i>
            </div>
            <div class="alert-text">
                <strong>Berhasil !</strong>
                {{ session('success') }}
            </div>
        </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-outline-success fade show mb-6" role="alert">
                <div class="alert-icon">
                    <i class="flaticon2-checkmark"></i>
                </div>
                <div class="alert-text">
                    <strong>Berhasil !</strong>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <table class="table table-striped" id="karyawanTable">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Sosial Media</th>
                    <th>Avatar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $karyawan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $karyawan->nama }}</td>
                        <td>{{ $karyawan->jabatan->nama }}</td>
                        <td>
                            @foreach ($karyawan->sosialMedia as $item)
                                - {{ $item->nama }}: <a href="{{ $item->link }}" target="_blank">{{ $item->link }}</a><br>
                            @endforeach
                        </td>
                        <td>
                            @if($karyawan->avatar)
                                <img src="{{ asset('storage/' . $karyawan->avatar) }}" class="mt-2" height="100" alt="avatar lama">
                            @endif
                        </td>
                        <td>
                            {{-- <a href="{{ route('karyawan.show', $karyawan->uuid) }}" class="btn btn-sm btn-info">Lihat</a> --}}
                            <a href="{{ route('karyawan.edit', $karyawan->uuid) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('karyawan.destroy', $karyawan->uuid) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
@endsection