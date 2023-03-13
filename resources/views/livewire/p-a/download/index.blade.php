<?php

use Carbon\Carbon;

?>
<div>

    <div class="card">
        <div class="card-body">
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mb-3">
                <h4 class="text-dark fw-bold">
                    <i class="fa fa-list"></i>
                    Download
                </h4>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal"
                    wire:click.prevent="cancel()">
                    Tambah
                </button>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th width="350px">File</th>
                            <th width="150px">Status</th>
                            <th width="250px" class="text-center">
                                <i class="fas fa-cog"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($datas as $data)
                            <tr>
                                <td class="align-middle-center">
                                    <h4 class="fw-bold">
                                        {{ $data->title }}
                                    </h4>
                                </td>
                                <td>
                                    <a href="https://drive.google.com/file/d/{{ $data->google_id }}/view?usp=sharing"
                                        class="fw-bold fs-6" target="_blank">
                                        <i class="fas fa-external-link-alt"></i>
                                        Link
                                    </a>
                                </td>
                                <td>
                                    <a href="#" wire:click.prevent='changeStatus({{ $data->id }})'
                                        data-toggle="tooltip" data-placement="bottom" title="Ubah Status"
                                        class="btn btn-{{ $data->status == 'Publish' ? 'success' : 'info' }} btn-rounded">
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
                    <h5 class="modal-title">{{ $updateMode == false ? 'Tambah' : 'Edit' }} Download</h5>
                    <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form {{ $updateMode == false ? 'wire:submit.prevent=store()' : 'wire:submit.prevent=update()' }}>
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Judul</label>
                                    <input type="text" wire:model.defer="title"
                                        class="form-control @error('title') is-invalid @enderror"
                                        placeholder="Masukkan Judul">
                                    @error('title')
                                        <span class="invalid-feedback d-block">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Deskripsi</label>
                                    <input type="text" wire:model.defer="description"
                                        class="form-control @error('description') is-invalid @enderror"
                                        placeholder="Masukkan Deskripsi">
                                    @error('description')
                                        <span class="invalid-feedback d-block">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-3" wire:loading.remove wire:target="file">
                                    <label class="form-label">Input File</label>
                                    <input type="file" wire:model.defer="file" class="form-control"
                                        accept=".jpg, .jpeg, .png,.pdf,.rar,.zip,.doc,.docx,.xls,.xlsx">
                                    @error('file')
                                        <small class="text-danger error">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div wire:loading wire:target="file" class="w-100 mb-4">
                                    <div class="d-flex gap-2 justify-content-center align-items-center">
                                        <div class="spinner-border" role="status">
                                        </div>
                                        <span>Uploading...</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="d-flex gap-2 justify-content-end">
                                <button type="button" class="btn btn-warning close-btn" data-dismiss="modal">
                                    <i class="fa fa-times"></i>
                                    Tutup
                                </button>

                                <button type="button" wire:click.prevent="resetInputFields()"
                                    class="btn btn-warning reset-btn">
                                    <i class="fa fa-recycle"></i>
                                    Reset
                                </button>


                                <button type="submit" class="btn btn-primary close-modal" wire:loading.remove
                                    wire:target="store">
                                    <i class="fa fa-save"></i>
                                    Simpan
                                </button>

                                <div class="btn btn-primary" wire:loading wire:target="store">
                                    <div class="d-flex gap-2 align-items-center justify-content-center">
                                        <div class="spinner-border text-light" role="status"
                                            style="height:20px; width:20px">
                                        </div>
                                        <span class="">Loading...</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('style')
    <style>
        input[type=file]::file-selector-button {
        margin-right: 10px;
        border: none;
        background: #23b5e2;
        border-radius: 10px;
        color: #fff;
        cursor: pointer;
        transition: background .2s ease-in-out;
        }

        input[type=file]::file-selector-button:hover {
        background: #73dcfb;
        }
    </style>

</div>
