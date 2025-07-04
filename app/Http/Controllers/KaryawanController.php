<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\KaryawanRepository;
use App\Models\RefJabatan;

use DB;
use Str;

class KaryawanController extends Controller
{
    public function __construct() {
        // fuadf.512@gmail.com
        $this->repo = new KaryawanRepository();
    }

    public function index(Request $request) {
        $data = [
            'datas' => $this->repo->getByFilter($request),
            'title' => 'Daftar Karyawan',
        ];

        return view('karyawan.index', $data);
    }

    public function create () {
        $data = [
            'jabatans' => RefJabatan::all(),
            'title' => 'Tambah Karyawan',
        ];

        return view('karyawan.create', $data);
    }

    public function store(Request $request) {
        DB::beginTransaction();
        try {
            $data = $this->repo->storeData($request, $uuid = null);

            DB::commit();
            return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menambahkan karyawan: ' . $e->getMessage());
        }
    }

    public function edit($uuid) {
        $data = [
            'jabatans' => RefJabatan::all(),
            'datas' => $this->repo->findByUuid($uuid),
            'title' => 'Edit Karyawan',
        ];

        return view('karyawan.edit', $data);
    }

    public function update(Request $request, $uuid) {
        // $this->validate($request, [
        //     'nama' => 'required|string|max:255',
        //     'alamat' => 'required|string|max:255',
        //     'jabatan' => 'required|string|max:100',
        //     'jenis_kelamin' => 'required|in:L,P',
        //     'agama' => 'required|string|max:50',
        //     'tanggal_lahir' => 'required|date',
        //     'tempat_lahir' => 'required|string|max:100',
        //     'status_perkawinan' => 'required|in:belum_kawin,kawin,ceraikan,meninggal dunia',
        //     'pendidikan_terakhir' => 'nullable|string|max:100',
        //     'tahun_lulus' => 'nullable|integer|min:1900|max:' . date('Y'),
        //     'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);

        DB::beginTransaction();
        try {
            $this->repo->storeData($request, $uuid);
            DB::commit();
            return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal memperbarui karyawan: ' . $e->getMessage());
        }
    }

    public function destroy($uuid) {
        DB::beginTransaction();
        try {
            $data = $this->repo->findByUuid($uuid);
            $data->delete();
            DB::commit();
            return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menghapus karyawan: ' . $e->getMessage());
        }
    }
}
