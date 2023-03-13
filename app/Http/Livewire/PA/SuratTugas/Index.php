<?php

namespace App\Http\Livewire\PA\SuratTugas;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Pengaduan\LogPengaduan;
use App\Models\Pengaduan\PengaduanModel;

class Index extends Component
{
    use WithFileUploads;
    public $disposisi, $instruksi, $catatandis, $pengaduanId, $surat_tugas;
    public $updateMode = false;

    public function render()
    {
        $datas = PengaduanModel::latest('created_at')->get();

        return view('livewire.p-a.surat-tugas.index', [
            'datas' => $datas,
            'PengaduanCount' => PengaduanModel::all()->count(),
            'VerifiedCount' => PengaduanModel::where('status', 'sudah_diverifikasi')->count(),
            'UnverifiedCount' => PengaduanModel::where('status', 'belum_diverifikasi')->count(),
            'RejectCount' => PengaduanModel::where('status', 'ditolak')->count(),
        ])
            ->layout('admin.layouts.app')
            ->layoutData([
            'title' => 'List Surat Tugas'
        ]);
    }

    public function lihatDisposisi($id)
    {
        $this->updateMode = true;
        $data = PengaduanModel::findOrFail($id);
        $this->pengaduanId = $data->id;
        $this->disposisi = $data->disposisi;
        $this->instruksi = $data->instruksi;
        $this->catatandis = $data->catatandis;
    }

    public function uploadST($id)
    {
        $this->updateMode = true;
        $data = PengaduanModel::findOrFail($id);
        $this->pengaduanId = $data->id;
    }

    public function store()
    {
        $validasi = $this->validate([
            'surat_tugas' => 'required',
        ]);

        if ($validasi) {
            $data = PengaduanModel::findorFail($this->pengaduanId);
            if ($this->surat_tugas) {
                $surat = $this->surat_tugas;
                $filename = time() . '.' . $surat->getClientOriginalExtension();
                $surat->storeAs('pengaduan/surat_tugas', $filename, 'public');
            $data->surat_tugas = $filename;
            }
            $data->save();

            $log = new LogPengaduan;
            $log->pengaduan_id = $data->id;
            $log->status_log = 'Surat Pengaduan Sudah dibuat';
            $log->tgl_log = Carbon::now();
            $log->save();

            $this->updateMode = false;
            $this->showToastr('success', 'Berhasil', 'Upload Surat berhasil');
            $this->emit('closeModal'); // Close model to using to jquery

            return redirect()->route('admin.surat-tugas');
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
