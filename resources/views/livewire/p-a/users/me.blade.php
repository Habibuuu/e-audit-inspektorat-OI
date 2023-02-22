<div>
    <div class="card">
        <div class="card-body">
            <div class="row g-2">
                <div class="col-md-4">
                    <div class="position-relative">
                        <img src="{{ asset('storage/images/users/' . $user->photo) }}" class="img img-thumbnail w-100"
                            style="max-height:350px; object-fit:contain">
                        <input type="file" wire:model="photo" class="position-absolute w-100 h-100 start-0 top-0"
                            title="Ganti Photo Profil" style="opacity: 0; cursor:pointer">

                        <div wire:loading wire:target="photo">
                            <div
                                class="position-absolute w-100 h-100 start-0 top-0 p-2 rounded bg-dark d-flex align-items-center justify-content-center gap-2">
                                <div class="spinner-grow text-light" role="status"></div>
                                <h3 class="text-light fw-bold m-0">Uploading...</h3>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-8">

                    <form wire:submit.prevent="update()" class="row gy-3 gx-2">

                        <div class="form-group col-md-12">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" wire:model.defer="user.fullname"
                                placeholder="Nama Lengkap" autocomplete="off">
                            @error('user.fullname')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" wire:model.defer="user.username"
                                placeholder="Username" autocomplete="off">
                            @error('user.username')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" wire:model.defer="user.email" placeholder="Email"
                                autocomplete="off">
                            @error('user.email')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <hr>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" wire:model.defer="password"
                                placeholder="Password" autocomplete="off">
                            @error('password')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control" wire:model.defer="password_confirmation"
                                placeholder="Konfirmasi Password" autocomplete="off">
                            @error('password_confirmation')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group col-md-12 text-end">
                            <button type="submit" class="btn btn-outline-primary">
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
