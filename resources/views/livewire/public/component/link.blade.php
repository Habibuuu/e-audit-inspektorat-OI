@php
use App\Models\Link;

$arrLink = Link::where('status', 'Publish')
    ->orderBy('id', 'ASC')
    ->get();

@endphp

<section class="vs-blog-details blog-details-layout1">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="vs-blog">
                    <div class="vs-blog-content">
                        <div class="vs-box">
                            <div class="vs-box-style1 has-corner-border bg-secondary py-15 mb-10">
                                <div class="row">
                                    <div class="col-xl-12 text-center">
                                        <h2 class="sec-title-style1 mt-0 mb-2 mb-xl-0"><i class="fas fa-browser"></i> Link Terkait</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="row vs-carousel" data-slidetoshow="5" data-lgslidetoshow="4" data-mdslidetoshow="3" data-smslidetoshow="2" data-xsslidetoshow="1">
                                @foreach ($arrLink as $link)
                                <a target="_blank" href="{{ $link->url }}">
                                    <div class="col-xl-12"><img src="{{ asset('storage/link/original/' . $link->filename) }}" class="w-100" alt="Slide Thumb Image"></div>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
