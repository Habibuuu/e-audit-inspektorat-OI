<div>

    <section class="page-header page-header-classic page-header-md">
        <div class="container" wire:ignore>
            <div class="row">
                <div class="col-md-8 order-2 order-md-1 align-self-center p-static">
                    <h1 data-title-border>Layanan Kami</h1>
                </div>
                <div class="col-md-4 order-1 order-md-2 align-self-center">
                    <ul class="breadcrumb d-block text-md-end">
                        <li><a href="{{ route('public.index') }}">Beranda</a></li>
                        <li class="active">Layanan</li>
                    </ul>


                    <div class="d-flex flex-column flex-md-row justify-content-end">
                        <div class="form-group mx-1 mb-2">
                            <label>Filter</label>
                            <input type="text" class="form-control" style="min-width: 250px; width:100%"
                                placeholder="Masukkan Judul" wire:model="searchName">
                        </div>
                        <div class="form-group mx-1 mb-2">
                            <label></label>
                            <select class="form-control" wire:model="searchCategory"
                                style="min-width: 250px; width:100%">
                                <option hidden>Pilih Berdasarkan Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                                <option value="">Semua</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container pb-1" style="min-height: 50vh">

        <div class="row py-4">
            <div class="featured-boxes featured-boxes-style-2">
                <div class="row">

                    @foreach ($datas as $data)
                        <div class="col-md-4">
                            <div class="featured-box featured-box-effect-4">
                                {{-- <a href="{{ $data->url }}" style="text-decoration:none;"> --}}
                                <a href="{{ route('public.layanan-category', $data->slug) }}"
                                    style="text-decoration:none;">
                                    <div class="box-content">
                                        <i class="icon-featured fas {{ $data->icon }} icons bg-color-grey border border-gray"
                                            style="color: {{ $data->color }}"></i>
                                        <h4 class="font-weight-bold">{{ $data->name }}</h4>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
