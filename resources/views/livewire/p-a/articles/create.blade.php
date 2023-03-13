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
                                    style="cursor: pointer; opacity:0;" title="Ganti Thumbnail" />
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
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Judul Artikel</label>
                                    <input type="text" wire:model.lazy="judul_artikel"
                                        class="form-control @error('judul_artikel') is-invalid @enderror"
                                        placeholder="Masukkan Judul Artikel" value="{{ $judul_artikel }}"
                                        autocomplete="off">
                                    @error('judul_artikel')
                                        <span class="invalid-feedback">
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
                                            id="basic-addon3">{{ route('public.index') }}/artikel/detail/</span>
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
                                <div class="form-group mb-3">
                                    <label class="form-label">Deskripsi</label>
                                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" placeholder="Masukkan Deskripsi"
                                        style="min-height: 100px" wire:model.defer="deskripsi"></textarea>
                                    @error('deskripsi')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Tanggal Publish</label>
                                    <input type="datetime-local" wire:model.defer="tanggal_publish"
                                        class="form-control @error('tanggal_publish') is-invalid @enderror"
                                        placeholder="Masukkan Tanggal Publish">
                                    @error('tanggal_publish')
                                        <span class="invalid-feedback d-block">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Tags Berita</label>
                                    <div wire:ignore>
                                        <select wire:model.defer="tagsId"
                                            class="form-control select2 @error('tagsId') is-invalid @enderror"
                                            id="tagSelect" multiple="" aria-placeholder="Pilih Tag"
                                            placeholder="Pilih Tags">
                                            @foreach ($arrTags as $tag)
                                                <option value="{{ $tag->name }}">{{ $tag->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('tagsId')
                                        <span class="invalid-feedback d-block">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label class="form-label">Jenis Artikel</label>
                                    <select wire:model.defer="jenisId"
                                        class="form-control @error('jenisId') is-invalid @enderror">
                                        <option value="" hidden>-- Pilih Jenis Artikel --</option>
                                        @foreach ($types as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('jenisId')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label class="form-label">Kategori Artikel</label>
                                    <select wire:model.defer="kategori"
                                        class="form-control @error('kategori') is-invalid @enderror">
                                        <option hidden>-- Pilih Kategori Artikel --</option>
                                        @foreach ($categories as $categori)
                                            <option value="{{ $categori->id }}">{{ $categori->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('kategori')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label class="form-label">Rekomendasi</label>
                                    <select wire:model.defer="rekomendasi"
                                        class="form-control @error('rekomendasi') is-invalid @enderror">
                                        <option selected hidden>-- Pilih Rekomendasi --</option>
                                        <option value="1">Ya</option>
                                        <option value="0">Tidak</option>
                                    </select>
                                    @error('rekomendasi')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3" wire:ignore>
                    <label class="form-label">Isi Artikel</label>
                    <textarea class="form-control @error('isi_artikel') is-invalid @enderror" id="summernote"
                        wire:model.defer="isi_artikel"></textarea>
                </div>
                @error('isi_artikel')
                    <span class="invalid-feedback d-block">
                        {{ $message }}
                    </span>
                @enderror
                <div class="form-group mb-3">
                    <div class="text-end">
                        <a href="{{ route('admin.articles-index') }}" class="btn btn-outline-warning"><i
                                class="fa fa-arrow-left"></i> Kembali</a>
                        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('styles')
        <!-- Summernote CSS -->
        <link rel="stylesheet" href="{{ asset('temp/admin/v2/vendor/summernote/summernote-bs4.css') }}" />
        <!-- Select Multi -->
        <link rel="stylesheet" href="{{ URL::asset('assets_admin/node_modules/select2/dist/css/select2.min.css') }}"
            rel="stylesheet">
    @endpush

    @push('script')
        <script
            src="{{ URL::asset('assets_admin/node_modules/jquery_upload_preview/assets/js/jquery.uploadPreview.min.js') }}">
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
        <!-- Summernote JS -->
        <script src="{{ asset('temp/admin/v2/vendor/summernote/summernote-bs4.js') }}"></script>
        <script>
            $(document).ready(function() {
                $("#summernote").summernote({
                    placeholder: 'Masukkan Deskripsi disini.....',
                    height: 300,
                    toolbar: [
                        ['font', ['bold', 'underline', 'clear']],
                        ['para', ['ul', 'ol']],
                        ['insert', ['link', 'picture', 'video']],
                        ['view', ['fullscreen', 'codeview', 'help']],
                    ],
                    dialogsInBody: true,
                    callbacks: {
                        onBlur: function(contents, $editable) {
                            var value = $(this).val();
                            @this.set('isi_artikel', value);
                        },
                        onBlurCodeview: function(contents, $editable) {
                            var value = $(this).val();
                            @this.set('isi_artikel', value);
                        },
                    }
                });
            });
        </script>
        <!-- Select Multiple -->
        <script src="{{ asset('assets_admin/node_modules/select2/dist/js/select2.full.min.js') }}"></script>
        <script>
            $(".select2").select2({
                placeholder: "Pilih Tag Berita..",
                allowClear: true,
            });
            $('#tagSelect').on('change', function(e) {
                let data = $(this).val();
                @this.set('tagsId', data);
            });
            window.livewire.on('articlesStore', () => {
                $('#tagSelect').select2();
            });
        </script>
    @endpush

</div>
