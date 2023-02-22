<?php

namespace App\Http\Livewire\PA\WebsiteStyle;

use App\Models\Settings\WebStyle;
use Livewire\Component;

class Edit extends Component
{
    public $dataId, $main_banner, $color1, $color1active, $color2, $color2active, $background_color, $black, $white, $font_style;

    public function mount()
    {
        $data = WebStyle::find(1);
        if($data) {
            $this->dataId = $data->id;
            $this->main_banner = $data->main_banner;
            $this->color1 = $data->color_1;
            $this->color1active = $data->color_1_active;
            $this->color2 = $data->color_2;
            $this->color2active = $data->color_2_active;
            $this->background_color = $data->background_color;
            $this->black = $data->black;
            $this->white = $data->white;
            $this->font_style = $data->font_style;
        }
    }

    public function render()
    {
        return view('livewire.p-a.website-style.edit')
            ->layout('admin.layouts.app');
    }

    public function update()
    {
        sleep(1);
        $data = WebStyle::findOrFail(1);
        $validasi = $this->validate([
            'color1' => 'required',
            'color1active' => 'required',
            'color2' => 'required',
            'color2active' => 'required',
            'black' => 'required',
            'white' => 'required',
            'background_color' => 'required',
            'font_style' => 'required',
        ]);

        if($validasi && $data)
        {
            $data->color_1 = $this->color1;
            $data->color_1_active = $this->color1active;
            $data->color_2 = $this->color2;
            $data->color_2_active = $this->color2active;
            $data->background_color = $this->background_color;
            $data->black = $this->black;
            $data->white = $this->white;
            $data->font_style = $this->font_style;
            $data->save();

            session()->flash('success', 'Perubahan Berhasil!');
            return redirect()->route('admin.settings-website-style');
        }
    }
}
