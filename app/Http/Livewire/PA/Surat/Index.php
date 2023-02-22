<?php

namespace App\Http\Livewire\PA\Surat;

use Livewire\Component;
use App\Models\SuratKunjungan;
use Illuminate\Support\Facades\File;

class Index extends Component
{
    public function render()
    {
        $data = SuratKunjungan::all();
        return view('livewire.p-a.surat.index',[
            'data' => $data
        ])->layout('admin.layouts.app')
            ->layoutData([
                'title' => 'Daftar Surat Kunjungan',
            ]);
    }

    // delete
    public function delete($id)
    {
        $data = SuratKunjungan::find($id);
        // File::delete('/storage/files/surat/'.$data->file);
        // delete file in storage
        File::delete(public_path('/storage/files/surat/'.$data->file));
        $data->delete();
        $this->emit('suratKunjungan:delete');
    }

    public function destroy($id)
    {
        if($id){
            $data = SuratKunjungan::where('id',$id);
            $data->delete();
            session()->flash('message', 'Surat Kunjungan Berhasil Dihapus.');
        }
    }

    public function edit($id)
    {
        if($id){
            $data = SuratKunjungan::where('id',$id)->first();
            $this->emit('editSuratKunjungan', $data);
        }
    }

    public function update($id)
    {
        if($id){
            $data = SuratKunjungan::where('id',$id)->first();
            $this->emit('updateSuratKunjungan', $data);
        }
    }

    public function show($id)
    {
        if($id){
            $data = SuratKunjungan::where('id',$id)->first();
            $this->emit('showSuratKunjungan', $data);
        }
    }


}
