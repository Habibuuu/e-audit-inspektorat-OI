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
                            <h2 class="sec-title-style1 mt-0 mb-2 mb-xl-0"><i class="far fa-video"></i> Videos</h2>
                        </div>
                    </div>
                </div>

                <div class="tab-content">
                    <div class="tab-pane show active" id="politics" aria-labelledby="politics-tab">
                        <div class="row gutters-10 space-md-bottom justify-content">
                            @foreach ( $arrVideos as $videos )
                            <div class="col-md-6 pb-3">
                                <div class="card gallery">
                                    <a href="https://i.ytimg.com/vi/{{ $videos->youtube_id }}/hq720.jpg" class="gallery-item card-img-top" data-sub-html='<h6 class="fs-sm text-light">{{ $videos->title }}</h6>'>
                                    <img src="https://i.ytimg.com/vi/{{ $videos->youtube_id }}/hq720.jpg" alt="Gallery thumbnail">
                                    </a>
                                    <div class="card-body">
                                    <h5 class="card-title">{{ $videos->title }}</h5>
                                    <a href="{{ route('public.videosDetail', $videos->slug) }}" class="btn btn-sm btn-danger w-100">Lihat Video</a>
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
