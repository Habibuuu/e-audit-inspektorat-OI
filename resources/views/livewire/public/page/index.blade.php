<?php

use Carbon\Carbon;
use Illuminate\Support\Str;

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
                            <h2 class="sec-title-style1 mt-0 mb-2 mb-xl-0"><i class="far fa-newspaper"></i> Halaman</h2>
                        </div>
                    </div>
                </div>

                <div class="tab-content">
                    <div class="tab-pane show active" id="politics" aria-labelledby="politics-tab">
                        <div class="row gutters-10 space-md-bottom justify-content-left">
                            @foreach ($arrPages as $data)
                            <div class="col-sm-6 col-md-4 col-xl-3">
                                <div class="vs-blog mb-25">
                                    <div class="vs-blog-image mb-15 image-scale-hover" style="height: 120px; width: 150px; object-fit: cover;">
                                        <a href="{{ route('public.page-detail', $data->slug) }}"><img src="{{ asset('storage/images/thumbnail/small/' . $data->thumbnail) }}" alt="Featured Image" class="w-100"></a>
                                    </div>
                                    <div class="vs-blog-content">
                                        <h3 class="blog-title text-medium h5 mb-1"><a href="{{ route('public.page-detail', $data->slug) }}">{{ $data->title }}</a></h3>
                                        <div class="blog-meta text-xs">
                                            <a href="#"><i class="fal fa-calendar-alt"></i>&nbsp;{{ Carbon::parse($data->created_at)->isoFormat('dddd, DD MMMM YYYY') }}</a>
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
