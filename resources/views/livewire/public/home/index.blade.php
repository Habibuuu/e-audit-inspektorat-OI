<?php

use Carbon\Carbon;
use App\Models\Settings\WebsIdentity;

$identitas = WebsIdentity::find(1);
?>
<div>
    @push('pageTitle')
    Home
    @endpush

    <!-- Start  Page hero-->
    <section class="d-flex align-items-center page-hero " id="page-hero">
        <div class="overlay-shape-image-bg"></div>
        <div class="overlay-color "></div>
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-12   mx-auto col-lg-6 ">
                    <!--Start of .hero-text-area-->
                    <div class="hero-text-area mb-5  mb-lg-0 wow  fadeInLeft " data-wow-delay="0.4s">
                        <h1 class="hero-title " data-splitting>
                            e-Audit
                            <span class="heading-brand-name"> adalah </span>
                        </h1>
                        <p class="hero-subtitle" data-splitting>Aplikasi pengumpulan serta pengevaluasian bukti-bukti atas
                            informasi untuk menentukan serta melaporkan tingkat kesesuaian informasi tersebut dengan
                            kriteria-kriteria yang telah ditetapkan
                            Proses pengumpulan bukti/dokumen, serta evalusai buktinya dilakukan dengan bantuan komputer.
                        </p>
                        <div class="cta-links-area"><a class=" ma-btn-primary cta-link cta-link-primary  wow  fadeInUp "
                                href="{{ route('admin.login') }}" data-wow-delay="0.7s">Login</a>
                            <a class=" ma-btn-primary cta-link  wow  fadeInUp " href="#0" data-wow-delay="0.8s">Kontak
                                Kami
                            </a>
                        </div>
                    </div>
                </div>
                <!--End of .hero-text-area-->
                <!--Start of hero-image-->
                <div class="col-12   mx-md-auto col-lg-6 text-center">
                    <div class="hero-image-area  wow fadeInRight " data-wow-delay="0.4s">
                        <div class="hero-img-wraper  d-inline-block ">
                            <div class="hero-image-parts"><img class="illustration-part part-1 wow fadeInRight"
                                    src="assets_public/assets/images/hero/hero-illustration-1-parts/part-1.png"
                                    alt="img part" data-wow-delay="0s" draggable="false"><img
                                    class="illustration-part part-2 wow fadeInLeft"
                                    src="assets_public/assets/images/hero/hero-illustration-1-parts/part-2.png"
                                    alt="img part" data-wow-delay=".6s" draggable="false"><img
                                    class="illustration-part part-3 wow fadeInLeft"
                                    src="assets_public/assets/images/hero/hero-illustration-1-parts/part-3.png"
                                    alt="img part" data-wow-delay=".9s" draggable="false"><img
                                    class="illustration-part part-4 wow fadeInLeft"
                                    src="assets_public/assets/images/hero/hero-illustration-1-parts/part-4.png"
                                    alt="img part" data-wow-delay="1.2s" draggable="false"><img
                                    class="illustration-part part-5 wow fadeInLeft"
                                    src="assets_public/assets/images/hero/hero-illustration-1-parts/part-5.png"
                                    alt="img part" data-wow-delay="1.5s" draggable="false"></div>
                        </div>
                    </div>
                </div>
                <!--End of hero-image-->
            </div>
            <!--End Of .row -->
        </div>
        <!--End Of .container-->
        <div class="section-shape-divider-bottom fill-shade">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1920 250" preserveAspectRatio="none">
                <g transform="translate(0 280)">
                    <path
                        d="M1442.534,98.682c-265.574,25.019-554.112,16.544-830.8,19.755-161.831,1.884-362.453,1.861-495.05,35.506C64.243,167.249,26.643,191.243,0,214.582H1920V0C1796.678,48.528,1628.16,81.19,1442.534,98.682Z"
                        transform="translate(0 -244.927)" opacity="0.25"></path>
                    <path
                        d="M1395.845,114.97c-256.979,29.149-536.178,19.275-803.914,23.016C373.225,141.052,90.775,154.256,0,250H1857.857V0C1738.527,56.537,1575.463,94.591,1395.845,114.97Z"
                        transform="translate(62 -280)" opacity="0.25"></path>
                    <path
                        d="M1456.051,130.829c-248.646,22.25-518.7,14.71-777.773,17.567-211.506,2.334-484.752,12.391-572.558,85.468H1903V43.1C1787.56,86.24,1629.855,115.261,1456.051,130.829Z"
                        transform="translate(17.28 -263.864)"></path>
                    <path
                        d="M477.466,98.682c265.574,25.019,554.112,16.544,830.8,19.755,161.831,1.884,362.453,1.861,495.05,35.506,52.438,13.306,90.038,37.3,116.681,60.639H0V0C123.322,48.528,291.84,81.19,477.466,98.682Z"
                        transform="translate(0.28 -244.927)" opacity="0.25"></path>
                    <path
                        d="M462.012,114.97c256.979,29.149,536.178,19.275,803.913,23.016,218.707,3.066,501.157,16.27,591.932,112.014H0V0C119.33,56.537,282.394,94.591,462.012,114.97Z"
                        transform="translate(0.423 -280)" opacity="0.25"></path>
                    <path
                        d="M552.668,130.829c248.646,22.25,518.7,14.71,777.773,17.567,211.506,2.334,484.752,12.391,572.558,85.468H105.72V43.1C221.16,86.24,378.865,115.261,552.668,130.829Z"
                        transform="translate(-105.72 -263.864)"></path>
                </g>
            </svg>
        </div>
    </section>
    <!-- End  Page hero-->
    <!-- Start  Features Section-->
    <section class="features-boxed mega-section  section-bg-shade" id="features">
        <div class="container">
            <div class="section-heading center-heading">
                <h2 class="section-title wow" data-splitting="chars">Fitur Aplikasi e-Audit</h2>
                <p class="section-subtitle wow fadeInUp" data-wow-delay=".5s">Berikut merupakan fitur-fitur yang ada di
                    aplikasi e-Audit</p>
                <div class="line line-solid-main-color wow fadeIn" data-wow-delay="1s"></div>
            </div>
            <div class="row features-row">
                <!--Start First feature box-->
                <div class="col-12 col-md-6  col-lg-4 mx-auto">
                    <div class="feature-box  wow fadeInUp" data-wow-delay="0.2s">
                        <div class="feat-icon"><img class="img-icon" src="assets_public/assets/images/features/1.png"
                                alt="feature image 1" draggable="false"></div>
                        <div class="feat-content">
                            <h3 class="feat-title">Creative Solutions</h3>
                            <p class="feat-text">
                                Lorem ipsum dolor sit amet consecltetur adipisicing elit. Omnis tempore
                                perferendis
                                explicabo.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- End First feature box                    -->
                <!--Start Second feature box-->
                <div class="col-12 col-md-6  col-lg-4 mx-auto">
                    <div class="feature-box  wow fadeInUp" data-wow-delay="0.4s">
                        <div class="feat-icon"><img class="img-icon" src="assets_public/assets/images/features/2.png"
                                alt="feature image 2" draggable="false"></div>
                        <div class="feat-content">
                            <h3 class="feat-title">Solid Development</h3>
                            <p class="feat-text">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis tempore
                                perferendis
                                explicabo.

                            </p>
                        </div>
                    </div>
                </div>
                <!-- End Second feature box-->
                <!--Start Third feature box-->
                <div class="col-12 col-md-6  col-lg-4 mx-auto">
                    <div class="feature-box  wow fadeInUp" data-wow-delay="0.6s">
                        <div class="feat-icon"><img class="img-icon" src="assets_public/assets/images/features/3.png"
                                alt="feature image 3" draggable="false"></div>
                        <div class="feat-content">
                            <h3 class="feat-title">awesome Designs</h3>
                            <p class="feat-text">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis tempore
                                perferendis
                                explicabo.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- End Third feature box-->
                <!--Start fourth feature box-->
                <div class="col-12 col-md-6  col-lg-4 mx-auto">
                    <div class="feature-box  wow fadeInUp" data-wow-delay="0.2s">
                        <div class="feat-icon"><img class="img-icon" src="assets_public/assets/images/features/4.png"
                                alt="feature image 1" draggable="false"></div>
                        <div class="feat-content">
                            <h3 class="feat-title">Creative Solutions</h3>
                            <p class="feat-text">
                                Lorem ipsum dolor sit amet consecltetur adipisicing elit. Omnis tempore
                                perferendis
                                explicabo.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- End fourth feature box     -->
                <!--Start fifth feature box-->
                <div class="col-12 col-md-6  col-lg-4 mx-auto">
                    <div class="feature-box  wow fadeInUp" data-wow-delay="0.4s">
                        <div class="feat-icon"><img class="img-icon" src="assets_public/assets/images/features/5.png"
                                alt="feature image 2" draggable="false"></div>
                        <div class="feat-content">
                            <h3 class="feat-title">Solid Development</h3>
                            <p class="feat-text">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis tempore
                                perferendis
                                explicabo.

                            </p>
                        </div>
                    </div>
                </div>
                <!-- End fifth feature box-->
                <!--Start sixth feature box-->
                <div class="col-12 col-md-6  col-lg-4 mx-auto">
                    <div class="feature-box  wow fadeInUp" data-wow-delay="0.6s">
                        <div class="feat-icon"><img class="img-icon" src="assets_public/assets/images/features/6.png"
                                alt="feature image 3" draggable="false"></div>
                        <div class="feat-content">
                            <h3 class="feat-title">awesome Designs</h3>
                            <p class="feat-text">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis tempore
                                perferendis
                                explicabo.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- End sixth feature box-->
            </div>
            <!--Start .see-more-area-->
            <div class=" see-more-area wow fadeInUp" data-wow-delay="0.8s"><a class=" ma-btn-primary " href="#0">see all
                    features</a></div>
            <!--End Of .see-more-area -->
        </div>
    </section>
    <!-- End  Features Section-->
    <!-- Start  about Section-->
    <section class="about mega-section" id="about">
        <div class="container">
            <!-- Start Second about div-->
            <div class="content-block  ">
                <div class="row">
                    <div class="col-12 col-lg-6 d-flex align-items-center order-2   order-lg-0 about-col wow fadeInUp "
                        data-wow-delay="0.2s">
                        <div class="text-area "><span class="tag-line">our mision</span>
                            <h3 class=" about-title ">Tujuan Impelementasi e-Audit</h3>
                            <div class="info-items">
                                <div class="row no-gutters">
                                    <div class="col-12 ">
                                        <ul class="menu-items">
                                            <li class="info-item"><i class="far fa-chart-bar info-icon"></i>
                                                <div class="info-content">
                                                    <h5 class="info-title">Dapat memperoleh informasi kinerja Satker
                                                        secara cepat dan akurat</h5>
                                                    {{-- <p class="info-text">Lorem ipsum dolor sit amet consectetur
                                                        adipisicing elit. A omnis inventore quod maxime officiis.</p>
                                                    --}}
                                                </div>
                                            </li>
                                            <li class="info-item"><i class="far fa-paper-plane info-icon "></i>
                                                <div class="info-content">
                                                    <h5 class="info-title">Meminimalisir/efesiensi Anggaran Audit</h5>
                                                    {{-- <p class="info-text">Lorem ipsum dolor sit amet consectetur
                                                        adipisicing elit. Porro, repellat. Corporis eveniet dolores eos
                                                        architecto!</p> --}}
                                                </div>
                                            </li>
                                            <li class="info-item"><i class="far fa-clone info-icon "></i>
                                                <div class="info-content">
                                                    <h5 class="info-title">Akurasi data dan objektifitas hasil audit
                                                        kinerja lebih terjamin</h5>
                                                    {{-- <p class="info-text">Lorem ipsum dolor sit amet consectetur,
                                                        adipisicing elit. Reiciendis, ratione repellat architecto
                                                        consectetur. </p> --}}
                                                </div>
                                            </li>
                                            <li class="info-item"><i class="far fa-paper-plane info-icon "></i>
                                                <div class="info-content">
                                                    <h5 class="info-title">Akurasi data dan objektifitas hasil audit
                                                        kinerja lebih terjamin</h5>
                                                    {{-- <p class="info-text">Lorem ipsum dolor sit amet consectetur,
                                                        adipisicing elit. Reiciendis, ratione repellat architecto
                                                        consectetur. </p> --}}
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            {{-- <a class=" ma-btn-primary " href="#0">Learn more</a> --}}
                        </div>
                    </div>
                    <div class="col-12 col-lg-6   d-flex align-items-center about-col order-0 order-lg-2 wow fadeInUp"
                        data-wow-delay="0.4s">
                        <div class="img-area   ">
                            <div class="photo-banner-start"><i class="fas fa-chart-line  icon"></i>
                                <p class="banner-text">e-Audit.</p>
                            </div><img class="img-fluid about-img "
                                src="assets_public/assets/Images/about/about-2_photo.jpg" alt="Our vision">
                        </div>
                    </div>
                </div>
            </div>
            <!--End Second about div-->
        </div>
    </section>
    <!-- End  about Section-->
    <!-- Start  portfolio Section-->
    <section class="portfolio portfolio-squared-with-gaps mega-section  section-bg-shade  " id="portfolio">
        <div class="container">
            <div class="section-heading center-heading">
                <h2 class="section-title wow" data-splitting="chars">a portfolio of our work</h2>
                <p class="section-subtitle wow fadeInUp" data-wow-delay=".5s">Lorem ipsum dolor sit amet consectetur
                    adipisicing elit. Sunt, architecto cupiditate odio rerum est</p>
                <div class="line line-solid-main-color wow fadeIn" data-wow-delay="1s"></div>
            </div>
            <div class="portfolio-wraper  wow fadeInUp" data-wow-delay="0s">
                <!--a menu of links to show the photos users needs   -->
                <ul class="portfolio-btn-list ">
                    <li class="portfolio-btn active " data-filter="*">all</li>
                    <li class="portfolio-btn        " data-filter=".programming">programming</li>
                    <li class="portfolio-btn        " data-filter=".consulting">consulting</li>
                    <li class="portfolio-btn        " data-filter=".mobile">mobile app</li>
                    <li class="portfolio-btn        " data-filter=".blog">blog</li>
                </ul>
                <div class="portfolio-group ">
                    <div class="row no-gutters">
                        <div class="col-12  col-sm-6  col-lg-4  portfolio-item programming">
                            <div class="item"><a class="portfolio-img-link "
                                    href="assets_public/assets/Images/portfolio/1.jpg" data-fancybox=".filter">
                                    <div class="overlay overlay-color"></div><img class="portfolio-img  img-fluid "
                                        src="assets_public/assets/Images/portfolio/thumbs/1.jpg"
                                        alt="portfolio item photo"><i class="fas fa-search icon"></i>
                                </a>
                                <div class="item-info "><span class="info-title">programming </span>
                                    <ul class="tags-list">
                                        <li class="tag-item"> <a class="tag-link" href="#">c#</a></li>
                                        <li class="tag-item"> <a class="tag-link" href="#">Java </a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-12  col-sm-6  col-lg-4  portfolio-item blog">
                            <div class="item"><a class="portfolio-img-link "
                                    href="assets_public/assets/Images/portfolio/2.jpg" data-fancybox=".filter">
                                    <div class="overlay overlay-color"></div><img class="portfolio-img  img-fluid "
                                        src="assets_public/assets/Images/portfolio/thumbs/2.jpg"
                                        alt="portfolio item photo"><i class="fas fa-search icon"></i>
                                </a>
                                <div class="item-info "><span class="info-title">blog </span>
                                    <ul class="tags-list">
                                        <li class="tag-item"> <a class="tag-link" href="#">wordpress</a></li>
                                        <li class="tag-item"> <a class="tag-link" href="#">bloger </a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-12  col-sm-6  col-lg-4  portfolio-item programming">
                            <div class="item"><a class="portfolio-img-link "
                                    href="assets_public/assets/Images/portfolio/3.jpg" data-fancybox=".filter">
                                    <div class="overlay overlay-color"></div><img class="portfolio-img  img-fluid "
                                        src="assets_public/assets/Images/portfolio/thumbs/3.jpg"
                                        alt="portfolio item photo"><i class="fas fa-search icon"></i>
                                </a>
                                <div class="item-info "><span class="info-title">programming </span>
                                    <ul class="tags-list">
                                        <li class="tag-item"> <a class="tag-link" href="#">c++</a></li>
                                        <li class="tag-item"> <a class="tag-link" href="#">ruby </a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-12  col-sm-6  col-lg-4  portfolio-item consulting">
                            <div class="item"><a class="portfolio-img-link "
                                    href="assets_public/assets/Images/portfolio/4.jpg" data-fancybox=".filter">
                                    <div class="overlay overlay-color"></div><img class="portfolio-img  img-fluid "
                                        src="assets_public/assets/Images/portfolio/thumbs/4.jpg"
                                        alt="portfolio item photo"><i class="fas fa-search icon"></i>
                                </a>
                                <div class="item-info "><span class="info-title">consulting</span>
                                    <ul class="tags-list">
                                        <li class="tag-item"> <a class="tag-link" href="#">law</a></li>
                                        <li class="tag-item"> <a class="tag-link" href="#">finance</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-12  col-sm-6  col-lg-4  portfolio-item blog">
                            <div class="item"><a class="portfolio-img-link "
                                    href="assets_public/assets/Images/portfolio/5.jpg" data-fancybox=".filter">
                                    <div class="overlay overlay-color"></div><img class="portfolio-img  img-fluid "
                                        src="assets_public/assets/Images/portfolio/thumbs/5.jpg"
                                        alt="portfolio item photo"><i class="fas fa-search icon"></i>
                                </a>
                                <div class="item-info "><span class="info-title">blog</span>
                                    <ul class="tags-list">
                                        <li class="tag-item"> <a class="tag-link" href="#">wordpress</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-12  col-sm-6  col-lg-4  portfolio-item mobile">
                            <div class="item"><a class="portfolio-img-link "
                                    href="assets_public/assets/Images/portfolio/6.jpg" data-fancybox=".filter">
                                    <div class="overlay overlay-color"></div><img class="portfolio-img  img-fluid "
                                        src="assets_public/assets/Images/portfolio/thumbs/6.jpg"
                                        alt="portfolio item photo"><i class="fas fa-search icon"></i>
                                </a>
                                <div class="item-info "><span class="info-title">mobile</span>
                                    <ul class="tags-list">
                                        <li class="tag-item"> <a class="tag-link" href="#">samsung</a></li>
                                        <li class="tag-item"> <a class="tag-link" href="#">oppo </a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Start .see-more-area-->
            <div class=" see-more-area   wow fadeInUp" data-wow-delay="0s"> <a class=" ma-btn-primary " href="#0">see
                    our portfolio</a></div>
            <!--End .see-more-area-->
        </div>
    </section>
    <!-- End  portfolio Section-->
    <!-- Start  testimonials Section-->
    <section class="testimonials testimonials-1-col d-flex align-items-center mega-section  " id="testimonials-1-col">
        <div class="container">
            <div class="section-heading center-heading">
                <h2 class="section-title wow" data-splitting="chars">testimonials</h2>
                <p class="section-subtitle wow fadeInUp" data-wow-delay=".5s">Lorem ipsum dolor sit amet consectetur
                    adipisicing elit. Sunt, architecto cupiditate odio rerum est</p>
                <div class="line line-solid-main-color wow fadeIn" data-wow-delay="1s"></div>
            </div>
            <div class="swiper-container  wow fadeInUp  " data-wow-delay="0.4s">
                <div class="swiper-wrapper">
                    <!--First Slide-->
                    <div class="swiper-slide">
                        <div class="testimonial-content">
                            <div class="customer-testimonial"><i class="fas fa-quote-left   icon"></i>
                                <div class="content">
                                    <p class="testimonial-text ">
                                        ipsum
                                        dolor sit amet consectetur adipisicing elit. Quod, id sequi aut qui est
                                        ab,
                                        corporis quis maiores reiciendis explicabo odio tenetur nulla sint vel.
                                    </p>
                                </div>
                            </div>
                            <div class="customer-info "><img class="img-fluid "
                                    src="assets_public/assets/images/testimonials/1.jpg" alt="First Slide ">
                                <div class="customer-details">
                                    <p class="customer-name">mhmd Amin</p>
                                    <p class="customer-role">manager</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Second Slide-->
                    <div class="swiper-slide">
                        <div class="testimonial-content">
                            <div class="customer-testimonial"><i class="fas fa-quote-left    icon "></i>
                                <div class="content">
                                    <p class="testimonial-text ">
                                        ipsum
                                        dolor sit amet consectetur adipisicing elit. Quod, id sequi aut qui est
                                        ab,
                                        corporis quis maiores reiciendis explicabo odio tenetur nulla sint vel.
                                    </p>
                                </div>
                            </div>
                            <div class="customer-info "><img class="img-fluid "
                                    src="assets_public/assets/images/testimonials/2.jpg" alt="First Slide ">
                                <div class="customer-details">
                                    <p class="customer-name">yusuf Amin</p>
                                    <p class="customer-role">manager</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Third Slide-->
                    <div class="swiper-slide">
                        <div class="testimonial-content">
                            <div class="customer-testimonial"><i class="fas fa-quote-left   icon"></i>
                                <div class="content">
                                    <p class="testimonial-text ">
                                        ipsum
                                        dolor sit amet consectetur adipisicing elit. Quod, id sequi aut qui est
                                        ab,
                                        corporis quis maiores reiciendis explicabo odio tenetur nulla sint vel.
                                    </p>
                                </div>
                            </div>
                            <div class="customer-info "><img class="img-fluid "
                                    src="assets_public/assets/images/testimonials/3.jpg" alt="First Slide ">
                                <div class="customer-details">
                                    <p class="customer-name">mostafa Amin</p>
                                    <p class="customer-role">manager</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--navigation buttons-->
                <div class="swiper-button-prev">
                    <div class="left-arrow"><i class="fas fa-arrow-left icon "></i>
                    </div>
                </div>
                <div class="swiper-button-next">
                    <div class="right-arrow"><i class="fas fa-arrow-right icon "></i>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End  testimonials Section-->
</div>
