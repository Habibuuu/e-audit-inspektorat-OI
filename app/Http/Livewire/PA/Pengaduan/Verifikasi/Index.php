<?php

namespace App\Http\Livewire\PA\Pengaduan\Verifikasi;

use Livewire\Component;
use App\Models\Pengaduan\PengaduanModel;

class Index extends Component
{
    public $filterJudul, $filterJenis, $user, $disposisi, $instruksi = [], $catatandis;
    public $updateMode = false;

    public function render()
    {
        $this->user = auth()->user();

        $data = $this->user->fullname;

        // dd($data);

        if( $this->user->role_id == 5) {
            $datas = PengaduanModel::latest('created_at')
            ->where('disposisi', $data)
            ->get();
        }else {
            $datas = PengaduanModel::latest('created_at')
                ->get();
        }

        return view('livewire.p-a.pengaduan.verifikasi.index', [
                'datas' => $datas,
                'PengaduanCount' => PengaduanModel::all()->count(),
                'VerifiedCount' => PengaduanModel::where('status', 'sudah_diverifikasi')->count(),
                'UnverifiedCount' => PengaduanModel::where('status', 'belum_diverifikasi')->count(),
                'RejectCount' => PengaduanModel::where('status', 'ditolak')->count(),
            ])
            ->layout('admin.layouts.app')
            ->layoutData([
            'title' => 'Verifikasi Pengaduan'
        ]);
    }

    public function lihatDisposisi($id)
    {
        $this->updateMode = true;
        $data = PengaduanModel::findOrFail($id);
        $this->disposisi = $data->disposisi;
        $this->instruksi = collect(json_decode($data->instruksi));
        $this->catatandis = $data->catatandis;
    }
}
