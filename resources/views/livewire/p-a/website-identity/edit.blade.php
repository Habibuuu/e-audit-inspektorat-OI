<div>

    <div class="card">
        <div class="card-body">
            <h4 class="text-center fw-bold text-dark">Edit Identitas Website</h4>
            <hr>
            <form>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group mb-3 text-center">
                            <label class="form-label">Favicon</label>
                            <div class="position-relative d-flex justify-content-center">
                                <div wire:loading wire:target="favicon"
                                    class="position-absolute w-100 h-100 top-0 left-0"
                                    style="width:300px; height:300px;">
                                    <div class="loading d-flex w-100 h-100 justify-content-center align-items-center gap-2 rounded text-light"
                                        style=" background:rgba(0,0,0,.9)">
                                        <div class="spinner-border text-light" style="width:20px; height:20px;"
                                            role="status">
                                        </div>
                                        Uploading
                                    </div>
                                </div>
                                <input type="file" wire:model="favicon"
                                    class="position-absolute w-100 h-100 top-0 left-0"
                                    style="cursor: pointer; opacity:0;" title="Ganti Favicon" />
                                @if ($favicon)
                                    <img class="img img-thumbnail" style="width:300px; height:300px;object-fit:contain;"
                                        src="{{ $favicon->temporaryUrl() }}">
                                @else
                                    <img class="img img-thumbnail" style="width:300px; height:300px;object-fit:contain;"
                                        src="{{ asset('/images/' . $getFav) }}">
                                @endif
                            </div>
                            @error('favicon')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3 text-center">
                            <label class="form-label">Logo</label>
                            <div class="position-relative d-flex justify-content-center">
                                <div wire:loading wire:target="logo" class="position-absolute w-100 h-100 top-0 left-0"
                                    style="width:300px; height:300px;">
                                    <div class="loading d-flex w-100 h-100 justify-content-center align-items-center gap-2 rounded text-light"
                                        style=" background:rgba(0,0,0,.9)">
                                        <div class="spinner-border text-light" style="width:20px; height:20px;"
                                            role="status">
                                        </div>
                                        Uploading
                                    </div>
                                </div>
                                <input type="file" wire:model="logo"
                                    class="position-absolute w-100 h-100 top-0 left-0"
                                    style="cursor: pointer; opacity:0;" title="Ganti Logo" />
                                @if ($logo)
                                    <img class="img img-thumbnail" style="width:300px; height:300px;object-fit:contain;"
                                        src="{{ $logo->temporaryUrl() }}">
                                @else
                                    <img class="img img-thumbnail" style="width:300px; height:300px;object-fit:contain;"
                                        src="{{ asset('/images/' . $getLogo) }}">
                                @endif
                            </div>
                            @error('logo')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Nama Website</label>
                                    <input type="text" wire:model.lazy="data.name"
                                        class="form-control @error('data.name') is-invalid @enderror"
                                        placeholder="Masukkan Nama Website" autocomplete="off">
                                    @error('data.name')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Alamat</label>
                                    <textarea wire:model.lazy="data.address" class="form-control @error('data.address') is-invalid @enderror"
                                        placeholder="Masukkan Alamat" style="min-height:100px;"></textarea>
                                    @error('data.address')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Googlemap</label>
                                    <textarea wire:model.lazy="data.googlemap" class="form-control @error('data.googlemap') is-invalid @enderror"
                                        placeholder="Kode HTML Googlemap" style="min-height:100px;"></textarea>
                                    @error('data.googlemap')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" wire:model.lazy="data.email"
                                        class="form-control @error('data.email') is-invalid @enderror"
                                        placeholder="Masukkan Email">
                                    @error('data.email')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Telepon</label>
                                    <input type="text" wire:model.lazy="data.telephone"
                                        class="form-control @error('data.telephone') is-invalid @enderror"
                                        placeholder="Masukkan Nomor Telepon">
                                    @error('data.telephone')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Facebook</label>
                                    <input type="text" wire:model.lazy="data.facebook"
                                        class="form-control @error('data.facebook') is-invalid @enderror"
                                        placeholder="Masukkan Link Facebook">
                                    @error('data.facebook')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Instagram</label>
                                    <input type="text" wire:model.lazy="data.instagram"
                                        class="form-control @error('data.instagram') is-invalid @enderror"
                                        placeholder="Masukkan Link Instagram">
                                    @error('data.instagram')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Youtube</label>
                                    <input type="text" wire:model.lazy="data.youtube"
                                        class="form-control @error('data.youtube') is-invalid @enderror"
                                        placeholder="Masukkan Link Youtube">
                                    @error('data.youtube')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Twitter</label>
                                    <input type="text" wire:model.lazy="data.twitter"
                                        class="form-control @error('data.twitter') is-invalid @enderror"
                                        placeholder="Masukkan Link Twitter">
                                    @error('data.twitter')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Deskripsi</label>
                                    <div wire:ignore>
                                        <textarea class="form-control @error('data.description') is-invalid @enderror" id="summernote"
                                            wire:model.lazy="data.description"></textarea>
                                    </div>
                                    @error('data.description')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('styles')
        <style>
            .loading:after {
                overflow: hidden;
                display: inline-block;
                vertical-align: bottom;
                -webkit-animation: ellipsis steps(4, end) 900ms infinite;
                animation: ellipsis steps(4, end) 900ms infinite;
                content: "\2026";
                /* ascii code for the ellipsis character */
                width: 0px;
            }

            @keyframes ellipsis {
                to {
                    width: 20px;
                }
            }

            @-webkit-keyframes ellipsis {
                to {
                    width: 20px;
                }
            }
        </style>
    @endpush

    @push('script')
        <!-- Summernote -->
        {{-- <script src="{{ URL::asset('plugins/summernote-angga/js/summernote.js') }}"></script>
      <script src="{{ URL::asset('plugins/typeahead/typeahead.js') }}"></script>
      <script>
         $(document).ready(function() {
            $("#summernote").summernote({
               placeholder: 'Input your content here.....',
               height: 300,
               dialogsInBody: true,
               callbacks: {
                  onChange: function(contents, $editable) {
                     @this.set('deskripsi', contents);
                  },
                  onImageUpload: function(files, editor, welEditable) {

                     for (var i = files.length - 1; i >= 0; i--) {
                        sendFile(files[i], this);
                     }
                  }
               }
            });
         });

         function sendFile(file, el) {
            var form_data = new FormData();
            form_data.append('file', file);
            $.ajax({
               data: form_data,
               type: "POST",
               method: "POST",
               url: "{{ URL::asset('plugins/plugins_summernote.blade.php') }}",
               cache: false,
               contentType: false,
               processData: false,
               success: function(url) {
                  $(el).summernote('editor.insertImage', url);
               }
            });
         }
      </script> --}}
    @endpush

</div>
