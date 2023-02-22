<?php

use Carbon\Carbon;

?>
<div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">

                    <div class="form-group mb-3">
                        <label class="form-label">Judul Album</label>
                        <input type="text" class="form-control" wire:model.defer="judul"
                            placeholder="Masukkan Judul Album">
                        @error('judul')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <label class="form-label"><strong>* Max Upload:</strong> 10 Images; 10Mb</label>
                    <div class="d-flex justify-content-center align-items-center" style="height:250px"
                        x-data="drop_file_component()">
                        <div class="p-2 rounded border border-2 d-flex flex-column justify-content-center align-items-center"
                            style="width:100%;height:250px"
                            x-bind:class="dropingFile ? 'bg-dark border-gray-500' : 'border-gray-500 bg-gray-200'"
                            x-on:drop="dropingFile = false"
                            x-on:drop.prevent="
                              handleFileDrop($event)
                          "
                            x-on:dragover.prevent="dropingFile = true" x-on:dragleave.prevent="dropingFile = false">

                            <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="50%" height="50%"
                                viewBox="0 0 980.000000 980.000000" preserveAspectRatio="xMidYMid meet">
                                <g transform="translate(0.000000,980.000000) scale(0.100000,-0.100000)" fill="#000000"
                                    stroke="none">

                                    <path
                                        d="M1381 9789 c-41 -5 -121 -20 -178 -34 -636 -153 -1119 -700 -1193
                                    -1350 -14 -124 -14 -6886 0 -7010 83 -728 667 -1307 1396 -1385 80 -8 746 -10
                                    2529 -8 l2420 3 42 23 c66 35 110 79 140 140 23 46 28 70 28 128 -1 120 -64
                                    217 -174 268 l-46 21 -2470 5 -2470 5 -76 22 c-376 107 -643 389 -720 758 -18
                                    87 -19 210 -19 3525 0 3315 1 3438 19 3525 41 199 135 369 282 510 140 135
                                    297 218 484 256 87 18 214 19 3525 19 3315 0 3438 -1 3525 -19 199 -41 369
                                    -135 510 -282 124 -130 197 -257 248 -439 l22 -75 5 -2461 5 -2460 30 -59
                                    c110 -215 418 -208 526 11 l24 49 3 2405 c2 1773 0 2434 -8 2514 -40 373 -202
                                    702 -477 966 -219 211 -461 339 -778 412 l-100 23 -3490 1 c-1920 1 -3523 -2
                                    -3564 -7z" />

                                    <path
                                        d="M2855 7440 c-124 -33 -210 -85 -310 -185 -145 -144 -205 -287 -205
                                    -491 0 -277 147 -512 395 -630 103 -49 184 -67 300 -67 119 0 199 18 310 72
                                    146 71 250 177 321 326 96 200 90 429 -14 630 -56 107 -191 239 -302 292 -47
                                    23 -115 48 -151 57 -90 22 -254 20 -344 -4z" />

                                    <path
                                        d="M5435 5573 c-604 -780 -1101 -1421 -1104 -1425 -4 -5 -140 217 -301
                                    492 -162 275 -298 498 -302 497 -9 -3 -2332 -2348 -2336 -2358 -2 -5 855 -9
                                    1914 -9 l1918 0 76 78 c184 192 396 300 653 332 45 5 218 10 384 10 l303 0 0
                                    283 c1 319 10 446 40 562 25 95 91 238 150 326 85 126 246 268 380 335 28 14
                                    50 30 50 36 0 6 -20 80 -45 164 -25 83 -45 158 -45 166 0 14 -627 1918 -634
                                    1925 -2 2 -497 -635 -1101 -1414z" />

                                    <path
                                        d="M7625 4207 c-65 -22 -99 -43 -139 -87 -75 -84 -70 -25 -76 -905 l-5
                                    -790 -795 -5 -795 -5 -46 -27 c-55 -33 -105 -87 -130 -142 -23 -51 -25 -155
                                    -3 -219 20 -60 79 -126 140 -157 l49 -25 793 -3 792 -2 0 -783 0 -782 28 -60
                                    c51 -107 146 -168 262 -168 118 0 221 67 272 178 l23 50 3 782 3 783 792 2
                                    c791 3 792 3 832 25 51 27 119 99 141 150 26 58 24 176 -3 234 -25 56 -84 117
                                    -138 144 -39 19 -67 20 -832 23 l-792 2 -3 783 -3 782 -26 56 c-32 67 -87 125
                                    -145 150 -56 25 -148 32 -199 16z" />
                                </g>
                            </svg>

                            <input type="file" wire:model="images" accept="image/*"
                                style="opacity: 0; position: absolute; width:80%; height:250px; cursor: pointer;"
                                multiple wire:loading.remove wire:target="images">
                            <div class="text-center" wire:loading.remove wire:target="images">
                                Drop Your Images Here
                            </div>

                            <div wire:loading.flex wire:target="images">
                                <div class="d-flex justify-content-center align-items-center gap-2">
                                    <div class="spinner-border" role="status">
                                    </div>
                                    <h3 class="m-0">Processing Images...</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-8">

                    @if ($images)
                        <div class="row g-2">

                            @foreach ($images as $image)
                                <div class="col-lg-4 col-sm-6">
                                    <div class="thumbnail">
                                        <div class="thumb">
                                            <a href="{{ $image->temporaryUrl() }}" data-lightbox="1"
                                                data-title="No Caption">
                                                <img src="{{ $image->temporaryUrl() }}" alt="image"
                                                    class="img-fluid img-thumbnail img-container mb-4"
                                                    style="object-fit: contain">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    @endif

                </div>
                <div class="col-md-12">
                    <div class="d-flex mt-2 justify-content-end">
                        <a href="{{ route('admin.gallery-index') }}" class="btn btn-info mx-1">
                            <i class="fas fa-arrow-left"></i>
                            Kembali
                        </a>
                        <button type="button" class="btn btn-success mx-1" wire:click.prevent="store()">
                            <i class="fas fa-save"></i>
                            Simpan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <!-- Lightbox2-->
        <link rel="stylesheet" href="{{ asset('temp/admin/v1/plugins/lightbox2/css/lightbox.css') }}">
    @endpush

    @push('script')
        <!--Lightbox JS-->
        <script src="{{ asset('temp/admin/v1/plugins/lightbox2/js/lightbox.min.js') }}"></script>
        <script>
            function drop_file_component() {
                return {
                    dropingFile: false,
                    handleFileDrop(e) {
                        if (event.dataTransfer.files.length > 0) {
                            const files = e.dataTransfer.files;
                            @this.uploadMultiple('images', files,
                                (uploadedFilename) => {}, () => {}, (event) => {}
                            )
                        }
                    }
                };
            }
        </script>
        {{-- <script src="{{ asset('admin_assets/node_modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script> --}}
    @endpush
</div>
