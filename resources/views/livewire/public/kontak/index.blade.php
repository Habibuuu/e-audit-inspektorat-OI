
<?php

use Carbon\Carbon;
use App\Models\Settings\WebsIdentity;

$identitas = WebsIdentity::find(1);

?>
    <!--==============================
    Breadcumb
    ============================== -->
    <div class="breadcumb-wrapper breadcumb-layout1 background-image py-85" data-bg-src="{{ asset('/storage/images/senai.png') }}" data-overlay="title" data-opacity="4">
        <div class="container z-index-common">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-left mb-1 mb-md-0">
                    <h1 class="breadcumb-title h4 text-medium text-white my-0">Kontak Kami</h1>
                </div>
                <div class="col-md-6 text-right">
                    <ul class="breadcumb-menu-style1 style-dark">
                        <li><a href="{{ route('public.index') }}"><i class="fas fa-home"></i>Home</a></li>
                        <li class="active">Kontak Kami</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--==============================
    Contact Form
    ==============================-->
    <section class="vs-contact-wrapper bg-smoke space-top space-md-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-4 align-self-end">
                    <div class="info-box1 bg-white px-50 py-50 mb-30">
                        <h2 class="h4 text-medium mb-2 mt-xl-n2">Profile Website</h2>
                        <img src="{{ asset('images/' . $identitas->logo) }}" alt="">
                        <p>{{ $identitas->name }}</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-8 align-self-end">
                    <div class="info-box1 bg-white px-50 py-50 mb-30">
                        <h2 class="h4 text-medium mb-2 mt-xl-n2">Hubungi Kami</h2>
                        <p class="has-icon-left"><i class="fas fa-map-marker-alt"></i>{{ $identitas->address }}</p>
                        <p class="has-icon-left"><i class="fas fa-phone-alt"></i>{{ $identitas->telephone }}</p>
                        <p class="has-icon-left"><i class="fas fa-envelope"></i>{{ $identitas->email }}</p>
                        <ul class="social-links links-btn-style">
                            <li><a target="_blank" href="{{ $identitas->facebook }}"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a target="_blank" href="{{ $identitas->twitter }}"><i class="fab fa-twitter"></i></a></li>
                            <li><a target="_blank" href="{{ $identitas->youtube }}"><i class="fab fa-youtube"></i></a></li>
                            <li><a target="_blank" href="{{ $identitas->instagram }}"><i class="fab fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-12 col-lg-12">
                    {!! $identitas->googlemap !!}
                </div>

            </div>
        </div>
    </section>
