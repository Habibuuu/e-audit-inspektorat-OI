<?php

use Carbon\Carbon;
use App\Models\Settings\WebsIdentity;
use App\Models\Articles\Article;


$arrBeritaTer = Article::where('type_id', '1')->orderBy('created_at', 'DESC')->limit(2)->get();
$identitas = WebsIdentity::find(1);
?>
<div>
    <!-- Start  page-footer Section-->
    <footer class="page-footer dark-color-footer" id="page-footer">
        <div class="container">
            <div class="row footer-cols">
                <div class="col-12 col-md-8 col-lg-3  footer-col wow fadeInUp " data-wow-delay="0.3s">
                    <h6 class=" footer-col-title  ">{{ $identitas->app_name }}</h6>
                    <div class="footer-col-content-wrapper">
                        <p class="footer-text-about-us ">
                            {{ $identitas->address }}.
                        </p>
                        <div class="social-icons">
                            <div class="sc-wraper dir-row sc-size-32">
                                <ul class="sc-list">
                                    <li class="sc-item" title="Facebook"><a class="sc-link" href="#0"><i
                                                class="fab fa-facebook-f sc-icon"></i></a></li>
                                    <li class="sc-item" title="youtube"><a class="sc-link" href="#0"><i
                                                class="fab fa-youtube sc-icon"></i></a></li>
                                    <li class="sc-item" title="instagram"><a class="sc-link" href="#0"><i
                                                class="fab fa-instagram sc-icon"></i></a></li>
                                    <li class="sc-item" title="twitter"><a class="sc-link" href="#0"><i
                                                class="fab fa-twitter sc-icon"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6 footer-col wow fadeInUp " data-wow-delay="0.5s">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3983.362393502586!2d104.64861131498084!3d-3.2598599976267026!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e3bbe2f62b034ab%3A0xfce8338d34b70346!2sInspektorat%20kabupaten%20ogan%20ilir!5e0!3m2!1sen!2sid!4v1674615194113!5m2!1sen!2sid"
                        width="550" height="250" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
                <div class="col-12 col-md-8 col-lg-3 footer-col wow fadeInUp " data-wow-delay=".9s">
                    <h6 class="footer-col-title">Kontak Informasi</h6>
                    <div class="footer-col-content-wrapper">
                        <div class="contact-info-card"><i class="fas fa-envelope icon"></i><a
                                class="text-lowercase  info" href="mailto:example@support.com">{{ $identitas->email
                                }}</a></div>
                        <div class="contact-info-card"><i class="fas fa-mobile-alt icon"></i><a class="info"
                                href="tel:+20123456789">{{ $identitas->phone }} </a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyrights ">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <p class="creadits">
                            &copy; 2023
                            Created by:
                            <a class="link" href="#">Diskominfo Kabupaten Ogan Ilir.</a>
                        </p>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="terms-links"><a href="#0">Terms of Use </a>
                            | <a href="#0">Privacy Policy</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End  page-footer Section-->
    <!-- Start loading-screen Component-->
    <div class="loading-screen" id="loading-screen">
        <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>
    <!-- End loading-screen Component-->
    <!-- Start back-to-top Component-->
    <div class="back-to-top" id="back-to-top"><i class="fas fa-arrow-up icon"></i></div>
    <!-- End back-to-top Component-->

</div>
