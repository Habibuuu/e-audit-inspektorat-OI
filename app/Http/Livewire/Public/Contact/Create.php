<?php

namespace App\Http\Livewire\Public\Contact;

use App\Models\Contacts\Contact;
use Illuminate\Http\Request;
use Livewire\Component;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    public $limitPerPage = 5;
    public $nama, $alamat, $tanggal_lahir, $jenis_kelamin, $no_hp, $pekerjaan, $email;
    public $photo, $judul_gagasan, $narasi_gagasan, $captcha, $reload;

    public function render()
    {

        $limitKontak = Contact::where('status', 'Publish')->count();
        $arrKontak = Contact::where('status', 'Publish')
            ->latest()
            ->paginate($this->limitPerPage);

        if ($limitKontak <= $arrKontak->count() || $arrKontak->count() == 0) {
            $this->loadMoreButton = false;
        }

        $datas = Contact::latest()->paginate(5);
        return view('livewire.public.contact.create', [
            'datas' => $datas,
        ])->layout('layouts.app');
    }

    public function store()
    {

        $validasi = $this->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'no_hp' => 'required|numeric|min:11|max:12',
            'pekerjaan' => 'required',
            'email' => 'required',
            'photo' => 'required|mimes:jpeg,png,jpg,gif,svg',
            'judul_gagasan' => 'required',
            'narasi_gagasan' => 'required|min:20|max:200',
            'captcha' => ['required', 'captcha'],
        ], [
            'captcha.captcha' => 'Captcha tidak sesuai gambar',
        ]);

        if ($this->photo) {
            $photo = $this->photo;
            $imageName = Str::slug($this->nama) . '.' . $photo->getClientOriginalExtension();

            // ORIGINAL
            $destinationPath = public_path('/storage/images/photo/original/');
            $img = Image::make($photo->getRealPath());
            $QuploadImage = $img->resize(1080, 1080, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . $imageName, 100);

            // SMALL
            $destinationPath = public_path('/storage/images/photo/small/');
            $img = Image::make($photo->getRealPath());
            $QuploadImage = $img->resize(480, 480, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . $imageName, 100);

            $filename = $imageName;
        }

        $post = Contact::create([
            'nama' => $this->nama,
            'alamat' => $this->alamat,
            't_lahir' => $this->tanggal_lahir,
            'j_kelamin' => $this->jenis_kelamin,
            'no_hp' => $this->no_hp,
            'pekerjaan' => $this->pekerjaan,
            'email' => $this->email,
            'photo' => $filename,
            'j_gagasan' => $this->judul_gagasan,
            'n_gagasan' => $this->narasi_gagasan,

        ]);

        session()->flash('success', 'Gagasan berhasil ditambahkan!');
        return redirect()->route('public.contactCreate');
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha' => captcha_img()]);
    }
}
