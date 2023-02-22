<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataSiswa extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'data_siswa';
    protected $guarded = [];


    public function Kelas()
    {
        return $this->hasOne('App\Models\Classes\Classes','id','kelas_id');
    }

    public function Asrama()
    {
        return $this->hasOne('App\Models\Asrama\Asrama','id','asrama_id');
    }

    // MULTIPLE KATEGORI ALGORITMA
    public function Kategori()
    {
        return $this->belongsToMany('App\Models\Data\DataKategoriKoneksi','data_kategori_koneksi','data_id','kategori_id')->withPivot('type','type');
    }

    public function Kat()
    {
        return $this->hasMany('App\Models\Data\DataKategoriKoneksi','data_id','id');
    }

    public function getKategori()
    {
        return $this->belongsToMany('App\Models\Data\DataKategori','data_kategori_koneksi','data_id','kategori_id')->withPivot('data_id', 'kategori_id','type');
    }

    // MULTIPLE Status ALGORITMA
    public function Status()
    {
        return $this->belongsToMany('App\Models\Data\DataStatusKoneksi','data_status_koneksi','data_id','status_id');
    }

    public function Sta()
    {
        return $this->hasMany('App\Models\Data\DataStatusKoneksi','data_id','id');
    }

    public function getStatus()
    {
        return $this->belongsToMany('App\Models\Data\DataStatus','data_status_koneksi','data_id','status_id')->withPivot('data_id', 'status_id');
    }

    // MULTIPLE JABATAN ALGORITMA
    public function Jabatan()
    {
        return $this->belongsToMany('App\Models\Data\DataJabatanKoneksi','data_jabatan_koneksi','data_id','jabatan_id');
    }

    public function Jab()
    {
        return $this->hasMany('App\Models\Data\DataJabatanKoneksi','data_id','id');
    }

    public function getJabatan()
    {
        return $this->belongsToMany('App\Models\Data\DataJabatan','data_jabatan_koneksi','data_id','jabatan_id')->withPivot('data_id', 'jabatan_id');
    }

    public function asalKel()
    {
        return $this->hasOne('App\Models\Regions\Desa','id','asal_kel_id');
    }

}
