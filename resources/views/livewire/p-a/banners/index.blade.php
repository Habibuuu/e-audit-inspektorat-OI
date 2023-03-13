<?php

use Carbon\Carbon;

?>
<div>

    <div class="card">
        <div class="card-body">
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mb-3">
                <h4 class="text-dark fw-bold">
                    <i class="fa fa-list"></i>
                    Banners
                </h4>
                <button type="button" class="btn btn-primary px-3" data-bs-toggle="modal" data-bs-target="#addModal"
                    wire:click.prevent="cancel()">
                    <i class="fas fa-plus"></i>
                    Tambah Banner
                </button>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr class="text-center">
                            <th class="text-start">Judul</th>
                            <th width="350px">File</th>
                            <th width="150px">Status</th>
                            <th width="250px">
                                <i class="fas fa-cog"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($datas as $data)
                            <tr class="text-center">
                                <td class="text-start">
                                    <h3 class="fw-bold">
                                        {{ $data->title }}
                                    </h3>
                                </td>
                                <td>
                                    <div class="thumbnail">
                                        <div class="thumb">
                                            <a href="{{ asset('/storage/banners/' . $data->filename) }}"
                                                data-lightbox="1" data-title="{{ $data->caption }}">
                                                <img src="{{ asset('/storage/banners/' . $data->filename) }}"
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
                                    <div class="d-flex justify-content-center" style="gap: 5px;">
                                        <button class="btn btn-outline-primary btn-rounded" data-toggle="modal"
                                            data-target="#updateModal" wire:click="edit({{ $data->id }})"><i
                                                class="fa fa-edit"></i> Edit</button>
                                        <button wire:click="confirmDelete('{{ $data->id }}')"
                                            class="btn btn-outline-danger btn-rounded"><i class="fa fa-trash"></i>
                                            Delete</button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="100">

                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="100">
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
                    <h5 class="modal-title">Tambah Banner</h5>
                    <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Judul Banner</label>
                                    <input wire:ignore type="text" wire:model.defer="judul"
                                        class="form-control @error('judul') is-invalid @enderror"
                                        placeholder="Masukkan Judul Banner" value="{{ $judul }}">
                                    @error('judul')
                                        <span class="invalid-feedback d-block">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Caption</label>
                                    <input wire:ignore type="text" wire:model.defer="caption"
                                        class="form-control @error('caption') is-invalid @enderror"
                                        placeholder="Masukkan Caption" value="{{ $caption }}">
                                    @error('caption')
                                        <span class="invalid-feedback d-block">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Input File</label>
                                    <input type="file" wire:model.defer="file" class="form-control"
                                        accept=".jpg, .jpeg, .png">
                                    @error('file')
                                        <small class="text-danger error">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning close-btn" data-bs-dismiss="modal"><i
                            class="fa fa-times"></i>
                        Tutup</button>
                    <button type="button" wire:click.prevent="resetInputFields()" class="btn btn-warning reset-btn"><i
                            class="fa fa-recycle"></i> Reset</button>
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
                    <h5 class="modal-title">Edit Banner</h5>
                    <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <input type="hidden" wire:model.defer="dataId">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Judul Banner</label>
                                    <input wire:ignore type="text" wire:model.defer="judul"
                                        class="form-control @error('judul') is-invalid @enderror"
                                        placeholder="Masukkan Judul Banner" value="{{ $judul }}">
                                    @error('judul')
                                        <span class="invalid-feedback d-block">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Caption</label>
                                    <input wire:ignore type="text" wire:model.defer="caption"
                                        class="form-control @error('caption') is-invalid @enderror"
                                        placeholder="Masukkan Caption" value="{{ $caption }}">
                                    @error('caption')
                                        <span class="invalid-feedback d-block">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Input File</label>
                                    <input type="file" wire:model.defer="file" class="form-control">
                                    <small class="text-warning" wire:loading wire:target="file">Uploading...</small>
                                    @error('file')
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
