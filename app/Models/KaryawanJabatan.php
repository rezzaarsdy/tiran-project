<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KaryawanJabatan extends Model
{
    use HasFactory;
        protected $guarded = [];

        public function ref_jabatan()
        {
            return $this->belongsTo(RefJabatan::class);
        }
}
