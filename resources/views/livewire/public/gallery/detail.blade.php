<?php

use Carbon\Carbon;
use Illuminate\Support\Str;

?>
@push('pageName')
{{ $data->title }} |
@endpush
<div>
    <div class="bg-primary py-4">
        <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
            <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-start">
                        <li class="breadcrumb-item"><a class="text-nowrap" href="{{ route('public.index') }}"><i
                                    class="ci-home"></i>Home</a></li>
                        <li class="breadcrumb-item text-nowrap"><a href="#">Gallery</a>
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
                <h1 class="h3 mb-0">{{ $data->title }}</h1>
            </div>
        </div>
    </div>
    <div class="container pb-5 mb-2 mb-md-4">
        <!-- Featured posts carousel-->
        <div class="row pt-5 mt-md-2">
          <!-- Entries grid-->
          <aside class="col-lg-8">
            <!-- Gallery grid no gutters -->
                <div class="row gallery g-0">

                    <!-- Item -->
                    @foreach ($data->Photos as $data)
                    <div class="col-xl-4 col-sm-6">
                        <a href="{{ asset('/storage/gallery/'.$data->image) }}" style="object-fit: cover; height: 300px;" class="gallery-item"
                            data-sub-html='<h6 class="fs-sm text-light">{{ $data->title }}</h6>'>
                            <img src="{{ asset('/storage/gallery/'.$data->image) }}" alt="Gallery thumbnail">
                            <span class="gallery-item-caption">{{ $data->title }}</span>
                        </a>
                    </div>
                    @endforeach

                    <!-- Add as many columns with gallery item inside as you need -->
                </div>
          </aside>
          <aside class="col-lg-4">
            <!-- Sidebar-->
            <livewire:public.component.sidebar/>
          </aside>
        </div>
    </div>
</div>
<section class="link-terkait">
    <div class="container bg-light">

        <div class="row g-5 p-4 my-4">
            <livewire:public.component.link />
        </div>

    </div>
</section>


