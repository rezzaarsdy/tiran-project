<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Str;

class Karyawan extends Model
{
    use HasFactory;
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($table){
            $table->uuid = (string) Str::uuid();
        });
    }

    public function detail() {
        return $this->hasOne(KaryawanDetail::class, 'karyawan_id');
    }

    public function sosialMedia() {
        return $this->hasMany(KaryawanSosialMedia::class, 'karyawan_id');
    }

    public function pendidikan() {
        return $this->hasMany(KaryawanPendidikan::class, 'karyawan_id');
    }

    public function jabatan() {
        return $this->belongsTo(RefJabatan::class, 'jabatan_id', 'id');
    }
}
