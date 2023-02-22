<?php

use Carbon\Carbon;
use Illuminate\Support\Str;

?>
@push('pageName')
    {{ $data->title }} |
@endpush
<!--==============================
        Blog Area
==============================-->
<section class="vs-blog-details blog-details-layout1 space-top space-md-bottom">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="meta-box d-flex flex-wrap align-items-center">
                    <a href="post.html" class="post-author mr-20 mb-15">
                        <img src="{{ asset('images/favicon-ori.png') }}" alt="Post Author" class="avatar rounded-circle" height="105" width="105">
                        <span> {{ $data->Author->fullname }}</span>
                    </a>
                    <div class="blog-meta mr-20 mb-15">
                        <a href="#"><i class="fal fa-calendar-alt"></i> {{ Carbon::parse($data->created_at)->isoFormat('dddd, DD MMMM YYYY') }}</a>
                    </div>
                    <div class="blog-meta mr-20 mb-15">
                        <a href="#"><i class="fal fa-eye"></i> {{ $data->view }}</a>
                    </div>
                    <div class="blog-category mb-15">
                        <a href="#">Halaman</a>
                    </div>
                </div>
                <h2 class="blog-title h1">{{ $data->title }}</h2>
                {{-- <div class="vs-blog-image mb-30">
                    <img src="{{ asset('storage/images/thumbnail/original/' . $data->thumbnail) }}" alt="Blog image" style="height: 550px; object-fit:cover;" class="w-100">
                </div> --}}
            </div>
            <div class="col-lg-8">
                <div class="vs-blog">
                    <div class="vs-blog-content">
                        <p>{!! $data->content !!}</p>
                    </div>
                    <div class="share-links border-top  clearfix py-20 mt-25">
                        <div class="row align-items-xl-center">
                            <div class="col-md-6  text-left mt-20 mt-md-0 text-md-right">
                                <ul class="social-links links-btn-style">
                                    <li><a class="facebook" href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a class="twitter" href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a class="linkedin" href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                    <li><a class="instagram" href="#"><i class="fab fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="vs-comment-form comment-form-layout1 space-md-top mt-lg-n2">
                        <div class="form-title">
                            <h3 class="h3 mb-0 text-medium">Leave a Comment</h3>
                            <p class="mb-20">Your email address will not be published. Required fields are marked *</p>
                        </div>
                        <div class="row gutters-15">
                            <div class="col-12 form-group">
                                <textarea placeholder="Write a Message" class="form-control"></textarea>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="text" placeholder="Your Name" class="form-control">
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="text" placeholder="Your Email" class="form-control">
                            </div>
                            <div class="col-12 form-group pt-xl-20 mb-0">
                                <button class="vs-btn">Send</button>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
            <livewire:public.component.sidebar />
        </div>
    </div>
</section>

<livewire:public.component.link />
