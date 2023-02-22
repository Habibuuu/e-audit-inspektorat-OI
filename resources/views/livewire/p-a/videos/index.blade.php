<?php

use Carbon\Carbon;

?>
<div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex flex-column flex-sm-row gap-2 justify-content-between mb-3">
                <h4 class="text-dark fw-bold">
                    <i class="fa fa-list"></i>
                    Daftar Video
                </h4>

                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal"
                    wire:click.prevent="cancel()">
                    <i class="fas fa-plus"></i>
                    Tambah Video
                </button>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr class="text-center">
                            <th>Judul</th>
                            <th width="350px">Thumbnail</th>
                            <th width="150px">Status</th>
                            <th width="250px">
                                <i class="fas fa-cog"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $data)
                            <tr class="text-center">
                                <td class="text-start">
                                    <h4 class="fw-bold ps-2">
                                        {{ $data->title }}
                                    </h4>
                                </td>
                                <td>
                                    <img id="img" class="style-scope yt-img-shadow img-thumbnail"
                                        style="height:150px !important;"
                                        src="https://i.ytimg.com/vi/{{ $data->youtube_id }}/hq720.jpg">
                                </td>
                                <td>
                                    <a href="#" wire:click.prevent='changeStatus({{ $data->id }})'
                                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ubah Status"
                                        class="btn btn-{{ $data->status == 'Publish' ? 'success' : 'info' }} btn-rounded">
                                        {{ $data->status == 'Publish' ? 'Publish' : 'Draft' }}
                                    </a>
                                </td>
                                <td>
                                    <div class="d-flex gap-2 justify-content-center">
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#updateModal" wire:click="edit({{ $data->id }})">
                                            <i class="fa fa-edit"></i>
                                            Edit
                                        </button>
                                        <button wire:click="confirmDelete('{{ $data->id }}')"
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
                            <td colspan="4">
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
                    <h5 class="modal-title">Tambah Video</h5>
                    <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Judul Video</label>
                                    <input wire:ignore type="text" wire:model.defer="judul"
                                        class="form-control @error('judul') is-invalid @enderror"
                                        placeholder="Masukkan Judul Video" value="{{ $judul }}">
                                    @error('judul')
                                        <span class="invalid-feedback d-block">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Link Youtube</label>
                                    <input type="text" wire:model.defer="linkYoutube" class="form-control"
                                        placeholder="Masukan Link Youtube">
                                    @error('linkYoutube')
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
                    <h5 class="modal-title">Edit Video</h5>
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
                                    <label class="form-label">Judul Video</label>
                                    <input wire:ignore type="text" wire:model.defer="judul"
                                        class="form-control @error('judul') is-invalid @enderror"
                                        placeholder="Masukkan Judul Video" value="{{ $judul }}">
                                    @error('judul')
                                        <span class="invalid-feedback d-block">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Link Youtube</label>
                                    <input type="text" wire:model.defer="linkYoutube" class="form-control"
                                        placeholder="Masukan Link Youtube">
                                    @error('linkYoutube')
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
    @endpush

</div>
