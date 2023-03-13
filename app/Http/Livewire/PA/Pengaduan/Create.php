<?php

namespace App\Http\Livewire\PA\Pengaduan;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\MasterData\Jenis;
use App\Models\MasterData\Wilayah;
use App\Models\MasterData\Kategori;
use App\Models\Pengaduan\LogPengaduan;
use App\Models\Pengaduan\PengaduanModel;

class Create extends Component
{
    use WithFileUploads;
    public $perihal, $pengirim, $tgl_pengaduan, $no_pengaduan, $jenis = [], $kategori  = [], $wilayah  = [], $alamat, $penerima, $isi, $scanfile, $lampiran, $catatan;
    public function render()
    {
        $wilData = Wilayah::all();
        $kateData = Kategori::all();
        $jenisData = Jenis::all();

        return view('livewire.p-a.pengaduan.create', [
                'wilData' => $wilData,
                'kateData' => $kateData,
                'jenisData' => $jenisData
            ])
            ->layout('admin.layouts.app')
            ->layoutData([
            'title' => 'Buat Pengaduan'
        ]);
    }

    public function store()
    {

        // dd(
        //     $this->perihal,
        //     $this->pengirim,
        //     $this->tgl_pengaduan,
        //     $this->no_pengaduan,
        //     $this->kategori,
        //     $this->wilayah,
        //     $this->alamat,
        //     $this->penerima,
        //     $this->isi,
        //     $this->scanfile,
        //     $this->lampiran,
        //     $this->catatan,
        // );

        $validasi = $this->validate([
            'perihal' => 'required',
            'pengirim' => 'required',
            'tgl_pengaduan' => 'required|date',
            'no_pengaduan' => 'required',
            'kategori' => 'required',
            'wilayah' => 'required',
            'jenis' => 'required',
            'alamat' => 'required',
            'penerima' => 'required',
            'isi' => 'required',
            // 'scanfile' => 'required|image|mimes:jpeg,png,jpg,gif,svg,pdf.doc,docx|max:5120',
            // 'lampiran' => 'required|image|mimes:jpeg,png,jpg,gif,svg,pdf.doc,docx|max:5120',
        ], [], [
            'perihal' => 'Perihal',
            'pengirim' => 'Pengirim',
            'tgl_pengaduan' => 'Tanggal Pengaduan',
            'no_pengaduan' => 'No Pengaduan',
            'kategori' => 'Kategori',
            'wilayah' => 'Wilayah',
            'jenis' => 'Jenis',
            'alamat' => 'Alamat',
            'penerima' => 'Penerima',
            'isi' => 'Isi',
            // 'scanfile' => 'Scan File',
            // 'lampiran' => 'Lampiran',
        ]);

        if ($validasi) {
            $data = new PengaduanModel;
            $data->perihal = $this->perihal;
            $data->pengirim = $this->pengirim;
            $data->tgl_pengaduan = $this->tgl_pengaduan;
            $data->no_pengaduan = $this->no_pengaduan;

            $data->alamat = $this->alamat;

            //penerima
            $data->penerima = $this->penerima;

            $data->isi = $this->isi;

            //scanfile
            if ($this->scanfile) {
                $dataScanfile = [];
                foreach ($this->scanfile as $key => $scanfile) {
                    $filename = time() . $key . '.' . $scanfile->getClientOriginalExtension();
                    $scanfile->storeAs('pengaduan/scanfile', $filename, 'public');
                    $dataScanfile[] = $filename;
                }
                $data->scanfile = json_encode($dataScanfile);
            }

            //lampiran
            if ($this->lampiran) {
                $dataLampiran = [];
                foreach ($this->lampiran as $key => $lampiran) {
                    $filename = time() . $key . '.' . $lampiran->getClientOriginalExtension();
                    $lampiran->storeAs('pengaduan/lampiran', $filename, 'public');
                    $dataLampiran[] = $filename;
                }
                $data->lampiran = json_encode($dataLampiran);
            }

            $data->catatan = $this->catatan;


            $data->save();

            //kategori
            if ($data) {
                $kategoriNames = $this->kategori;
                $katIds = [];

                foreach ($kategoriNames as $kategoriName) {
                    $kat = Kategori::firstOrCreate([
                        'name' => $kategoriName,
                    ]);

                    if ($kat) {
                        $katIds[] = $kat->id;
                    }
                }
                $data->getKategori()->sync($katIds);
            }

            //wiilayah
            if ($data) {
                $wilayahNames = $this->wilayah;
                $wilIds = [];

                foreach ($wilayahNames as $wilayahName) {
                    $wil = Wilayah::firstOrCreate([
                        'name' => $wilayahName,
                    ]);

                    if ($wil) {
                        $wilIds[] = $wil->id;
                    }

                }
                $data->getWilayah()->sync($wilIds);
            }

            //Jenis
            if ($data) {
                $jenisNames = $this->jenis;
                $jenIds = [];

                foreach ($jenisNames as $jenisName) {
                    $jen = Jenis::firstOrCreate([
                        'name' => $jenisName,
                    ]);

                    if ($jen) {
                        $jenIds[] = $jen->id;
                    }
                }
                $data->getJenis()->sync($jenIds);
            }

            // Save to log pengaduan
            $log = new LogPengaduan;
            $log->pengaduan_id = $data->id;
            $log->status_log = 'Pengaduan dibuat oleh admin';
            $log->tgl_log = Carbon::now();
            $log->save();

            $this->showToastr('success', 'Berhasil!', 'Pengaduan berhasil ditambahkan.');
        }
    }

    public function resetForm()
    {
        $this->perihal = null;
        $this->pengirim = null;
        $this->tgl_pengaduan = null;
        $this->no_pengaduan = null;
        $this->kategori = null;
        $this->wilayah = null;
        $this->alamat = null;
        $this->penerima = null;
        $this->isi = null;
        $this->scanfile = null;
        $this->lampiran = null;
        $this->catatan = null;
    }

    // SWEETALERT
    public function showAlert($icon, $title, $text)
    {
        $this->emit('swal:modal', [
            'icon'  => $icon,
            'title' => $title,
            'text'  => $text,
        ]);
    }

    // TOASTR
    public function showToastr($icon, $title, $text)
    {
        $this->emit('swal:alert', [
            'icon'    => $icon,
            'title'   => $title,
            'text'   => $text,
            'timeout' => 10000
        ]);
    }
}
