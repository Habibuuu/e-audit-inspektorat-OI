<div>
    <div class="card">
        <div class="card-body">
            <form wire:submit.prevent="store">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label class="form-label">Thumbnail</label>
                            <div class="position-relative d-flex justify-content-center">
                                <div wire:loading wire:target="thumbnail"
                                    class="position-absolute w-100 h-100 top-0 left-0"
                                    style="width:300px; height:300px;">
                                    <div class="loading d-flex w-100 h-100 justify-content-center align-items-center gap-2 rounded"
                                        style=" background:rgba(0,0,0,.9)">
                                        <div class="spinner-border text-light" style="width:20px; height:20px;"
                                            role="status">
                                        </div>
                                        Uploading
                                    </div>
                                </div>
                                <input type="file" wire:model="thumbnail"
                                    class="position-absolute w-100 h-100 top-0 left-0"
                                    style="cursor: pointer; opacity:0;" title="Ganti Thumbnail"
                                    accept=".png,.jpg,.jpeg,.webp" />
                                @if ($thumbnail)
                                    <img class="img img-thumbnail" style="width:300px; height:300px;object-fit:contain;"
                                        src="{{ $thumbnail->temporaryUrl() }}">
                                @else
                                    <div class="border rounded d-flex justify-content-center align-items-center"
                                        style="width:300px; height:300px;object-fit:contain;">
                                        <h3 class="text-center p-2">Upload Thumbnail <br> di sini</h3>
                                    </div>
                                @endif
                            </div>
                            @error('thumbnail')
                                <span class="invalid-feedback d-block">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Lampiran</label>
                            <input type="file" class="form-control" wire:model="lampiran" multiple>
                            @error('lampiran')
                                <span class="invalid-feedback d-block">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Judul Halaman</label>
                                    <input type="text" wire:model.lazy="judul_halaman"
                                        class="form-control @error('judul_halaman') is-invalid @enderror"
                                        placeholder="Masukkan Judul Halaman" autocomplete="off">
                                    @error('judul_halaman')
                                        <span class="invalid-feedback d-block">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label" class="form-label">Custom URL</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"
                                            id="basic-addon3">{{ route('public.index') }}/page/</span>
                                        <input type="text" wire:model="slug"
                                            class="form-control @error('slug') is-invalid @enderror"
                                            placeholder="Masukkan Custom Url" autocomplete="off">
                                    </div>
                                    @error('slug')
                                        <span class="invalid-feedback d-block">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-3" wire:ignore>
                                    <label class="form-label">Isi Halaman</label>
                                    <textarea class="form-control @error('isi_konten') is-invalid @enderror" id="summernote" wire:model.defer="isi_konten"></textarea>
                                </div>
                                @error('isi_konten')
                                    <span class="invalid-feedback d-block">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <div class="text-end">
                        <a href="{{ route('admin.page-index') }}" class="btn btn-outline-warning"><i
                                class="fa fa-arrow-left"></i> Kembali</a>
                        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @push('styles')
        <!-- include summernote css/js -->
        <link rel="stylesheet" href="{{ URL::asset('plugins/summernote-angga/css/summernote.css') }}" rel="stylesheet">
    @endpush

    @push('script')
        <!-- Summernote -->
        <script src="{{ URL::asset('plugins/summernote-angga/js/summernote.js') }}"></script>
        <script src="{{ URL::asset('plugins/typeahead/typeahead.js') }}"></script>
        <script>
            $(document).ready(function() {
                $("#summernote").summernote({
                    placeholder: 'Input your content here.....',
                    height: 300,
                    toolbar: [
						['font', ['bold', 'underline', 'clear']],
						['para', ['ul', 'ol']],
						['insert', ['link', 'picture', 'video']],
						['view', ['fullscreen', 'codeview', 'help']],
					],
                    dialogsInBody: true,
                    callbacks: {
                        onChange: function(contents, $editable) {
                            @this.set('isi_konten', contents);
                        },
                    }
                });
            });
        </script>
    @endpush

</div>
