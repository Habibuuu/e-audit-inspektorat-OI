<?php

use Carbon\Carbon;
use Illuminate\Support\Str;

?>
<div>

    <div class="container">
        <div class="row text-center justify-content-center pb-5">
            <div class="col-12 mx-md-auto">
                <div class="overflow-hidden mb-3">
                    <h1 class="word-rotator slide font-weight-bold text-8 mb-0 appear-animation"
                        data-appear-animation="maskUp">
                        <span class="word-rotator-words bg-primary text-center">
                            <b class="is-visible">Musabaqah Tilawatil Qur'an</b>
                            <b>Tingkat Kabupaten Ogan Ilir</b>
                            <b>Tahun 2022</b>
                            <b>Livescore</b>
                        </span>
                    </h1>
                </div>
            </div>
        </div>
        <div class="lightbox"
            data-plugin-options="{'delegate': 'a', 'type': 'image', 'gallery': {'enabled': true}, 'mainClass': 'mfp-with-zoom', 'zoom': {'enabled': true, 'duration': 300}}">
            <div class="row mx-0">
                <div class="col-12 p-0">
                    <a href="{{ asset('storage/infographics/original/' . $mtqToday->filename) }}">
                        <span class="thumb-info thumb-info-no-borders thumb-info-centered-icons">
                            <span class="thumb-info-wrapper">
                                <img src="{{ asset('storage/infographics/original/' . $mtqToday->filename) }}" class="img-fluid"  id="mtqtoday" />
                                <span class="thumb-info-action">
                                    <span class="thumb-info-action-icon thumb-info-action-icon-light"><i
                                            class="fas fa-plus text-dark"></i></span>
                                </span>
                            </span>
                        </span>
                    </a>
                </div>
            </div>
        </div>
        {{-- <img src="{{ asset('storage/infographics/original/' . $mtqToday->filename) }}" id="mtqtoday"> --}}
    </div>

    <section class="page-header page-header-classic page-header-md">
        <div class="container" wire:ignore>
            <div class="row">
                <div class="col-md-8 order-2 order-md-1 align-self-center p-static">
                    <h1 data-title-border>Artikel Terbaru MTQ Kabupaten Ogan Ilir 2022</h1>
                </div>
                <div class="col-md-4 order-1 order-md-2 align-self-center">
                    <ul class="breadcrumb d-block text-md-end">
                        <li><a href="{{ route('public.index') }}">Beranda</a></li>
                        <li class="active">MTQ Kab Ogan Ilir 2022</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <div class="container pb-1" style="min-height: 50vh">

        <div class="blog-posts">

            <div class="masonry-loader masonry-loader-showing">
                <div class="masonry row" data-plugin-masonry data-plugin-options="{'itemSelector': '.masonry-item'}">

                    @foreach ($arrBerita as $berita)
                        <div class="masonry-item no-default-style col-sm-12 col-md-6 col-lg-4">
                            <article class="post post-medium border-0 pb-0 mb-5">
                                <div class="post-image">
                                    <a href="{{ route('public.articleDetail', $berita->slug) }}">
                                        <img src="{{ asset('storage/images/thumbnail/small/' . $berita->thumbnail) }}"
                                            class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" alt="" />
                                    </a>
                                </div>

                                <div class="post-content">

                                    <h2 class="font-weight-semibold text-5 line-height-6 mt-3 mb-2">
                                        <a href="{{ route('public.articleDetail', $berita->slug) }}">
                                            {{ $berita->title }}
                                        </a>
                                    </h2>
                                    <p class="m-0 p-0">
                                        <i class="fa fa-calendar-alt"></i>
                                        &nbsp;
                                        {{ Carbon::parse($berita->created_at)->isoFormat('dddd, DD MMMM YYYY') }}
                                    </p>

                                    {{ Str::words(strip_tags($berita->content), 20, '...') }}

                                    <div class="post-meta">
                                        <span>
                                            <i class="far fa-user"></i>
                                            By <a href="#">{{ $berita->Author->fullname }}</a>
                                        </span>
                                        @if ($berita->Category)
                                            <span>
                                                <i class="far fa-folder"></i>
                                                <a href="#">{{ $berita->Category->name ?? '' }}</a>,
                                            </span>
                                        @endif
                                        <span>
                                            <i class="fa fa-tag"></i>
                                            @foreach ($berita->getTags as $tag)
                                                <a href="#">{{ $tag->name }}</a>
                                                @if (!$loop->last)
                                                    ,
                                                @endif
                                            @endforeach
                                        </span>
                                        <span class="d-block mt-2">
                                            <a href="{{ route('public.articleDetail', $berita->slug) }}"
                                                class="btn btn-sm btn-light text-1 text-uppercase">
                                                <i class="fas fa-angle-double-right"></i>
                                                Selengkapnya..
                                            </a>
                                        </span>
                                    </div>

                                </div>
                            </article>
                        </div>
                    @endforeach

                </div>
            </div>

            @if ($loadMoreButton == true)
                <div class="d-flex justify-content-center">
                    <button class="btn btn-sm btn-primary" id="loadMore">
                        Load More
                    </button>
                </div>
            @endif


        </div>
    </div>

    @push('styles')
        <style>
            #mtqtoday {
                width: 100%;
            }

        </style>
    @endpush

    @push('script')
        <script type="text/javascript">
            // window.onscroll = function(ev) {
            //     if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
            //         window.livewire.emit('load-more');
            //     }
            // };
            $("#loadMore").on('click', function(e) {
                e.preventDefault();
                @this.emit('load-more');
            })
        </script>
    @endpush
</div>
