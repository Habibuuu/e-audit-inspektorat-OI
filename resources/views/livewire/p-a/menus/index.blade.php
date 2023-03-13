<?php

use Carbon\Carbon;

?>
<div>

    <div class="card">
        <div class="card-body">
            <div class="d-flex gap-2 justify-content-between align-items-center mb-3">
                <div>
                    <h4 class="fw-bold text-dark">
                        <i class="fa fa-list"></i>
                        Daftar Menu Publik
                    </h4>
                </div>

                <div>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal" wire:click.prevent="resetInputFields()">
                        <i class="fas fa-plus"></i>
                        Tambah
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr class="text-center">
                            <th class="text-start">Nama Menu</th>
                            <th width="350px" class="d-none">Parent</th>
                            <th width="150px">Status</th>
                            <th width="250px">
                                <i class="fas fa-cog"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody x-data="{ show: false }">
                        @foreach ($datas as $data)
                            <tr class="text-center">
                                <td @click="show = ! show" style="cursor: pointer" class="text-start">
                                    <h5 class="fw-bold mb-2">
                                        {{ $data->name }}
                                    </h5>
                                </td>
                                <td class="d-none">
                                    {{ $data->Parent ? $data->Parent->name : 'Root' }}
                                </td>
                                <td>
                                    <a href="#" wire:click.prevent='changeStatus({{ $data->id }})'
                                        data-toggle="tooltip" data-placement="bottom" title="Ubah Status"
                                        class="btn btn-rounded btn-{{ $data->status == 'Publish' ? 'success' : 'info' }} d-inline-block">
                                        {{ $data->status == 'Publish' ? 'Publish' : 'Draft' }}
                                    </a>
                                </td>
                                <td>
                                    <div class="d-flex gap-2 justify-content-center align-items-center">
                                        <a href="#" data-toggle="modal" data-target="#updateModal"
                                            wire:click="edit({{ $data->id }})" class="btn btn-sm btn-primary">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                        <a href="#" wire:click="confirmDelete('{{ $data->id }}')"
                                            class="btn btn-sm btn-danger" data-id="{{ $data->id }}"><i
                                                class="fa fa-trash"></i>
                                            Delete</a>
                                    </div>
                                </td>
                            </tr>
                            @foreach ($data->Childs as $child)
                                <tr x-show.transition.in="show" x-cloak class="text-center">
                                    <td class="ps-5 text-start" style="cursor: pointer">
                                        <span class="text-info">
                                            <i class="fas fa-circle"></i>
                                        </span>
                                        <span class="fs-5 fw-bold">
                                            {{ $child->name }}
                                        </span>
                                    </td>
                                    <td class="d-none">
                                        {{ $child->Parent ? $child->Parent->name : 'Root' }}
                                    </td>
                                    <td>
                                        <a href="#" wire:click.prevent='changeStatus({{ $child->id }})'
                                            data-toggle="tooltip" data-placement="bottom" title="Ubah Status"
                                            class="btn btn-rounded btn-{{ $child->status == 'Publish' ? 'success' : 'info' }} d-inline-block">
                                            {{ $child->status == 'Publish' ? 'Publish' : 'Draft' }}
                                        </a>
                                    </td>

                                    <td>
                                        <div class="d-flex gap-2 justify-content-center align-items-center">
                                            <a href="#" data-toggle="modal" data-target="#updateModal"
                                                wire:click="edit({{ $child->id }})" class="btn btn-sm btn-primary">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                            <a href="#" wire:click="confirmDelete('{{ $child->id }}')"
                                                class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>
                                                Delete</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
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
                    <h5 class="modal-title">Tambah Menu</h5>
                    <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="store()"></form>
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label class="form-label">Nama Menu</label>
                                <input wire:ignore type="text" wire:model.defer="nama"
                                    class="form-control @error('nama') is-invalid @enderror"
                                    placeholder="Masukkan Nama Menu" value="{{ $nama }}">
                                @error('nama')
                                    <span class="invalid-feedback d-block">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label class="form-label">Tipe</label>
                                <select class="form-control" wire:model="type">
                                    <option value="url">URL</option>
                                    <option value="page">Halaman</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                @if ($type == 'url')
                                    <label class="form-label">URL</label>
                                    <input wire:ignore type="text" wire:model.defer="url"
                                        class="form-control @error('url') is-invalid @enderror"
                                        placeholder="Masukkan URL" value="{{ $url }}">
                                    @error('url')
                                        <span class="invalid-feedback d-block">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                @endif
                                @if ($type == 'page')
                                    <label class="form-label">Halaman</label>
                                    <select class="form-control" wire:model.defer="page_id">
                                        <option value=""hidden>Pilih Halaman</option>
                                        @foreach ($pages as $page)
                                            <option value="{{ $page->id }}">{{ $page->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('page_id')
                                        <span class="invalid-feedback d-block">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label class="form-label">Parent</label>
                                <select class="form-control" wire:model.defer="parentId">
                                    <option selected hidden>-- Pilih Parent --</option>
                                    <option value="0">Root</option>
                                    @foreach ($parents as $parent)
                                        <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                                    @endforeach
                                </select>
                                @error('parentId')
                                    <small class="text-danger error">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label class="form-label">Urutan</label>
                                <input type="number" min="1" class="form-control" wire:model.defer="sort"
                                    placeholder="Masukkan Nomor Urut Menu"> @error('sort')
                                    <span class="invalid-feedback d-block">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning close-btn" data-dismiss="modal"><i
                            class="fa fa-times"></i>
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
                    <h5 class="modal-title">Edit Menu</h5>
                    <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <input type="hidden" wire:model.defer="dataId">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Nama Menu</label>
                                    <input wire:ignore type="text" wire:model.defer="nama"
                                        class="form-control @error('nama') is-invalid @enderror"
                                        placeholder="Masukkan Nama Menu" value="{{ $nama }}">
                                    @error('nama')
                                        <span class="invalid-feedback d-block">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Tipe</label>
                                    <select class="form-control" wire:model="type">
                                        <option value="url">URL</option>
                                        <option value="page">Halaman</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    @if ($type == 'page')
                                        <label class="form-label">Halaman</label>
                                        <select class="form-control" wire:model.defer="page_id">
                                            <option value=""hidden>Pilih Halaman</option>
                                            @foreach ($pages as $page)
                                                <option value="{{ $page->id }}">{{ $page->title }}</option>
                                            @endforeach
                                        </select>
                                        @error('page_id')
                                            <span class="invalid-feedback d-block">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    @endif

                                    @if ($type == 'url')
                                        <label class="form-label">URL</label>
                                        <input wire:ignore type="text" wire:model.defer="url"
                                            class="form-control @error('url') is-invalid @enderror"
                                            placeholder="Masukkan URL" value="{{ $url }}">
                                        @error('url')
                                            <span class="invalid-feedback d-block">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Parent</label>
                                    <select class="form-control" wire:model.defer="parentId">
                                        <option selected hidden>-- Pilih Parent --</option>
                                        <option value="0">Root</option>
                                        @foreach ($parents as $key => $parent)
                                            <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('parentId')
                                        <small class="text-danger error">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Urutan</label>
                                    <input type="number" min="1" class="form-control"
                                        wire:model.defer="sort" placeholder="Masukkan Nomor Urut Menu">
                                    @error('sort')
                                        <span class="invalid-feedback d-block">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click.prevent="cancel()" class="btn btn-warning"
                        data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                    <button type="button" wire:click.prevent="resetInputFields()"
                        class="btn btn-warning reset-btn"><i class="fa fa-recycle"></i> Reset</button>
                    <button type="button" wire:click.prevent="update()" class="btn btn-primary"><i
                            class="fa fa-save"></i> Simpan</button>
                </div>
            </div>
        </div>
    </div>

</div>
