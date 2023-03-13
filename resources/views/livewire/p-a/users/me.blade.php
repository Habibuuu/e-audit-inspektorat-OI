<div>
    <div class="card">
        <div class="card-body">
            <div class="row g-2">
                <div class="col-md-4">
                    <div class="position-relative">
                        <label class="form-label" style="display: flex; justify-content: center;">Photo Profile</label>
                        <div class="position-relative d-flex justify-content-center">
                            <div wire:loading wire:target="photo" class="position-absolute w-100 h-100 top-0 left-0"
                                style="width:300px; height:300px;">
                                <div class="loading d-flex w-100 h-100 justify-content-center align-items-center gap-2 rounded text-light"
                                    style=" background:rgba(0,0,0,.9)">
                                    <div class="spinner-border text-light" style="width:20px; height:20px;"
                                        role="status">
                                    </div>
                                    Uploading
                                </div>
                            </div>
                            <input type="file" wire:model="photo"
                                class="position-absolute w-100 h-100 top-0 left-0"
                                style="cursor: pointer; opacity:0;" title="Ganti Photo Profile" />
                            @if ($photo)
                                <img class="img img-thumbnail" style="width:300px; height:300px;object-fit:contain;"
                                    src="{{ $photo->temporaryUrl() }}">
                            @else
                                <img class="img img-thumbnail" style="width:300px; height:300px;object-fit:contain;"
                                    src="{{ asset('storage/images/users/' . auth()->user()->photo) }}">
                            @endif
                        </div>
                        @error('photo')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror

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
