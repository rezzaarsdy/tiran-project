@extends('layout.app')

@section('content')
<div class="container">
    <h2>Edit Karyawan</h2>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('karyawan.update', $datas->uuid) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Nama --}}
        <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" name="nama" value="{{ old('nama', $datas->nama) }}" required>
        </div>

        {{-- Alamat --}}
        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea class="form-control" name="alamat" required>{{ old('alamat', $datas->alamat) }}</textarea>
        </div>

        {{-- Jenis Kelamin --}}
        <div class="mb-3">
            <label class="form-label">Jenis Kelamin</label>
            <select class="form-select" name="jenis_kelamin" required>
                <option value="">Pilih</option>
                <option value="Laki-laki" {{ $datas->jenis_kelamin == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ $datas->jenis_kelamin == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        {{-- Agama --}}
        <div class="mb-3">
            <label class="form-label">Agama</label>
            <input type="text" class="form-control" name="agama" value="{{ old('agama', $datas->agama) }}" required>
        </div>

        {{-- Avatar --}}
        <div class="mb-3">
            <label class="form-label">Avatar (kosongkan jika tidak ingin mengubah)</label>
            <input type="file" class="form-control" name="avatar">
            @if($datas->avatar)
                <img src="{{ asset('storage/' . $datas->avatar) }}" class="mt-2" height="100" alt="avatar lama">
            @endif
        </div>

        {{-- Tempat & Tanggal Lahir --}}
        <div class="mb-3">
            <label class="form-label">Tempat Lahir</label>
            <input type="text" class="form-control" name="tempat_lahir" value="{{ old('tempat_lahir', $datas->tempat_lahir) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-control" name="tanggal_lahir" value="{{ old('tanggal_lahir', $datas->tanggal_lahir) }}" required>
        </div>

        {{-- Status Perkawinan --}}
        <div class="mb-3">
            <label class="form-label">Status Perkawinan</label>
            <select class="form-select" name="status_perkawinan" required>
                <option value="">Pilih</option>
                <option value="Belum Menikah" {{ $datas->status_perkawinan == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                <option value="Menikah" {{ $datas->status_perkawinan == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                <option value="Cerai" {{ $datas->status_perkawinan == 'Cerai' ? 'selected' : '' }}>Cerai</option>
            </select>
        </div>

        {{-- Detail Karyawan --}}
        <h4 class="mt-4">Detail Karyawan</h4>
        <div class="mb-3">
            <label class="form-label">Motto</label>
            <input type="text" class="form-control" name="detail[motto]" value="{{ old('detail.motto', $datas->detail->motto ?? '') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Pendidikan Terakhir</label>
            <input type="text" class="form-control" name="detail[pendidikan_terakhir]" value="{{ old('detail.pendidikan_terakhir', $datas->detail->pendidikan_terakhir ?? '') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Masuk</label>
            <input type="date" class="form-control" name="detail[tanggal_masuk]" value="{{ old('detail.tanggal_masuk', $datas->detail->tanggal_masuk ?? '') }}">
        </div>

        {{-- Jabatan --}}
        <h4 class="mt-4">Jabatan</h4>
        <div class="mb-3">
            <select name="jabatan_id" class="form-select">
                @foreach ($jabatans as $jabatan)
                    <option value="{{ $jabatan->id }}" {{ $datas->jabatan_id == $jabatan->id ? 'selected' : '' }}>
                        {{ $jabatan->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-4">Submit</button>
    </form>
</div>
@endsection
