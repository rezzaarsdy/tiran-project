<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\RefJabatan;

use Str;
use DB;

class RefJabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jabatan = [
            ['nama' => 'Direktur', 'slug' => Str::slug('Direktur'), 'deskripsi' => 'Jabatan Direktur'],
            ['nama' => 'Asisten Direktur', 'slug' => Str::slug('Asisten Direktur'), 'deskripsi' => 'Jabatan Asisten Direktur'],
            ['nama' => 'Kepala Bagian', 'slug' => Str::slug('Kepala Bagian'), 'deskripsi' => 'Jabatan Kepala Bagian'],
            ['nama' => 'Manager', 'slug' => Str::slug('Manager'), 'deskripsi' => 'Jabatan Manager'],
            ['nama' => 'Supervisor', 'slug' => Str::slug('Supervisor'), 'deskripsi' => 'Jabatan Supervisor'],
            ['nama' => 'Staff', 'slug' => Str::slug('Staff'), 'deskripsi' => 'Jabatan Staff'],
            ['nama' => 'Intern', 'slug' => Str::slug('Intern'), 'deskripsi' => 'Jabatan Intern'],
        ];

        DB::beginTransaction();
        try {
            foreach ($jabatan as $item) {
                RefJabatan::create([
                    'nama' => $item['nama'],
                    'slug' => $item['slug'],
                    'deskripsi' => $item['deskripsi'],
                ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
