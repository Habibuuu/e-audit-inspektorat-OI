<div>

    <form wire:submit.prevent="loginAttemp()">
        <div class="login-box">
            <div class="login-form">
                <a href="{{ route('admin.dashboard') }}" class="login-logo">
                    <img src="{{ asset('images/favicon-ori.png') }}" alt="Panel Admin" />
                </a>
                <div class="login-welcome">
                    Welcome back, <br />Please login to Panel Admin.
                </div>
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" placeholder="Username"
                        class="form-control @error('username') is-invalid @enderror" wire:model.lazy="username"
                        autocomplete="new-username" />
                    @error('username')
                        <small class="invalid-feedback d-block margin-bottom">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="input-group" x-data="{ showPassword: false }">
                        <input x-bind:type="showPassword ? 'text' : 'password'"
                            class="form-control margin-bottom @error('password') is-invalid @enderror"
                            wire:model.defer="password" placeholder="Password" autocomplete="new-password">
                        <span class=" input-group-addon bg-default w-auto" style="padding:11px; cursor: pointer;"
                            x-on:click="showPassword = ! showPassword">
                            <i class="fa" x-bind:class="[showPassword ? 'fa-eye' : 'fa-eye-slash']"
                                aria-hidden="true"></i>
                        </span>
                    </div>
                    @error('password')
                        <small class="invalid-feedback d-block margin-bottom">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="mb-3">
                    <div class="d-flex flex-column justify-content-center gap-2">
                        <div class="captcha mb-3" style="position: relative">
                            <div class="text-center">{!! $captchaImg !!}</div>
                            <div>
                                <button type="button" class="btn btn-icon text-danger" id="reload"
                                    wire:click.prevent="reloadCaptcha()"
                                    style="position: absolute;bottom:25%; top:25%; right:0">
                                    <i class="fa fa-undo"></i>
                                </button>
                            </div>
                        </div>

                        <input id="captcha" type="text" class="form-control margin-bottom "
                            placeholder="Masukkan Captcha" wire:model.defer="captcha">
                        @error('captcha')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="login-form-footer d-flex justify-content-center">
                    <button type="submit" class="btn">
                        <span class="icon">
                            <i class="bi bi-arrow-right-circle"></i>
                        </span>
                        Login
                    </button>
                </div>
            </div>
        </div>
    </form>

</div>
