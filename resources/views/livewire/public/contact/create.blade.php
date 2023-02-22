<div>
    <div class="container-fluid grid-wrrapper">
        <div class="row">
            <div class="col-md-8 offset-md-2 p-10 ">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Form Kritik dan Saran 😉</h5>
                    </div>
                    <div class="card-body grid-showcase grid-align">
                        <p>Silahkan berikan kritik dan saran diform yang telah disediakan.</p>
                        <form wire:submit.prevent="store">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <label class="form-label">Nama</label>
                                    <input type="text" wire:model.defer="nama"
                                        class="form-control btn-pill
                                        @error('nama') is-invalid @enderror"
                                        placeholder="Masukkan Nama" value="{{ $nama }}" autocomplete="off">
                                    @error('nama')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label class="form-label">Alamat</label>
                                    <input type="text" wire:model.defer="alamat"
                                        class="form-control btn-pill
                                        @error('alamat') is-invalid @enderror"
                                        placeholder="Masukkan Alamat" value="{{ $alamat }}" autocomplete="off">
                                    @error('alamat')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label class="form-label">Tanggal Lahir</label>
                                    <input type="text" wire:model.defer="tanggal_lahir"
                                        class="form-control btn-pill @error('tanggal_lahir') is-invalid @enderror"
                                        placeholder="Masukkan Tanggal Lahir" value="{{ $tanggal_lahir }}"
                                        autocomplete="off">
                                    @error('tanggal_lahir')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Jenis Kelamin</label>
                                        <select
                                            class="form-select btn-pill digits @error('jenis_kelamin') is-invalid @enderror"
                                            wire:model.defer="jenis_kelamin">
                                            <option hidden>Pilih Jenis Kelamin</option>
                                            <option value="Laki-laki">Laki - Laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                        @error('jenis_kelamin')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">No Handphone</label>
                                        <input type="text" wire:model.defer="no_hp"
                                            class="form-control btn-pill  @error('no_hp') is-invalid @enderror"
                                            placeholder="Masukkan No Handphone" value="{{ $no_hp }}"
                                            autocomplete="off">
                                        @error('no_hp')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Pekerjaan</label>
                                        <input type="text" wire:model.defer="pekerjaan"
                                            class="form-control btn-pill @error('pekerjaan') is-invalid @enderror"
                                            id="exampleInputPassword6" placeholder="Masukkan Pekerjaan"
                                            value="{{ $pekerjaan }}" autocomplete="off">
                                        @error('pekerjaan')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-floating mb-4">
                                    <input type="email" wire:model.defer="email" class="form-control"
                                        placeholder="Email*" id="c-email">
                                    <label for="c-email">Email*</label>
                                    @error('email')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group" wire:ignore>
                                    <label>Photo</label>
                                    <div id="image-preview" class="image-preview"
                                        style="width:100%; min-height:250px;">
                                        <label for="image-upload" id="image-label">Choose File</label>
                                        <input type="file" wire:model.defer="photo" id="image-upload"
                                            class="@error('photo') is-invalid @enderror" />
                                    </div>
                                    <div wire:loading wire:target="photo">Uploading...</div>
                                </div>
                                <small class="text-danger">note: Masukkan foto anda.</small>
                                @error('photo')
                                    <span class="invalid-feedback d-block">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Judul Gagasan</label>
                                        <input type="text" wire:model.defer="judul_gagasan"
                                            class="form-control btn-pill @error('j_gagasan') is-invalid @enderror"
                                            placeholder="Masukkan Judul Gagasan" value="{{ $judul_gagasan }}">
                                    </div>
                                    @error('judul_gagasan')
                                        <span class="invalid-feedback d-block">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div>
                                        <label class="form-label">Narasi Gagasan</label>
                                        <textarea class="form-control btn-pill @error('narasi_gagasan') is-invalid @enderror" rows="3" id="summernote"
                                            placeholder="Masukkan Narasi Gagasan"
                                            wire:model.defer="narasi_gagasan"></textarea>
                                        <small class="text-danger">note: limit karakter adalah 200 kata</small>
                                        @error('narasi_gagasan')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="captcha" class="col-md-4 col-form-label text-md-right">Captcha</label>
                                <div class="col-md-6 captcha">
                                    <span>{!! captcha_img() !!}</span>
                                    <button type="button" class="btn btn-danger" class="reload" id="reload">
                                        &#x21bb;
                                    </button>
                                </div>
                            </div>
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
                                <div class="card-footer text-end">
                                    <button class="btn btn-primary" type="submit"><i
                                            class="fa fa-save"></i>Submit</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="overflow-hidden">
            <div class="divider text-white mx-n9 bg-soft-primary" style="color: #3f78e0 !important;">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 92.26">
                    <path fill="currentColor"
                        d="M1206,21.2c-60-5-119-36.92-291-5C772,51.11,768,48.42,708,43.13c-60-5.68-108-29.92-168-30.22-60,.3-147,27.93-207,28.23-60-.3-122-25.94-182-36.91S30,5.93,0,16.2V92.26H1440v-87l-30,5.29C1348.94,22.29,1266,26.19,1206,21.2Z" />
                </svg>
            </div>
        </div>
    </div>

    @push('styles')
        <link rel="stylesheet" href="{{ URL::asset('admin_assets/node_modules/dropzone/dist/dropzone.css') }}"
            rel="stylesheet">
    @endpush

    @push('script')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript">
            $('#reload').click(function() {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('public.reloadCaptcha') }}',
                    success: function(data) {
                        $(".captcha span").html(data.captcha);
                    }
                });
            });
        </script>

        <script src="{{ asset('admin_assets/node_modules/dropzone/dist/dropzone.js') }}"></script>
        <script
                src="{{ URL::asset('admin_assets/node_modules/jquery_upload_preview/assets/js/jquery.uploadPreview.min.js') }}">
        </script>
        <script>
            $.uploadPreview({
                input_field: "#image-upload", // Default: .image-upload
                preview_box: ".image-preview", // Default: .image-preview
                label_field: "#image-label", // Default: .image-label
                label_default: "Choose File", // Default: Choose File
                label_selected: "Change File", // Default: Change File
                no_label: false, // Default: false
                success_callback: null // Default: null
            });
        </script>

        <script>
            $("#autoPublishToggle").on('click', function() {
                $(this).val(this.checked ? 1 : 0);
            });
        </script>
    @endpush
</div>
