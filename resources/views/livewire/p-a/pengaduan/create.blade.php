<div>
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Tambah Pengaduan</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Pengaduan</a></li>
                            <li class="breadcrumb-item active">Tambah</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <form>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card" style="border-top: solid 10px #7266bc;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tgl_pengaduan">Tgl Pengaduan</label>
                                        <input type="date" wire:model.defer="tgl_pengaduan" class="form-control @error('tgl_pengaduan') is-invalid @enderror" id="tgl_pengaduan" aria-describedby="tgl_pengaduan">
                                        @error('tgl_pengaduan')
                                            <span class="invalid-feedback d-block">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="no_pengaduan">No. Pengaduan</label>
                                        <input type="text" wire:model.defer="no_pengaduan" class="form-control @error('no_pengaduan') is-invalid @enderror" id="no_pengaduan" aria-describedby="no_pengaduan" placeholder="Masukan Nomor Pengaduan">
                                        @error('no_pengaduan')
                                            <span class="invalid-feedback d-block">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pengirim">Pengirim</label>
                                <input type="text" class="form-control @error('pengirim') is-invalid @enderror" wire:model.defer="pengirim" id="pengirim" aria-describedby="pengirim" placeholder="Masukan Nama Pengirim">
                                @error('pengirim')
                                    <span class="invalid-feedback d-block">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea wire:model.defer="alamat" class="form-control" id="alamat" rows="5" placeholder="Masukan Alamat Pengirim"></textarea>
                                @error('alamat')
                                    <span class="invalid-feedback d-block">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="perihal">Perihal</label>
                                <input class="form-control @error('perihal') is-invalid @enderror" wire:model.defer="perihal" id="perihal" rows="5" placeholder="Masukan Perihal Pengaduan">
                                @error('perihal')
                                    <span class="invalid-feedback d-block">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group" wire:ignore>
                                        <label for="kategori">Kategori</label>
                                        <select wire:model.defer="kategori" class="form-control ketegori_aduan @error('kategori') is-invalid @enderror" data-toggle="select2" id="kategoriSelect" multiple="multiple" data-placeholder="Choose ...">
                                            @foreach ($kateData as $kat)
                                            <option value="{{ $kat->name }}">{{ $kat->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('kategori')
                                            <span class="invalid-feedback d-block">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" wire:ignore>
                                        <label for="wilayah">Wilayah</label>
                                        <select wire:model.defer="wilayah" class="form-control wilayah @error('wilayah') is-invalid @enderror" data-toggle="select2" id="wilayahSelect" multiple="" data-placeholder="Choose ...">
                                            @foreach ($wilData as $wil)
                                            <option value="{{ $wil->name }}">{{ $wil->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('wilayah')
                                            <span class="invalid-feedback d-block">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" wire:ignore>
                                <label for="jenis">Jenis</label>
                                <select wire:model.defer="jenis" class="form-control jenis @error('jenis') is-invalid @enderror" data-toggle="select2" id="jenisSelect" multiple="multiple" data-placeholder="Choose ...">
                                    @foreach ($jenisData as $jen)
                                    <option value="{{ $jen->name }}">{{ $jen->name }}</option>
                                    @endforeach
                                </select>
                                @error('jenis')
                                    <span class="invalid-feedback d-block">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col -->
                <div class="col-lg-6">
                    <div class="card" style="border-top: solid 10px #7266bc;">
                        <div class="card-body">
                            <div class="form-group" wire:ignore>
                                <label>Penerima Pengaduan</label>
                                <select  wire:model.defer="penerima" class="form-control" data-toggle="select2">
                                    <option>Pilih penerima</option>
                                    <option value="Inspektur">Inspektur</option>
                                    <option value="Irban">Irban</option>
                                    <option value="Sekban">Sekban</option>
                                </select>
                                @error('penerima')
                                    <span class="invalid-feedback d-block">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="isi">Isi Pengaduan</label>
                                <textarea wire:model.defer="isi" class="form-control" id="isi" rows="5" placeholder="Masukan Isi Pengaduan"></textarea>
                                @error('isi')
                                    <span class="invalid-feedback d-block">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group" wire:ignore>
                                <h4 class="card-title">File Pengaduan</h4>
                                <p class="card-subtitle mb-4">Masukan file pengaduan</p>
                                <input wire:model="scanfile" type="file" class="dropify" data-max-file-size="1M" multiple />
                                @error('scanfile')
                                    <span class="invalid-feedback d-block">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group" wire:ignore>

                                <h4 class="card-title">Lampiran</h4>
                                <input wire:model="lampiran" type="file" class="dropify" data-max-file-size="1M" multiple />
                                @error('lampiran')
                                    <span class="invalid-feedback d-block">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="catatan">Catatan (opsional)</label>
                                <textarea wire:model.defer="catatan" class="form-control" id="catatan" rows="5" placeholder="Masukan Catatan"></textarea>
                                @error('catatan')
                                    <span class="invalid-feedback d-block">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group" style="float: right;">
                                <button wire:click.prevent="resetForm()" class="btn btn-outline-warning">Reset</button>
                                <button wire:click.prevent="store()" class="btn btn-success">Simpan</button>
                            </div>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div> <!-- end row -->
        </form>

    </div>

    @push('script')
    <script>
        $(document).ready(function() {
            $('.wilayah').select2();
        });

        $('#wilayahSelect').on('change', function(e) {
            let data = $(this).val();
            @this.set('wilayah', data);
        });

        $(document).ready(function() {
            $('.ketegori_aduan').select2();
        })

        $(document).ready(function() {
            $('.jenis').select2();
        })

        $('#kategoriSelect').on('change', function(e) {
            let data = $(this).val();
            @this.set('kategori', data);
        });

        $('#jenisSelect').on('change', function(e) {
            let data = $(this).val();
            @this.set('jenis', data);
        });
    </script>
    @endpush()
</div>
