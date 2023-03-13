<?php

namespace App\Http\Livewire\PA\Pengaduan;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pengaduan\PengaduanModel;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $filterJudul, $filterJenis, $user, $disposisi, $instruksi = [], $catatandis;
    public $updateMode = false;
    protected $listeners = [
        'appointments:delete' => 'delete',
    ];


    public function render()
    {
        $this->user = auth()->user();

        $datas = PengaduanModel::latest('created_at')
        ->get();

        return view('livewire.p-a.pengaduan.index', [
            'datas' => $datas,
            'PengaduanCount' => PengaduanModel::all()->count(),
            'VerifiedCount' => PengaduanModel::where('status', 'sudah_diverifikasi')->count(),
            'UnverifiedCount' => PengaduanModel::where('status', 'belum_diverifikasi')->count(),
            'RejectCount' => PengaduanModel::where('status', 'ditolak')->count(),
        ])
            ->layout('admin.layouts.app')
            ->layoutData([
            'title' => 'Daftar Pengaduan'
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
