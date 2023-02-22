<?php

namespace App\Http\Controllers\Pub;

use App\Http\Controllers\Controller;
use App\Models\Asrama\Asrama;
use App\Models\Classes\Classes;
use App\Models\Data\DataJabatan;
use App\Models\Data\DataKategori;
use App\Models\Data\DataSiswa;
use App\Models\Settings\WebsIdentity;
use Illuminate\Http\Request;

class DatabaseController extends Controller
{
    public function index()
    {
        $identity = WebsIdentity::find(1);
        $arrKategori = DataKategori::orderBy('name')->get();
        $arrRanks = DataJabatan::orderBy('name')->get();
        $arrKelas = Classes::orderBy('name')->get();
        $arrAsrama = Asrama::orderBy('name')->get();

        $keywordTipe = '';
        $keywordAsrama = '';
        $keywordJabatan = '';
        $keywordClass = '';
        $keywordName = '';
        $keywordKategori = '';


        $datas = DataSiswa::orderBy('nama_lengkap')->select([
            '*'
            // 'id',
            // 'nama_lengkap',
            // 'kelas_id',
            // 'asrama_id',
            // 'deleted_at'
            ])->get();
            // dd($datas);

        return view('public.data.index', [
            'identity' => $identity,
            'datas' => $datas,
            'arrKategori' => $arrKategori,
            'arrRanks' => $arrRanks,
            'arrKelas' => $arrKelas,
            'arrAsrama' => $arrAsrama,
            'keywordName' => $keywordName,
            'keywordTipe' => $keywordTipe,
            'keywordJabatan' => $keywordJabatan,
            'keywordKategori' => $keywordKategori,
            'keywordClass' => $keywordClass,
            'keywordAsrama' => $keywordAsrama,
        ]);
    }

    public function filtered(Request $request)
    {
        $keywordName = $request->nama;
        $keywordTipe = $request->tipe;
        $keywordKategori = $request->kategori;
        $keywordClass = $request->kelas;
        $keywordAsrama = $request->asrama;
        $keywordJabatan = $request->jabatan;
        // dd($keywordKategori);

        $datas = DataSiswa::latest();

        if ($keywordKategori) {
            $datas = $datas->whereHas('getKategori', function($q) use ($keywordKategori){
                $q->where('kategori_id', $keywordKategori);
            });
        }

        if ($keywordJabatan) {
            $datas = $datas->whereHas('getJabatan', function($q) use ($keywordJabatan){
                $q->where('jabatan_id', $keywordJabatan);
            });
        }

        if ($keywordTipe) {
            $datas = $datas->where('type', $keywordTipe);
        }

        if ($keywordName) {
            $datas = $datas->where('nama_lengkap', 'like', '%' . $keywordName . '%');
        }

        if ($keywordClass) {
            $datas = $datas->where('kelas_id', $keywordClass);
        }

        if ($keywordAsrama) {
            $datas = $datas->where('asrama_id', $keywordAsrama);
        }

        $datas = $datas->paginate(10);

        $datas->appends(
            ['nama' => $request->nama],
            ['tipe' => $request->tipe],
            ['jenis' => $request->jenis],
            ['jabatan' => $request->jabatan],
            ['kelas' => $request->kelas],
            ['asrama' => $request->asrama],
        );

        $arrKategori = DataKategori::orderBy('name')->get();
        $arrRanks = DataJabatan::orderBy('name')->get();
        $arrKelas = Classes::orderBy('name')->get();
        $arrAsrama = Asrama::orderBy('name')->get();

        $identity = WebsIdentity::find(1);


        return view('public.data.index', [
            'identity' => $identity,
            'datas' => $datas,
            'arrKategori' => $arrKategori,
            'arrRanks' => $arrRanks,
            'arrKelas' => $arrKelas,
            'arrAsrama' => $arrAsrama,
            'keywordName' => $keywordName,
            'keywordTipe' => $keywordTipe,
            'keywordJabatan' => $keywordJabatan,
            'keywordKategori' => $keywordKategori,
            'keywordClass' => $keywordClass,
            'keywordAsrama' => $keywordAsrama,
        ]);
    }

    public function detail($id)
    {
        $data = DataSiswa::findOrFail($id);
        $identity = WebsIdentity::find(1);

        return view('public.data.detail',[
            'identity' => $identity,
            'data' => $data,
        ]);
    }

    public function statistics()
    {
        $arrKategori = DataKategori::orderBy('name')->get();
        $arrRanks = DataJabatan::orderBy('name')->get();
        $arrKelas = Classes::orderBy('name')->get();
        $arrAsrama = Asrama::orderBy('name')->get();

        $identity = WebsIdentity::find(1);
        return view('public.statistics.index',[
            'arrKategori' => $arrKategori,
            'arrRanks' => $arrRanks,
            'arrKelas' => $arrKelas,
            'arrAsrama' => $arrAsrama,
            'identity' => $identity,
        ]);
    }
}
