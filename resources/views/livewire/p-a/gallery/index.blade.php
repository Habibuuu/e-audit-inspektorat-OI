<?php

use Carbon\Carbon;

?>
<div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex gap-2 flex-column flex-sm-row justify-content-between">
                <h4 class="text-dark fw-bold">
                    <i class="fa fa-list"></i>
                    Gallery Photo
                </h4>
                <div>
                    <button type="button" class="btn btn-success d-none" data-toggle="modal" data-target="#modalKategori">
                        <i class="fas fa-plus"></i> &nbsp;
                        Tambah Kategori
                    </button>
                    <button type="button" class="btn btn-primary d-none" data-toggle="modal" data-target="#modalPhoto"
                        wire:click.prevent="resetField()">
                        <i class="fas fa-plus"></i> &nbsp;
                        Tambah Album
                    </button>
                    <a href="{{ route('admin.gallery-create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> &nbsp;
                        Tambah Album
                    </a>
                </div>
            </div>

            <div class="row">
                @forelse ($datas as $data)
                    <div class="col-md-4">
                        <div class="card bg-dark text-white">
                            @if ($data->Thumbnail)
                                <img src="{{ asset('storage/gallery/' . $data->Thumbnail->image) }}" class="card-img"
                                    style="height:250px; object-fit:cover">
                            @else
                                <img src="{{ asset('storage/gallery/default.jpg') }}" class="card-img"
                                    style="height:250px; object-fit:cover">
                            @endif
                            <div class="card-img-overlay h-50 top-50" style="background: rgba(0,0,0,0.5)">
                                <a href="{{ route('admin.gallery-edit', $data->id) }}">
                                    <h5 class="card-title text-white fw-bold">
                                        {{ $data->title }}
                                    </h5>
                                </a>
                                <p class="card-text">
                                    <i class="fas fa-calendar-alt"></i> &nbsp;
                                    {{ Carbon::parse($data->created_at)->isoFormat('DD MMM YYYY') }}
                                </p>

                                <div style="position: absolute; bottom:10px; left;0; width:80%; height:50px;">
                                    <div class="d-flex mt-2" style="gap: 5px;">
                                        <a href="{{ route('admin.gallery-edit', $data->id) }}" class="btn btn-info">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger"
                                            wire:click.prevent="confirmDelete('{{ $data->id }}')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12">
                        <h4 class="text-center">Tidak Ada Data</h4>
                    </div>
                @endforelse

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="modalPhoto" tabindex="-1" aria-labelledby="modalPhotoLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPhotoLabel">
                        {{ $editMode == false ? 'Tambah' : 'Edit' }} Photo
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="row"
                        @if ($editMode == false) wire:submit.prevent="storePhoto()" @elseif($editMode == true)  wire:submit.prevent="updatePhoto()" @endif>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Judul</label>
                                <input type="text" class="form-control" wire:model="judul"
                                    placeholder="Masukkan Judul">
                                @error('judul')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kategori</label>
                                <select class="form-control" wire:model.defer="kategori">
                                    <option value="" hidden>Pilih Kategori</option>
                                    @foreach ($arrKategori as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('kategori')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Photo</label>
                                <input type="file" class="form-control" wire:model="photo" placeholder="Photo">
                                @error('photo')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            @if ($photoPrev)
                                <img src="{{ asset('storage/gallery/' . $photoPrev) }}" class="img img-thumbnail"
                                    style="max-height:200px">
                            @elseif($photo)
                                <img src="{{ $photo->temporaryUrl() }}" class="img img-thumbnail"
                                    style="max-height:200px">
                            @endif
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Caption</label>
                                <textarea class="form-control" placeholder="Masukkan Caption" wire:model="konten" style="min-height: 150px"></textarea>
                                @error('konten')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i>
                                Simpan
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="modalKategori" tabindex="-1" aria-labelledby="modalKategoriLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalKategoriLabel">
                        Tambah Kategori
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="row" wire:submit.prevent="storeKategori()">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nama Kategori</label>
                                <input type="text" class="form-control" wire:model.defer="nama_kategori"
                                    placeholder="Nama Kategori">
                                @error('nama_kategori')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i>
                                Tambahkan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
