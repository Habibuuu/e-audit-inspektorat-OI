<div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex flex-column flex-sm-row gap-2 justify-content-between mb-3">
                <h4 class="text-dark fw-bold">
                    <i class="fa fa-list"></i>
                    Daftar Kategori
                </h4>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal"
                    wire:click.prevent="cancel()">
                    <i class="fas fa-plus"></i>
                    Tambah Kategori
                </button>
            </div>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th width="250px" class="text-center">
                                <i class="fas fa-cog"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($datas as $data)
                            <tr>
                                <td>
                                    {{ $data->name }}
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
                                    <div class="alert alert-warning">
                                        Data tidak ditemukan.
                                    </div>
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

    <!-- Add Modal -->
    <div wire:ignore.self class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kategori Artikel </h5>
                    <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group mb-3">
                            <label class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control" placeholder="Masukan Nama Kategori Artikel"
                                wire:model.defer="nama_kategori">
                            @error('nama_kategori')
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
    <div wire:ignore.self class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Kategori Artikel</h5>
                    <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group mb-3">
                            <input type="hidden" wire:model.defer="categoryId">
                            <label class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control" wire:model.defer="nama_kategori"
                                placeholder="Masukan Nama Kategori Artikel" value="{{ $nama_kategori }}">
                            @error('nama_kategori')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click.prevent="cancel()" class="btn btn-warning"
                        data-dismiss="modal">
                        <i class="fa fa-times"></i> Tutup
                    </button>
                    <button type="button" wire:click.prevent="update()" class="btn btn-primary">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>
