<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Narsum extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id_narsum';
    protected $fillable = [
        'nama_narsum',
        'no_tlp',
        'nip',
        'jabatan',
        'status',
        'email',
        'nama_bank',
        'nama_rek',
        'no_rek',
        'npwp',
        'upload_npwp',
        'golongan',
        'eselon',
        'pajak',
        'unit_kerja',
        'alamat_unit',
];
}
