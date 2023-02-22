<div>
    @push('page_title')
    {{ 'Kostumisasi Website | Panel Admin' }}
    @endpush
    <div class="section-header">
        <h1>Kostumisasi Website</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Kostumisasi Website</div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form wire:submit.prevent="update">
                            @csrf
                            <input type="hidden" wire:model.defer="dataId">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Warna 1</label>
                                        <!-- <div class="input-group colorpickerinput"> -->
                                        <div class="input-group ">
                                            <input type="color" wire:model.defer="color1" class="form-control @error('color1') is-invalid @enderror" value="{{ $color1 }}">
                                            <div class="input-group-text">
                                                <i class="fas fa-fill-drip"></i>
                                            </div>
                                        </div>
                                        @error('color1')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Warna 1</label>
                                        <div class="input-group">
                                            <input type="color" wire:model.defer="color1active" class="form-control @error('color1active') is-invalid @enderror" value="{{ $color1active }}">
                                            <div class="input-group-text">
                                                <i class="fas fa-fill-drip"></i>
                                            </div>
                                        </div>
                                        @error('color1active')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Warna 2</label>
                                        <div class="input-group">
                                            <input type="color" wire:model.defer="color2" class="form-control @error('color2') is-invalid @enderror" value="{{ $color2 }}">
                                            <div class="input-group-text">
                                                <i class="fas fa-fill-drip"></i>
                                            </div>
                                        </div>
                                        @error('color2')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Warna 2</label>
                                        <div class="input-group">
                                            <input type="color" wire:model.defer="color2active" class="form-control @error('color2active') is-invalid @enderror" value="{{ $color2active }}">
                                            <div class="input-group-text">
                                                <i class="fas fa-fill-drip"></i>
                                            </div>
                                        </div>
                                        @error('color2active')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Hitam</label>
                                        <div class="input-group">
                                            <input type="color" wire:model.defer="black" class="form-control @error('black') is-invalid @enderror" value="{{ $black }}">
                                            <div class="input-group-text">
                                                <i class="fas fa-fill-drip"></i>
                                            </div>
                                        </div>
                                        @error('black')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Putih</label>
                                        <div class="input-group">
                                            <input type="color" wire:model.defer="white" class="form-control @error('white') is-invalid @enderror" value="{{ $white }}">
                                            <div class="input-group-text">
                                                <i class="fas fa-fill-drip"></i>
                                            </div>
                                        </div>
                                        @error('white')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Background</label>
                                        <div class="input-group">
                                            <input type="color" wire:model.defer="background_color" class="form-control @error('background_color') is-invalid @enderror" value="{{ $background_color }}">
                                            <div class="input-group-text">
                                                <i class="fas fa-fill-drip"></i>
                                            </div>
                                        </div>
                                        @error('background_color')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Font</label>
                                        <select wire:model.defer="font_style" class="form-control">
                                            <option value="{{ $font_style }}" hidden>{{ $font_style }}</option>
                                            <option value="Arial">Arial</option>
                                            <option value="Roboto">Roboto</option>
                                            <option value="Ubuntu">Ubuntu</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="text-right">
                                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-warning"><i class="fa fa-arrow-left"></i> Kembali</a>
                                    <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
    @endpush

    @push('script')
    @endpush

</div>
