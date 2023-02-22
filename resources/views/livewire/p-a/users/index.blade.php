<div>

    <div class="card">
        <div class="card-body">

            <div class="d-flex flex-column flex-sm-row align-items-center justify-content-between mb-3">
                <div>
                    <h4 class="fw-bold text-dark">
                        <i class="fa fa-list"></i>
                        Daftar Pengguna
                    </h4>
                </div>
                <div>
                    <button class="btn btn-primary" type="button" data-bs-target="#modalUser" data-bs-toggle="modal"
                        wire:click.prevent="resetInput()">
                        <i class="fas fa-plus"></i>
                        Tambah User
                    </button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th width="150" class="text-center">Status Akun</th>
                            <th width="250" class="text-center">
                                <i class="fas fa-cog"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $data)
                            <tr>
                                <td>
                                    <h5>
                                        {{ $data->fullname }}
                                    </h5>
                                </td>
                                <td>{{ $data->email }}</td>
                                <td>{{ $data->Role->name }}</td>
                                <td class="text-center">
                                    <div class="btn btn-rounded btn-{{ $data->account_status == 'active' ? 'success' : 'danger' }}"
                                        style="cursor:pointer">
                                        {{ $data->account_status == 'active' ? 'Aktif' : 'Non-Aktif' }}
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center w-100 gap-2">
                                        <button class="btn btn-sm btn-info" type="button" data-bs-target="#modalUser"
                                            data-bs-toggle="modal"
                                            wire:click.prevent="getPengguna('{{ $data->id }}')">
                                            <i class="fa fa-paste"></i>
                                            Edit
                                        </button>
                                        <a href="#" wire:click="confirmDelete('{{ $data->id }}')"
                                            class="btn btn-sm btn-danger">
                                            <i class="fa fa-trash"></i>
                                            Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="50">
                                {{ $datas->links() }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>
    </div>

    <!--Modal-->
    <div wire:ignore.self tabindex="-1" class="modal fade" id="modalUser" role="dialog" aria-hidden="true"
        aria-labelledby="modalUserLabel" style="display: none;">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalUserLabel">
                        {{ $updateMode == false ? 'Tambah' : 'Edit' }}
                        Pengguna
                    </h5>
                    <button class="btn" aria-label="Close" type="button" data-bs-dismiss="modal">
                        <span aria-hidden="true">
                            <i class="fas fa-times"></i>
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="row p-3 p-md-0 g-2"
                        @if ($updateMode == false) wire:submit.prevent="store()" @elseif($updateMode == true) wire:submit.prevent="update()" @endif>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label" for="fullname">Nama Lengkap</label>
                                <input type="text" class="form-control" id="fullname"
                                    wire:model.defer="pengguna.fullname" placeholder="Nama Lengkap">
                                @error('pengguna.fullname')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label" for="username">Username</label>
                                <input type="text" class="form-control" id="username"
                                    wire:model.defer="pengguna.username" placeholder="Username">
                                @error('pengguna.username')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" class="form-control" id="email"
                                    wire:model.defer="pengguna.email" placeholder="Email">
                                @error('pengguna.email')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label" for="role">Role</label>
                                <select class="form-control" id="role" wire:model.defer="pengguna.role_id">
                                    <option value="" hidden>Pilih Role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('pengguna.role_id')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label" for="password">Password</label>
                                <input type="password" class="form-control" id="password"
                                    wire:model.defer="pengguna.password" placeholder="Password">
                                @error('pengguna.password')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    wire:model.defer="pengguna.password_confirmation"
                                    placeholder="Konfirmasi Password">
                                @error('pengguna.password_confirmation')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 text-end">
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">
                                <i class="fas fa-times"></i>
                                Tutup
                            </button>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i>
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
