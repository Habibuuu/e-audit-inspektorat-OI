<div>

    <div class="card">
        <div class="card-body">
            <div class="d-flex flex-column flex-sm-row gap-2 justify-content-between mb-3">
                <h4 class="text-dark fw-bold">
                    <i class="fa fa-list"></i>
                    Daftar Tag
                </h4>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal"
                    wire:click.prevent="cancel()">
                    <i class="fas fa-plus"></i>
                    Tambah Tag
                </button>
            </div>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th width="1px">No.</th>
                            <th>Nama</th>
                            <th width="200px" class="text-center">Jumlah Artikel</th>
                            <th width="250px">
                                <i class="fas fa-cog"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $data)
                            <tr id="item-{{ $data->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    {{ $data->name }}
                                </td>
                                <td class="text-center">
                                    {{ $data->Articles->count() }}
                                </td>
                                <td>
                                    <div class="d-flex gap-2 justify-content-center">
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#updateModal" wire:click="edit({{ $data->id }})"><i
                                                class="fa fa-edit"></i> Edit</button>
                                        <button wire:click="confirmDelete('{{ $data->id }}')"
                                            class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>
                                            Delete</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
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

    <!-- Add Modal -->
    <div wire:ignore.self class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Tag Artikel </h5>
                    <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group mb-3">
                            <label class="form-label">Nama Tag</label>
                            <input type="text" class="form-control" placeholder="Masukan Nama Tag Artikel"
                                wire:model.defer="nama_tag">
                            @error('nama_tag')
                                <small class="text-danger error">{{ $message }}</small>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning close-btn" data-dismiss="modal"><i
                            class="fa fa-times"></i>
                        Tutup</button>
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
                    <h5 class="modal-title">Edit Tag Artikel</h5>
                    <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group mb-3">
                            <input type="hidden" wire:model.defer="tagId">
                            <label class="form-label">Nama Tag</label>
                            <input type="text" class="form-control" wire:model.defer="nama_tag"
                                placeholder="Masukan Nama Tag Artikel" value="{{ $nama_tag }}">
                            @error('nama_tag')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click.prevent="cancel()" class="btn btn-warning" data-dismiss="modal"><i
                            class="fa fa-times"></i> Tutup</button>
                    <button type="button" wire:click.prevent="update()" class="btn btn-primary" data-dismiss="modal"><i
                            class="fa fa-save"></i> Simpan</button>
                </div>
            </div>
        </div>
    </div>

</div>
