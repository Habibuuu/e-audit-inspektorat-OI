<?php

namespace App\Http\Livewire\PA\Pengaduan\Verifikasi;

use Livewire\Component;
use App\Models\Pengaduan\PengaduanModel;

class Detail extends Component
{
    public $pengaduanId, $perihal, $pengirim, $tgl_pengaduan, $no_pengaduan, $status, $alasantolak, $disposisi, $kategori = [], $datkat, $wilayah = [], $datwil, $alamat, $penerima, $isi, $scanfile, $scanPrev, $lampiran, $lampiranPrev, $catatan;
    public $created_at, $updated_at;
    protected $listeners = [
        'appointments:delete' => 'delete',
        'appointments:verifikasi' => 'verifikasi',
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
            $this->created_at = $data->created_at;
            $this->updated_at = $data->updated_at;
        }
    }

    public function render()
    {
        return view('livewire.p-a.pengaduan.verifikasi.detail', [

            ])
            ->layout('admin.layouts.app')
            ->layoutData([
            'title' => 'Detail Pengaduan'
        ]);
    }

    public function verifikasi($id)
    {
        $data = PengaduanModel::findOrFail($id);
        $oldStatus = $data->status;
        if ($oldStatus == 'belum_diverifikasi') {
            $data->status = 'sudah_diverifikasi';
        }
        $data->save();
        $this->showToastr('success', 'Berhasil', 'Status Berhasil diubah!');
    }

    public function confirmVerifikasi($pengaduanId)
    {
        $this->emit("swal:confirm", [
            'icon'        => 'info',
            'title'       => 'Verifikasi Pengaduan!',
            'text'        => "Anda yakin memverifikasi Pengaduan ini?",
            'confirmText' => 'Verikasi!',
            'cancelText' => 'Tidak!',
            'method'      => 'appointments:verifikasi',
            'onConfirmed' => 'confirmed',
            'params'      => $pengaduanId, // optional, send params to success confirmation
            'callback'    => '', // optional, fire event if no confirmed
        ]);
    }

    public function reject($id)
    {
        $this->updateMode = true;
        $data = PengaduanModel::findOrFail($id);
        $this->alasantolak = $data->alasantolak;
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

            return redirect()->route('admin.pengaduan.index');
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
