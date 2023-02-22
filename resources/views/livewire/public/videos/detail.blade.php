<?php

use Carbon\Carbon;
use Illuminate\Support\Str;

?>
@push('pageName')
    {{ $data->title }} |
@endpush
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
                            <div class="col-xl-12">
                              <div class="vs-box">
                                <iframe style="width: 100%;" height="450px;"
                                    src="https://www.youtube.com/embed/{{ $data->youtube_id }}">
                                </iframe>
                                <h5 class="pl-3">{{ $data->title }}</h5>

                              </div>
                              <!-- /.post-content -->

                            </div>
                        </div>
                    </div>
                </div>
                <livewire:public.component.link />
            </div>
            <livewire:public.component.sidebar />
        </div>
    </div>
</section>


