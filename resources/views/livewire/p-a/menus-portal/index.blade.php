<?php

use Carbon\Carbon;

?>
<div>

    <div class="card">
        <div class="card-body">
            <div class="d-flex flex-column flex-sm-row gap-2 justify-content-between mb-3">
                <h4 class="text-dark fw-bold">
                    <i class="fa fa-list"></i>
                    Portal
                </h4>

                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal"
                    wire:click.prevent="cancel()">
                    <i class="fas fa-plus"></i>
                    Tambah Portal
                </button>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr class="text-center">
                            <th width="1px">No.</th>
                            <th class="text-start">Judul</th>
                            <th width="350px">Gambar</th>
                            <th width="150px">Status</th>
                            <th width="250px">
                                <i class="fas fa-cog"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $data)
                            <tr class="text-center">
                                <td>{{ $data->sort }}</td>
                                <td class="text-start">
                                    <h3 class="fw-bold">
                                        {{ $data->name }}
                                    </h3>
                                </td>
                                <td>
                                    <div class="thumbnail">
                                        <div class="thumb">
                                            <a href="{{ asset('/storage/portals/' . $data->image) }}" data-lightbox="1">
                                                <img src="{{ asset('/storage/portals/' . $data->image) }}"
                                                    alt="image" class="img-fluid img-thumbnail"
                                                    style="height: 150px; object-fit:contain">
                                            </a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="#" wire:click.prevent='changeStatus({{ $data->id }})'
                                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ubah Status"
                                        class="btn btn-rounded btn-{{ $data->status == 'Publish' ? 'success' : 'info' }} d-inline-block">
                                        {{ $data->status == 'Publish' ? 'Publish' : 'Draft' }}
                                    </a>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#updateModal"
                                            class="btn btn-sm btn-primary" wire:click="edit({{ $data->id }})"><i
                                                class="fa fa-edit"></i> Edit</button>
                                        <button type="button" wire:click="confirmDelete('{{ $data->id }}')"
                                            class="btn btn-sm btn-danger">
                                            <i class="fa fa-trash"></i>
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="1000">
                                {{ $datas->links() }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <div wire:ignore.self class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Portal</h5>
                    <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">??</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Judul Portal</label>
                                    <input wire:ignore type="text" wire:model.defer="judul"
                                        class="form-control @error('judul') is-invalid @enderror"
                                        placeholder="Masukkan Judul Portal">
                                    @error('judul')
                                        <span class="invalid-feedback d-block">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Nomor Urutan</label>
                                    <input wire:ignore type="number" wire:model.defer="urutan"
                                        class="form-control @error('urutan') is-invalid @enderror"
                                        placeholder="Masukkan Nomor Urutan">
                                    @error('urutan')
                                        <span class="invalid-feedback d-block">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 d-none">
                                <div class="form-group mb-3">
                                    <label class="form-label">Caption</label>
                                    <input wire:ignore type="text" wire:model.defer="caption"
                                        class="form-control @error('caption') is-invalid @enderror"
                                        placeholder="Masukkan Caption">
                                    @error('caption')
                                        <span class="invalid-feedback d-block">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">URL</label>
                                    <input wire:ignore type="text" wire:model.defer="url"
                                        class="form-control @error('url') is-invalid @enderror"
                                        placeholder="Masukkan URL">
                                    @error('url')
                                        <span class="invalid-feedback d-block">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Input Gambar</label>
                                    <input type="file" wire:model.defer="gambar" class="form-control"
                                        accept=".jpg, .jpeg, .png">
                                    @error('gambar')
                                        <small class="text-danger error">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning close-btn" data-bs-dismiss="modal"
                        wire:click.prevent="cancel()"><i class="fa fa-times"></i>
                        Tutup</button>
                    <button type="button" wire:click.prevent="resetInputFields()"
                        class="btn btn-warning reset-btn"><i class="fa fa-recycle"></i> Reset</button>
                    <button type="button" wire:click.prevent="store()" class="btn btn-primary close-modal"><i
                            class="fa fa-save"></i> Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div wire:ignore.self class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Portal</h5>
                    <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">??</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <input type="hidden" wire:model.defer="dataId">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Judul Portal</label>
                                    <input wire:ignore type="text" wire:model.defer="judul"
                                        class="form-control @error('judul') is-invalid @enderror"
                                        placeholder="Masukkan Judul Portal">
                                    @error('judul')
                                        <span class="invalid-feedback d-block">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Nomor Urutan</label>
                                    <input wire:ignore type="number" wire:model.defer="urutan"
                                        class="form-control @error('urutan') is-invalid @enderror"
                                        placeholder="Masukkan Nomor Urutan">
                                    @error('urutan')
                                        <span class="invalid-feedback d-block">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 d-none">
                                <div class="form-group mb-3">
                                    <label class="form-label">Caption</label>
                                    <input wire:ignore type="text" wire:model.defer="caption"
                                        class="form-control @error('caption') is-invalid @enderror"
                                        placeholder="Masukkan Caption">
                                    @error('caption')
                                        <span class="invalid-feedback d-block">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">URL</label>
                                    <input wire:ignore type="text" wire:model.defer="url"
                                        class="form-control @error('url') is-invalid @enderror"
                                        placeholder="Masukkan URL">
                                    @error('url')
                                        <span class="invalid-feedback d-block">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Input Gambar</label>
                                    <input type="file" wire:model.defer="gambar" class="form-control">
                                    <small class="text-warning" wire:loading wire:target="gambar">Uploading...</small>
                                    @error('gambar')
                                        <small class="text-danger error">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click.prevent="cancel()" class="btn btn-warning"
                        data-bs-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                    <button type="button" wire:click.prevent="resetInputFields()"
                        class="btn btn-warning reset-btn"><i class="fa fa-recycle"></i> Reset</button>
                    <button type="button" wire:click.prevent="update()" class="btn btn-primary"><i
                            class="fa fa-save"></i> Simpan</button>
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
    @endpush

</div>
