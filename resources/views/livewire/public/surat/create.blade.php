<div>
    {{-- Be like water. --}}
    @push('pageTitle')
        Buat Surat Kunjungan Kerja
    @endpush
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-header">
                        <center>
                            <h4 class="card-title">Kirim Surat Kunjungan</h4>
                        </center>
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent="store">
                            {{-- asal surat --}}
                            <div class="form-group">
                                <label for="asal_surat">Asal Surat</label>
                                <input type="text" class="form-control" id="asal_surat" wire:model="asal_surat">
                                @error('asal_surat')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Nomor Surat</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Nomor Surat" wire:model="no_surat">
                                @error('no_surat')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Tanggal Surat</label>
                                <input type="date" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Tanggal Surat" wire:model="tanggal_surat">
                                @error('tanggal_surat')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Perihal</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Perihal" wire:model="keperluan">
                                @error('perihal')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Tujuan</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Tujuan" wire:model="tujuan">
                                @error('tujuan')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Keterangan</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Keterangan" wire:model="keterangan_surat">
                                @error('keterangan_surat')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">File Surat</label>
                                <input type="file" class="form-control" id="exampleFormControlInput1"
                                    placeholder="File Surat" wire:model="file">
                                {{-- filter file type --}}
                                @if ($file)
                                    @if ($file->getClientOriginalExtension() != 'pdf')
                                        <span class="text-danger">File harus berformat PDF</span>
                                    @endif
                                @endif
                                @error('file')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- alamat kantor/instansi Asal --}}
                            <div class="form-group">
                                <label for="alamat_kantor">Alamat Kantor/Instansi Asal</label>
                                <textarea class="form-control" id="alamat" rows="3" wire:model="alamat"></textarea>
                                @error('alamat')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- nama pengirim surat --}}
                            <div class="form-group">
                                <label for="nama_pengirim">Nama Pengirim Surat</label>
                                <input type="text" class="form-control" id="nama_pengirim" wire:model="nama">
                                @error('nama')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- no whatsapp pengirim --}}
                            <div class="form-group">
                                <label for="no_wa_pengirim">No Whatsapp Pengirim</label>
                                <input type="text" class="form-control" id="no_wa_pengirim" wire:model="no_hp">
                                @error('no_hp')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- jabatan pimpinan rombongan --}}
                            <div class="form-group">
                                <label for="jabatan_pimpinan_rombongan">Jabatan Pimpinan Rombongan</label>
                                <input type="text" class="form-control" id="jabatan_pimpinan_rombongan"
                                    wire:model="jabatan_pimpinan">
                                @error('jabatan_pimpinan')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- materi yang akan di konsultasikan --}}
                            <div class="form-group">
                                <label for="materi_yang_akan_di_konsultasikan">Materi yang akan di
                                    konsultasikan</label>
                                <textarea class="form-control" id="materi_yang_akan_di_konsultasikan" rows="3" wire:model="materi_kunjungan"></textarea>
                                @error('materi_kunjungan')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- jumlah peserta --}}
                            <div class="form-group">
                                <label for="jumlah_peserta">Jumlah Peserta</label>
                                <input type="text" class="form-control" id="jumlah_peserta"
                                    wire:model="jumlah_peserta">
                                @error('jumlah_peserta')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- tanggal kegiatan --}}
                            <div class="form-group">
                                <label for="tanggal_kegiatan">Tanggal Kegiatan</label>
                                <input type="date" class="form-control" id="tanggal_kegiatan"
                                    wire:model="tanggal_kunjungan">
                                @error('tanggal_kunjungan')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- jam kegiatan --}}
                            <div class="form-group">
                                <label for="jam_kegiatan">Jam Kegiatan</label>
                                <input type="time" class="form-control" id="jam_kegiatan"
                                    wire:model="jam_kunjungan">
                                @error('jam_kunjungan')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- captcha --}}
                            <div class="form-group row">
                                <label for="captcha" class="col-md-4 col-form-label text-md-right">Captcha</label>
                                <div class="col-md-6 captcha">
                                    <span>{!! captcha_img() !!}</span>
                                    <button type="button" class="btn btn-danger" class="reload" id="reload">
                                        &#x21bb;
                                    </button>
                                </div>
                            </div><br>
                            <div class="form-group row">
                                <label for="captcha" class="col-md-4 col-form-label text-md-right"></label>
                                <div class="col-md-6">
                                    <input id="captcha" type="text"
                                        class="form-control  @error('captcha') is-invalid @enderror"
                                        placeholder="Enter Captcha" wire:model.defer="captcha">
                                    @error('captcha')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                            </div>
                            <div class="form-group pb-3">
                                <button type="submit" class="btn btn-primary">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
