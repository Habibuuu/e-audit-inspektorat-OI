<?php

namespace App\Models\Pengaduan;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PengaduanModel extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'pengaduan';
    protected $fillable = [
        'perihal',
        'pengirim',
        'tgl_pengaduan',
        'no_pengaduan',
        'alamat',
        'penerima',
        'isi',
        'scanfile',
        'lampiran',
        'catatan',
        'surat_tugas',
    ];

    public function getWilayah()
    {
        return $this->belongsToMany('App\Models\MasterData\Wilayah', 'pengaduan_con_wilayah', 'pengaduan_id', 'wilayah_id')->withPivot('pengaduan_id', 'wilayah_id');
    }

    public function getKategori()
    {
        return $this->belongsToMany('App\Models\MasterData\Kategori', 'pengaduan_con_kategori', 'pengaduan_id', 'kategori_id')->withPivot('pengaduan_id', 'kategori_id');
    }

    public function getJenis()
    {
        return $this->belongsToMany('App\Models\MasterData\Jenis', 'pengaduan_con_jenis', 'pengaduan_id', 'jenis_id')->withPivot('pengaduan_id', 'jenis_id');
    }
}
