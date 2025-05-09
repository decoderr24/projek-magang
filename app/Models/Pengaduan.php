<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan';
    protected $primaryKey = 'id_pengaduan';

    protected $fillable = [
        'tgl_pengaduan',
        'nik',
        'judul_laporan',
        'isi_laporan',
        'tgl_kejadian',
        'lokasi_kejadian',
        'foto',
        'status',
    ];

    public function user() {
        return $this->hasOne(Masyarakat::class, 'nik', 'nik');
    }

    public function getFotoAttribute($value)
    {
        if ($value) {
            return $value; // Return the path as stored in database
        }
        return null;
    }

    public function setFotoAttribute($value)
    {
        // Only store the path, not the full URL
        if ($value && !filter_var($value, FILTER_VALIDATE_URL)) {
            $this->attributes['foto'] = $value;
        }
    }
}
