<?php

use Carbon\Carbon;

?>
<div>
    <div>
        @push('page_title')
        {{ 'Infografis | Panel Admin' }}
        @endpush

        <div class="section-header">
            <h1>Daftar Infografis</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Infografis</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
                                Tambah
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="1px">No.</th>
                                            <th>Judul</th>
                                            <th width="350px">File</th>
                                            <th width="150px">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($datas as $data)
                                        <tr id="item-{{ $data->id }}">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <a href="#">
                                                    {{ $data->title }}
                                                </a>
                                                <div class="table-links">
                                                    <a href="#" data-toggle="modal" data-target="#updateModal" wire:click="edit({{ $data->id }})"><i class="fa fa-edit"></i> Edit</a>
                                                    <div class="bullet"></div>
                                                    <a href="#" wire:click="$emit('triggerDelete',{{ $data->id }})" class="text-danger" data-id="{{ $data->id }}"><i class="fa fa-trash"></i> Delete</a>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="#" data-toggle="modal" data-target="#updateModal" wire:click="edit({{ $data->id }})">
                                                    <img src="{{ asset('/storage/infographics/small/'.$data->filename) }}" class="img-thumbnail" style="height:200px !important;">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" wire:click.prevent='changeStatus({{ $data->id }})' data-toggle="tooltip" data-placement="bottom" title="Ubah Status" class="badge badge-{{ $data->status == 'Publish' ? 'success' : 'info' }} d-inline-block">
                                                    {{ $data->status == 'Publish' ? 'Publish' : 'Draft' }}
                                                </a>
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
                </div>
            </div>
        </div>

        <!-- Add Modal -->
        <div wire:ignore.self class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-hidden="false">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Infografis</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            @csrf
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Judul Infografis</label>
                                        <input wire:ignore type="text" wire:model.defer="judul" class="form-control @error('judul') is-invalid @enderror" placeholder="Masukkan Judul Infografis" value="{{ $judul }}">
                                        @error('judul')
                                        <span class="invalid-feedback d-block">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Jenis</label>
                                        <select class="form-control @error('tipe') is-invalid @enderror" wire:model.defer="tipe">
                                            <option hidden>Pilih Jenis Infografis</option>
                                            @foreach($types as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('tipe')
                                        <span class="invalid-feedback d-block">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Input File</label>
                                        <input type="file" wire:model.defer="file" class="form-control">
                                        @error('file')
                                        <small class="text-danger error">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning close-btn" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                        <button type="button" wire:click.prevent="resetInputFields()" class="btn btn-warning reset-btn"><i class="fa fa-recycle"></i> Reset</button>
                        <button type="button" wire:click.prevent="store()" class="btn btn-primary close-modal"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <div wire:ignore.self class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Infografis</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <input type="hidden" wire:model.defer="dataId">
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Judul Infografis</label>
                                        <input wire:ignore type="text" wire:model.defer="judul" class="form-control @error('judul') is-invalid @enderror" placeholder="Masukkan Judul Infografis" value="{{ $judul }}">
                                        @error('judul')
                                        <span class="invalid-feedback d-block">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Jenis</label>
                                        <select class="form-control @error('tipe') is-invalid @enderror" wire:model.defer="tipe">
                                            <option hidden>Pilih Jenis Infografis</option>
                                            @foreach($types as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('tipe')
                                        <span class="invalid-feedback d-block">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Gambar Saat Ini :</label>
                                        <a href="{{ asset('/storage/infographics/small/'.$fileGet) }}" target="_blank">
                                            <img src="{{ asset('/storage/infographics/small/'.$fileGet) }}" class="img-fluid" style="height: 150px !important;">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Input File</label>
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
                        <button type="button" wire:click.prevent="cancel()" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                        <button type="button" wire:click.prevent="resetInputFields()" class="btn btn-warning reset-btn"><i class="fa fa-recycle"></i> Reset</button>
                        <button type="button" wire:click.prevent="update()" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                </div>
            </div>
        </div>

        @push('styles')

        @endpush

        @push('script')
        <script type="text/javascript">
            window.livewire.on('dataStore', () => {
                $('.modal').modal('hide');
            });
        </script>
        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function() {
                @this.on('triggerDelete', dataId => {
                    Swal.fire({
                        title: 'Apakah Anda Yakin?',
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#aaa',
                        confirmButtonText: 'Hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        //if user clicks on delete
                        if (result.value) {
                            // calling destroy method to delete
                            @this.call('delete', dataId)
                        }
                    });
                });
            })
        </script>
        @endpush

    </div>
</div>
