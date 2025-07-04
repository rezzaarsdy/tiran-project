<?php

namespace App\Repositories;

use App\Models\Karyawan;

use Str;
use DB;

class KaryawanRepository {
    public function list() {
        $data = Karyawan::with(['detail', 'sosialMedia', 'jabatan'])
            ->orderBy('created_at', 'desc')
            ->get();

        return $data;
    }

    public function getByFilter($request) {
        $data = Karyawan::with(['detail', 'sosialMedia', 'jabatan'])
            ->orderBy('created_at', 'desc');

        if($request->key) {
            $data = $data->whereRaw('LOWER(nama)', 'LIKE', '%' . strtolower($request->key) . '%');
        }

        return $data->get();
    }

    public function findByUuid($uuid) {
        $data = Karyawan::with(['detail', 'sosialMedia', 'jabatan'])
            ->where('uuid', $uuid)
            ->first();

        if (!$data) {
            return null;
        }

        return $data;
    }

    public function findById($id) {
        $data = Karyawan::with(['detail', 'sosialMedia', 'jabatan'])
            ->where('id', $id)
            ->first();

        if (!$data) {
            return null;
        }

        return $data;
    }

    public function storeData($request, $uuid) {
        if($uuid) {
            $data = $this->findByUuid($uuid);
        } else {
            $data = new Karyawan();
        }
        $data->nama = $request->nama;
        $data->alamat = $request->alamat;
        $data->jabatan_id = $request->jabatan_id;
        $data->jenis_kelamin = $request->jenis_kelamin;
        $data->agama = $request->agama;
        $data->avatar = $request->avatar;
        $data->tanggal_lahir = $request->tanggal_lahir;
        $data->tempat_lahir = $request->tempat_lahir;
        $data->status_perkawinan = $request->status_perkawinan;
        $data->status = 'aktif';
        $data->save();

        if($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $data->avatar = $avatarPath;
            $data->save();
        }

        if ($request->has('detail')) {
            $detailData = [
                'karyawan_id' => $data->id,
                'motto' => $request->detail['motto'],
                'pendidikan_terakhir' => $request->detail['pendidikan_terakhir'],
                'tanggal_masuk' => $request->detail['tanggal_masuk'],
            ];
            $data->detail()->create($detailData);
        }

        if ($request->has('sosial_media')) {
            foreach ($request->sosial_media as $sosialMedia) {
                $data->sosialMedia()->create([
                    'nama' => $sosialMedia['nama'],
                    'link' => $sosialMedia['link'],
                ]);
            }
        }

        if($request->has('pendidikan')) {
            foreach ($request->pendidikan as $pendidikan) {
                $data->pendidikan()->create([
                    'nama' => $pendidikan['nama'],
                    'jenjang' => $pendidikan['jenjang'],
                    'jurusan' => $pendidikan['jurusan'],
                    'tanggal_masuk' => $pendidikan['tanggal_masuk'],
                    'tanggal_lulus' => $pendidikan['tanggal_lulus'],
                ]);
            }
        }

        return $this->findById($data->id);
    }
}