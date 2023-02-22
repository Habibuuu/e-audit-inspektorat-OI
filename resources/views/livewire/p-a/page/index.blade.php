<?php

use Carbon\Carbon;

?>
<div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex flex-column flex-sm-row justify-content-between mb-3">
                <h4 class="text-dark fw-bold">
                    <i class="fa fa-list"></i>
                    Daftar Halaman
                </h4>
                <div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fas fa-filter"></i>
                            Filter
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" style="width:350px">
                            <form wire:submit.prevent="filter()" class="p-4">
                                <div class="form-group mb-3">
                                    <label class="form-label">Judul Halaman</label>
                                    <input type="text" class="form-control" placeholder="Cari Judul Halaman..."
                                        wire:model.defer="filterJudul">
                                </div>
                                <div class="form-group text-end mb-3">
                                    <button type="button" class="btn btn-info" wire:click.prevent="resetFilter()">
                                        <i class="fas fa-recycle"></i>
                                        Reset
                                    </button>
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-search"></i>
                                        Terapkan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <a href="{{ route('admin.page-create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        Tambah Halaman
                    </a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Judul Halaman</th>
                            <th>Status</th>
                            <th width="350px" class="text-center">
                                <i class="fas fa-cog"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($datas as $data)
                            <tr>
                                <td>
                                    <h5 class="fw-bold mb-1">
                                        {{ $data->title }}
                                    </h5>
                                    <div class="text-muted">
                                        <i class="fa fa-calendar-alt"></i>
                                        {{ Carbon::parse($data->created_at)->locale('id_ID')->isoFormat('Do MMMM YYYY [| Jam ] H:mm') }}
                                    </div>
                                </td>
                                <td>
                                    <a href="#" wire:click.prevent='changeStatus({{ $data->id }})'
                                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ubah Status"
                                        class="btn btn-{{ $data->status == 'Post' ? 'success' : 'info' }} btn-rounded">
                                        {{ $data->status == 'Post' ? 'Post' : 'Draft' }}
                                    </a>
                                    @if ($data->is_auto_publish == 1 && $data->published_at > now())
                                        <div>
                                            <small class="text-success">*Auto Post!</small>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a class="btn btn-sm btn-info" target="_blank" href="{{ route('public.page-detail' , $data->slug) }}">
                                            <i class="fa fa-eye"></i>
                                            Lihat
                                        </a>
                                        <a class="btn btn-sm btn-primary"
                                            href="{{ route('admin.page-edit', $data->id) }}">
                                            <i class="fa fa-edit"></i>
                                            Edit
                                        </a>
                                        <a href="#" wire:click="confirmDelete('{{ $data->id }}')"
                                            class="btn btn-sm btn-danger">
                                            <i class="fa fa-trash"></i>
                                            Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="1000">
                                    <h5 class="text-center">No Data.</h5>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5">
                                {{ $datas->links() }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
