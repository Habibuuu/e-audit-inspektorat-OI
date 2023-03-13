<?php

namespace App\Http\Livewire\PA\Pengaduan\Disposisi;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use App\Models\Pengaduan\LogPengaduan;
use App\Models\Pengaduan\PengaduanModel;

class Detail extends Component
{
    public $pengaduanId, $perihal, $pengirim, $tgl_pengaduan, $no_pengaduan, $status, $alasantolak, $disposisi, $kategori = [], $datkat, $wilayah = [], $datwil, $alamat, $penerima, $isi, $scanfile, $scanPrev, $lampiran, $lampiranPrev, $catatan, $instruksi = [], $catatandis, $created_at;
    protected $listeners = [
        'appointments:delete' => 'delete',
    ];
    public $updateMode = false;

    public function mount($id)
    {
        $data = PengaduanModel::findOrFail($id);
        if ($data) {
            $this->pengaduanId = $data->id;
            $this->perihal = $data->perihal;
            $this->pengirim = $data->pengirim;
            $this->tgl_pengaduan = $data->tgl_pengaduan;
            $this->no_pengaduan = $data->no_pengaduan;
            $this->status = $data->status;
            $this->disposisi = $data->disposisi;
            $this->penerima = $data->penerima;
            $this->isi = $data->isi;
            $this->catatan = $data->catatan;
            $this->datkat = $data->getKategori;
            $this->datwil = $data->getWilayah;
            $this->alamat = $data->alamat;
            $this->isi = $data->isi;
            $this->catatan = $data->catatan;
            $this->scanPrev = collect(json_decode($data->scanfile));
            $this->lampiranPrev = collect(json_decode($data->lampiran));
            $this->	created_at = $data->created_at;
        }
    }

    public function render()
    {
        $datas = User::where('role_id', 5)->get();
        $datalog = LogPengaduan::where('pengaduan_id', $this->pengaduanId)->get();

        // dd($datalog);
        return view('livewire.p-a.pengaduan.disposisi.detail', [
                'datas' => $datas,
                'datalog' => $datalog
            ])
            ->layout('admin.layouts.app')
            ->layoutData([
            'title' => 'Detail Pengaduan'
        ]);
    }

    public function reject($id)
    {
        $this->updateMode = true;
        $data = PengaduanModel::findOrFail($id);
        $this->alasantolak = $data->alasantolak;
    }

    public function disposisiPengaduan($id)
    {
        $this->updateMode = true;
        $data = PengaduanModel::findOrFail($id);
        $this->disposisi = $data->disposisi;
    }

    public function cancel()
    {
        $this->updateMode = false;
    }

    public function updateAlasan()
    {

        if ($this->pengaduanId) {
            $data = PengaduanModel::findorFail($this->pengaduanId);
            $oldStatus = $data->status;
            if ($oldStatus == 'belum_diverifikasi') {
                $data->status = 'ditolak';
            }
            $data->alasantolak = $this->alasantolak;
            $data->save();

            $this->updateMode = false;
            $this->showToastr('success', 'Berhasil', 'Pengaduan ditolak!');
            $this->emit('closeModal'); // Close model to using to jquery

            return redirect()->route('admin.pengaduan.disposisi.index');
        }
    }

    public function updateDisposisi()
    {

        if ($this->pengaduanId) {
            $data = PengaduanModel::findorFail($this->pengaduanId);
            $data->disposisi = $this->disposisi;
            $data->instruksi = $this->instruksi;
            $data->catatandis = $this->catatandis;
            $data->save();

            $log = new LogPengaduan;
            $log->pengaduan_id = $data->id;
            $log->status_log = 'Pengaduan di disposisikan oleh Irban';
            $log->tgl_log = Carbon::now();
            $log->save();

            $this->updateMode = false;
            $this->showToastr('success', 'Berhasil', 'Pengaduan didisposisikan!');
            $this->emit('closeModal'); // Close model to using to jquery

            return redirect()->route('admin.pengaduan.disposisi.detail', $this->pengaduanId);
        }
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
