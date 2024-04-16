<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $fillable = [
            'id_kegiatan',
            'biro',
            'bagian',
            'program',
            'kode_mak',
            'kegiatan_mak',
            'ta',
            'nama_kegiatan',
            'no_und',
            'tanggal',
            'lokasi',
            'waktu',
            'maksud',
            'nama_narsum',
            'jml_jam',
            'golongan',
            'eselon',
            'pajak',
            'f_und',
            'f_lapkeg',
            'f_st',
            'status_input',
            'status_trf',
            'status_verif', 
    ];
}
