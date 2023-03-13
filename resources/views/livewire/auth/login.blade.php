@php
use Carbon\Carbon;
use App\Models\Settings\WebsIdentity;

    $identitas = WebsIdentity::find(1);
@endphp
<div>

    <div class="row">
        <div class="col-lg-5 d-none d-lg-block bg-login rounded-left"></div>
        <div class="col-lg-7">
            <div class="p-5">
                <div class="text-center mb-5">
                    <a href="{{ route('admin.dashboard') }}">
                        <img style="height: 100px;" src="{{ asset('images/' . $identitas->logo) }}" alt="Panel Admin" />
                    </a>
                </div>
                <h1 class="h5 mb-1">Selamat Datang!</h1>
                <p class="text-muted mb-4">Masukan username dan password anda untuk mengakses dashboard aplikasi</p>
                <form class="user" wire:submit.prevent="loginAttemp()">
                    <div class="form-group">
                        <input type="text" placeholder="Username"
                            class="form-control @error('username') is-invalid @enderror" wire:model.lazy="username"
                            autocomplete="new-username" />
                        @error('username')
                            <small class="invalid-feedback d-block margin-bottom">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="input-group" id="show_hide_password">
                            <input class="form-control @error('username') is-invalid @enderror" wire:model.lazy="password" type="password">
                            <div class="input-group-text">
                              <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                            </div>
                          </div>
                          @error('password')
                              <small class="invalid-feedback d-block margin-bottom">
                                  {{ $message }}
                              </small>
                          @enderror
                    </div>
                    <div class="form-group">
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
                    <button type="submit" class="btn btn-success btn-block waves-effect waves-light">
                        <span class="icon">
                            <i class="bi bi-arrow-right-circle"></i>
                        </span>
                        Login
                    </button>
                </form>
                <!-- end row -->
            </div> <!-- end .padding-5 -->
        </div> <!-- end col -->
    </div> <!-- end row -->

</div>

@push('script')
    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if($('#show_hide_password input').attr("type") == "text"){
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass( "fa-eye-slash" );
                    $('#show_hide_password i').removeClass( "fa-eye" );
                }else if($('#show_hide_password input').attr("type") == "password"){
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass( "fa-eye-slash" );
                    $('#show_hide_password i').addClass( "fa-eye" );
                }
            });
        });
    </script>
@endpush
