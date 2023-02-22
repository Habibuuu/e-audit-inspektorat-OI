<?php

use Carbon\Carbon;

?>
<!--==============================
Latest News
==============================-->
<section class="latest-news-wrapper space-top space-md-bottom">
    <div class="container">
        <div class="row flex-row-reverse">
            <div class="col-lg-8">
                <div class="vs-box-style1 has-corner-border bg-secondary py-15 mb-10">
                    <div class="row">
                        <div class="col-xl-12 text-center">
                            <h2 class="sec-title-style1 mt-0 mb-2 mb-xl-0"><i class="far fa-image"></i> Galeri</h2>
                        </div>
                    </div>
                </div>

                <div class="tab-content">
                    <div class="tab-pane show active" id="politics" aria-labelledby="politics-tab">
                        <div class="row gutters-10 space-md-bottom justify-content">
                            @foreach ( $arrGallery as $data )
                            <div class="col-xl-4">
                                <div class="vs-blog image-scale-hover">
                                    <a href="{{ route('public.galleryDetail', $data->slug) }}" class="overlay gradient-black-md"></a>
                                    <div class="vs-blog-image">
                                        <a href="{{ route('public.galleryDetail', $data->slug) }}"><img style="height: 270px; width:270px; object-fit: cover;" src="{{ asset('/storage/gallery/'.$data->Thumbnail->image) }}" alt="Public Post Image" class="w-100"></a>
                                    </div>
                                    <div class="vs-blog-content overlay-bottom style-dark">
                                        <h3 class="blog-title h5 mb-1"><a href="{{ route('public.galleryDetail', $data->slug) }}">{{ $data->title }}</a></h3>
                                        <div class="blog-meta">
                                            <a href="#" class="text-xs"><i class="fal fa-calendar-alt"></i>{{ Carbon::parse($data->created_at)->isoFormat('dddd, DD MMMM YYYY') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <livewire:public.component.link />
            </div>
            <livewire:public.component.sidebar />
        </div>
    </div>
</section>
