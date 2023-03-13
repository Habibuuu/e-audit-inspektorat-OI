<?php

use Carbon\Carbon;

?>
<div>
    <div class="card">
        <div class="card-body">

            <div class="d-flex flex-column flex-sm-row justify-content-between mb-3">
                <h4 class="text-dark fw-bold">
                    <i class="fa fa-list"></i>
                    Daftar Artikel
                </h4>
                <div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" data-display="static" aria-expanded="false">
                            Filter <i class="fas fa-filter"></i>
                        </button>

                        <div wire:ignore.self class="dropdown-menu dropdown-menu-lg-right" style="min-width:350px">
                            <form wire:submit.prevent="filter()" class="p-4">
                                <div class="form-group mb-3">
                                    <label class="form-label">Judul Artikel</label>
                                    <input type="text" class="form-control" placeholder="Cari Judul Artikel..."
                                        wire:model.defer="filterJudul">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Jenis Artikel :</label>
                                    <select class="form-control" wire:model.defer="filterJenis">
                                        <option value="">Semua</option>
                                        @foreach ($arrJenis as $jns)
                                            <option value="{{ $jns->id }}">{{ $jns->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3 text-end">
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


                    <a href="{{ route('admin.articles-create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        Tambah Artikel
                    </a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th width="1px">No.</th>
                            <th>Judul</th>
                            <th width="200px">Jenis Artikel</th>
                            <th width="200px" class="d-none">Auto Publish</th>
                            <th width="125px">Status</th>
                            <th width="250px" class="text-center">
                                <i class="fas fa-cog"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($datas as $data)
                            <tr id="item-{{ $data->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <a href="{{ route('admin.articles-edit', $data->id) }}">
                                        {{ $data->title }}
                                        @if ($data->is_recommend == 1)
                                            <i class="fa fa-check ml-2 text-success" title="Rekomendasi"></i>
                                        @endif
                                    </a>
                                    <div>
                                        <span class="text-muted">
                                            <i class="fa fa-calendar-alt"></i>
                                            {{ Carbon::parse($data->published_at)->locale('id_ID')->isoFormat('Do MMMM YYYY [| Jam ] HH:mm') }}
                                        </span>
                                    </div>
                                </td>
                                <td>{{ $data->Type->name ?? '-' }}</td>
                                <td class="text-center d-none">
                                    <div class="text-info fw-bold fs-4">
                                        {!! $data->is_auto_publish == 1 ? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>' !!}
                                    </div>
                                    <div class="">
                                        @if ($data->is_auto_publish == 1)
                                            <small>
                                                <i class="fa fa-calendar-alt"></i>
                                                {{ Carbon::parse($data->published_at)->locale('id_ID')->isoFormat('Do MMMM YYYY [| Jam ] HH:mm ') }}
                                            </small>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <a href="#" wire:click.prevent='changeStatus({{ $data->id }})'
                                        data-toggle="tooltip" data-placement="bottom" title="Ubah Status"
                                        class="btn btn-{{ $data->status == 'Publish' ? 'success' : 'info' }} btn-rounded">
                                        {{ $data->status == 'Publish' ? 'Publish' : 'Draft' }}
                                    </a>
                                    @if ($data->is_auto_publish == 1 && $data->published_at > now())
                                        <div>
                                            <small class="text-success">*Auto Publish!</small>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center" style="gap: 5px;">
                                        <a class="btn btn-outline-primary btn-rounded"
                                            href="{{ route('admin.articles-edit', $data->id) }}">
                                            <i class="fa fa-edit"></i>
                                            Edit
                                        </a>
                                        <button wire:click="confirmDelete('{{ $data->id }}')"
                                            class="btn btn-outline-danger btn-rounded">
                                            <i class="fa fa-trash"></i>
                                            Delete
                                        </button>
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
                            <td colspan="5222">
                                {{ $datas->links() }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    @push('script')
        <script type="text/javascript">
            $( "select" ).click(function( event ) {
                event.stopPropagation();
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
