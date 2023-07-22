<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_induk',
        'tanggal_cuti',
        'lama_cuti',
        'keterangan'
    ];

    public function Karyawan()
    {
        return $this->hasMany(Karyawan::class, 'nomor_induk');
    }
}
