<?php

namespace App\Http\Livewire\PA\WebsiteIdentity;

use App\Models\Settings\WebsIdentity;
use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;

class Edit extends Component
{
    use WithFileUploads;
    public $getLogo, $getFav, $logo, $favicon;
    public $data;

    protected $rules = [
        'data.name' => 'required|min:5',
        'data.description' => 'required',
        'data.email' => 'required|email',
        'data.address' => 'required',
        'data.googlemap' => 'required',
        'data.telephone' => 'required',
        'data.facebook' => 'required',
        'data.instagram' => 'required',
        'data.youtube' => 'required',
        'data.twitter' => 'required',
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        'favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
    ];

    public function mount()
    {
        $data = WebsIdentity::findOrFail(1);
        if ($data) {
            // $this->data = $data->toArray();
            $this->data = $data;
            $this->getFav = $data->favicon;
            $this->getLogo = $data->logo;
            // $this->data->favicon = null;
            // $this->data->logo = null;
        }
    }

    public function render()
    {
        $bcs = [
            [
                'route' => '',
                'title' => 'Identitas Website',
            ],
        ];

        return view('livewire.p-a.website-identity.edit')
            ->layout('admin.layouts.app')
            ->layoutData([
                'title' => 'Website Identity',
                'bcs' => $bcs
            ]);
    }

    public function updated($field)
    {
        $this->validateOnly($field, $this->rules);
        if ($field != 'logo' && $field != 'favicon') {
            $this->data->save();
            $this->showToastr('success', 'Berhasil', 'Informasi Website diperbarui!');
        }

        if ($field == 'logo') {
            $photo = $this->logo;
            $imageName = 'logo-ori.' . $photo->getClientOriginalExtension();
            $imageNameSmall = 'logo-small.' . $photo->getClientOriginalExtension();

            // ORIGINAL
            $destinationPath = public_path('/images/');
            $img = Image::make($photo->getRealPath());
            $QuploadImage = $img->resize(1080, 1080, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . $imageName, 100);

            // SMALL
            $destinationPath = public_path('/images/');
            $img = Image::make($photo->getRealPath());
            $QuploadImage = $img->resize(480, 480, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . $imageNameSmall, 100);

            $this->data->logo = $imageName;
            $this->data->save();
            $this->showToastr('success', 'Berhasil', 'Logo telah diperbarui!');
        }

        if ($field == 'favicon') {
            $photo = $this->favicon;
            $imageName = 'favicon-ori.' . $photo->getClientOriginalExtension();
            $imageNameSmall = 'favicon-small.' . $photo->getClientOriginalExtension();

            // ORIGINAL
            $destinationPath = public_path('/images/');
            $img = Image::make($photo->getRealPath());
            $QuploadImage = $img->resize(1080, 1080, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . $imageName, 100);

            // SMALL
            $destinationPath = public_path('/images/');
            $img = Image::make($photo->getRealPath());
            $QuploadImage = $img->resize(480, 480, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . $imageNameSmall, 100);

            $this->data->favicon = $imageName;
            $this->data->save();
            $this->showToastr('success', 'Berhasil', 'Logo telah diperbarui!');
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
