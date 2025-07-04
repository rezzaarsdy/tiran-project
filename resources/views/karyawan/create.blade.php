@extends('layout.app')

@section('content')
<div class="container">
    <h2>Tambah Karyawan</h2>
            @if(session('error'))
            <div class="alert alert-custom alert-outline-danger fade show mb-6" role="alert">
                <div class="alert-icon">
                    <i class="flaticon2-checkmark"></i>
                </div>
                <div class="alert-text">
                    <strong>Berhasil !</strong>
                    {{ session('error') }}
                </div>
                <div class="alert-close">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">
                            <i class="ki ki-close"></i>
                        </span>
                    </button>
                </div>
            </div>
        @endif
    <form action="{{ route('karyawan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" name="nama" required>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control" name="alamat" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
            <select class="form-select" name="jenis_kelamin" required>
                <option value="">Pilih</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="agama" class="form-label">Agama</label>
            <input type="text" class="form-control" name="agama" required>
        </div>

        <div class="mb-3">
            <label for="avatar" class="form-label">Avatar</label>
            <input type="file" class="form-control" name="avatar">
        </div>

        <div class="mb-3">
            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
            <input type="text" class="form-control" name="tempat_lahir" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-control" name="tanggal_lahir" required>
        </div>

        <div class="mb-3">
            <label for="status_perkawinan" class="form-label">Status Perkawinan</label>
            <select class="form-select" name="status_perkawinan" required>
                <option value="">Pilih</option>
                <option value="Belum Menikah">Belum Kawin</option>
                <option value="Menikah">Menikah</option>
                <option value="Cerai">Cerai</option>
            </select>
        </div>

        <h4 class="mt-4">Detail Karyawan</h4>
        <div class="mb-3">
            <label for="detail[motto]" class="form-label">Motto</label>
            <input type="text" class="form-control" name="detail[motto]">
        </div>

        <div class="mb-3">
            <label for="detail[pendidikan_terakhir]" class="form-label">Pendidikan Terakhir</label>
            <input type="text" class="form-control" name="detail[pendidikan_terakhir]">
        </div>

        <div class="mb-3">
            <label for="detail[tanggal_masuk]" class="form-label">Tanggal Masuk</label>
            <input type="date" class="form-control" name="detail[tanggal_masuk]">
        </div>

        <h4 class="mt-4">Sosial Media</h4>
        <div id="sosial-media-container">
            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <input type="text" name="sosial_media[0][nama]" class="form-control" placeholder="Nama (cth: Instagram)">
                </div>
                <div class="col-md-8">
                    <input type="text" name="sosial_media[0][link]" class="form-control" placeholder="URL">
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-secondary btn-sm" onclick="addSosialMedia()">Tambah Sosial Media</button>

        <h4 class="mt-4">Riwayat Pendidikan</h4>
        <div id="pendidikan-container">
            <div class="row g-3 mb-3">
                <div class="col-md-3"><input type="text" name="pendidikan[0][nama]" class="form-control" placeholder="Nama Institusi"></div>
                <div class="col-md-2"><input type="text" name="pendidikan[0][jenjang]" class="form-control" placeholder="Jenjang"></div>
                <div class="col-md-3"><input type="text" name="pendidikan[0][jurusan]" class="form-control" placeholder="Jurusan"></div>
                <div class="col-md-2"><input type="date" name="pendidikan[0][tanggal_masuk]" class="form-control"></div>
                <div class="col-md-2"><input type="date" name="pendidikan[0][tanggal_lulus]" class="form-control"></div>
            </div>
        </div>
        <button type="button" class="btn btn-secondary btn-sm" onclick="addPendidikan()">Tambah Pendidikan</button>

        <h4 class="mt-4">Jabatan</h4>
        <div class="mb-3">
            <select name="jabatan_id" class="form-select">
                @foreach ($jabatans as $jabatan)
                    <option value="{{ $jabatan->id }}">{{ $jabatan->nama }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-4">Simpan</button>
    </form>
</div>

{{-- Script untuk tambah sosial media dan pendidikan --}}
<script>
    let sosialIndex = 1;
    function addSosialMedia() {
        const container = document.getElementById('sosial-media-container');
        const html = `
            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <input type="text" name="sosial_media[${sosialIndex}][nama]" class="form-control" placeholder="Nama (cth: Instagram)">
                </div>
                <div class="col-md-8">
                    <input type="text" name="sosial_media[${sosialIndex}][link]" class="form-control" placeholder="URL">
                </div>
            </div>`;
        container.insertAdjacentHTML('beforeend', html);
        sosialIndex++;
    }

    let pendidikanIndex = 1;
    function addPendidikan() {
        const container = document.getElementById('pendidikan-container');
        const html = `
            <div class="row g-3 mb-3">
                <div class="col-md-3"><input type="text" name="pendidikan[${pendidikanIndex}][nama]" class="form-control" placeholder="Nama Institusi"></div>
                <div class="col-md-2"><input type="text" name="pendidikan[${pendidikanIndex}][jenjang]" class="form-control" placeholder="Jenjang"></div>
                <div class="col-md-3"><input type="text" name="pendidikan[${pendidikanIndex}][jurusan]" class="form-control" placeholder="Jurusan"></div>
                <div class="col-md-2"><input type="date" name="pendidikan[${pendidikanIndex}][tanggal_masuk]" class="form-control"></div>
                <div class="col-md-2"><input type="date" name="pendidikan[${pendidikanIndex}][tanggal_lulus]" class="form-control"></div>
            </div>`;
        container.insertAdjacentHTML('beforeend', html);
        pendidikanIndex++;
    }
</script>
@endsection
