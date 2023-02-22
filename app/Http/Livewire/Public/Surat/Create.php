<?php

namespace App\Http\Livewire\Public\Surat;

use Livewire\Component;
use App\Models\SuratKunjungan;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    public $asal_surat, $no_surat, $tanggal_surat, $keterangan_surat, $nama, $alamat, $no_hp, $tujuan, $file;
    public $keperluan, $status, $jabatan_pimpinan, $materi_kunjungan, $tanggal_kunjungan, $jam_kunjungan, $jumlah_peserta;
    public $captcha;

    public function render()
    {

        return view('livewire.public.surat.create')
            ->layout('layouts.app')
            ->layoutData([
                'title' => 'Buat Surat Kunjungan Kerja',
            ]);
    }

    // store surat kunjungan
    public function store()
    {
        $this->validate([
            'asal_surat' => 'required',
            'no_surat' => 'required',
            'tanggal_surat' => 'required',
            'keterangan_surat' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required|numeric',
            'tujuan' => 'required',
            'keperluan' => 'required',
            'file' => 'required|mimes:pdf|max:2048',
            // 'status' => 'required',
            'jabatan_pimpinan' => 'required',
            'materi_kunjungan' => 'required',
            'tanggal_kunjungan' => 'required',
            'jam_kunjungan' => 'required',
            'jumlah_peserta' => 'required|numeric',
            'captcha' => ['required', 'captcha'],
        ], [
            'asal_surat.required' => 'Asal Surat tidak boleh kosong',
            'no_surat.required' => 'Nomor Surat tidak boleh kosong',
            'tanggal_surat.required' => 'Tanggal Surat tidak boleh kosong',
            'keterangan_surat.required' => 'Keterangan Surat tidak boleh kosong',
            'nama.required' => 'Nama tidak boleh kosong',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'no_hp.required' => 'Nomor Handphone tidak boleh kosong',
            'tujuan.required' => 'Tujuan tidak boleh kosong',
            'keperluan.required' => 'Keperluan tidak boleh kosong',
            'file.required' => 'File tidak boleh kosong',
            // 'status.required' => 'Status tidak boleh kosong',
            'jabatan_pimpinan.required' => 'Jabatan Pimpinan tidak boleh kosong',
            'materi_kunjungan.required' => 'Materi Kunjungan tidak boleh kosong',
            'tanggal_kunjungan.required' => 'Tanggal Kunjungan tidak boleh kosong',
            'jam_kunjungan.required' => 'Jam Kunjungan tidak boleh kosong',
            'jumlah_peserta.required' => 'Jumlah Peserta tidak boleh kosong',
            'captcha.required' => 'Captcha tidak boleh kosong',
            'captcha.captcha' => 'Captcha tidak sesuai',
        ]);

        $data = new SuratKunjungan();
        $data->asal_surat = $this->asal_surat;
        $data->no_surat = $this->no_surat;
        $data->tanggal_surat = $this->tanggal_surat;
        $data->keterangan_surat = $this->keterangan_surat;
        $data->nama = $this->nama;
        $data->alamat = $this->alamat;
        $data->no_hp = $this->no_hp;
        $data->tujuan = $this->tujuan;
        $data->keperluan = $this->keperluan;
        // $data->file = $this->file;
        if ($this->file) {
            // path public_path
            $file = $this->file;
            $fileName = time() . '-' . $data->asal_surat . '.' . $file->getClientOriginalExtension();
            // $destinationPath = public_path('/storage/files/surat/');
            $this->file->storeAs('/storage/files/surat/', $fileName, 'public_html');
            // $filename = $this->file->getClientOriginalName();
            // $data->file = $this->file->storeAs('/storage/files/surat/', $filename, 'public_html');
            $data->file = $fileName;
        }
        $data->status = 'Draft';
        $data->jabatan_pimpinan = $this->jabatan_pimpinan;
        $data->materi_kunjungan = $this->materi_kunjungan;
        $data->jumlah_peserta = $this->jumlah_peserta;
        $data->tanggal_kunjungan = $this->tanggal_kunjungan;
        $data->jam_kunjungan = $this->jam_kunjungan;
        $data->save();

        // show toast
        $this->showToastr('success', 'Surat Kunjungan Berhasil dikirim!');
        $this->resetInputFields();
        $this->emit('suratKunjungan:store');
    }

    // reset input fields
    private function resetInputFields()
    {
        $this->asal_surat = '';
        $this->no_surat = '';
        $this->tanggal_surat = '';
        $this->keterangan_surat = '';
        $this->nama = '';
        $this->alamat = '';
        $this->no_hp = '';
        $this->tujuan = '';
        $this->keperluan = '';
        $this->file = '';
        $this->status = '';
        $this->jabatan_pimpinan = '';
        $this->materi_kunjungan = '';
        $this->tanggal_kunjungan = '';
        $this->jam_kunjungan = '';
        $this->jumlah_peserta = '';
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha' => captcha_img()]);
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
    public function showToastr($icon, $title)
    {
        $this->emit('swal:alert', [
            'icon'    => $icon,
            'title'   => $title,
            'timeout' => 10000
        ]);
    }
}
