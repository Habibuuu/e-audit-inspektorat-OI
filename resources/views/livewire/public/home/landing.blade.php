<div>

    <section class="section bg-color-grey-scale-1 section-height-3 border-0 m-0 p-0" id="landing-wrapper">

        <div id="landing">
        </div>

        <div class="container pb-5 pt-5">
            <div class="row gy-2">
                <div class="col-12">
                    <img src="{{ asset('images/logo-ori.png') }}" class="img"
                        style="width:100%; height:60px;object-fit:contain;">
                </div>
                {{-- <div class="col-12">
                    <h2 class="font-weight-normal text-center text-6 pb-3">Layanan <strong
                            class="font-weight-extra-bold">Kami</strong></h2>
                </div> --}}
            </div>
            <div class="row mb-lg-4 justify-content-center mt-4 g-4">

                @foreach ($arrPortal as $portal)
                    <div class="col-sm-4 appear-animation" data-appear-animation="fadeInUpShorter"
                        data-appear-animation-delay="300">
                        <div
                            class="featured-boxes featured-boxes-modern-style-2 featured-boxes-modern-style-2-hover-only featured-boxes-modern-style-primary m-0 mb-4 pb-3">
                            <div class="featured-box featured-box-no-borders border">
                                <a href="{{ $portal->url }}" target="_blank" class="text-decoration-none">
                                    <span class="box-content px-1 py-4 text-center d-block">
                                        <span class="text-primary text-8 position-relative top-3 mt-3">
                                            <img src="{{ asset('storage/portals/' . $portal->image) }}"
                                                class="img img-portal"
                                                style="width:100%; height:300px; object-fit:contain">
                                        </span>
                                        <span class="elements-list-shadow-icon text-default">
                                            <i class="fas fa-bars"></i>
                                        </span>
                                        <span
                                            class="font-weight-bold text-uppercase text-1 negative-ls-1 d-block text-light pt-2">
                                            {{ $portal->name }}
                                        </span>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>

    </section>

    <div class="home-intro mb-0 py-2" id="home-intro">
        <div class="container">

            <div class="row align-items-center">
                <div class="col-lg-8">
                    <p>
                        Dinas Komunikasi
                        <span
                            class="highlighted-word highlighted-word-animation-1 text-color-primary font-weight-semibold text-5">
                            Informatika,
                        </span>
                        Statistik dan Persandian
                        <span>Lihat selengkapnya di Website Kami.</span>
                    </p>
                </div>
                <div class="col-lg-4">
                    <div class="get-started text-start text-lg-end">
                        <a href="{{ route('public.index') }}"
                            class="btn btn-primary btn-lg text-3 font-weight-semibold px-4 py-3">
                            Mulai Sekarang!
                        </a>
                        {{-- <div class="learn-more">or <a href="index.html">learn more.</a></div> --}}
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- MODAL --}}
    <div class="modal fade" id="popUpModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <a href="{{ route('public.mtq-2022') }}">
                        <img src="{{ asset('storage/infographics/original/' . $mtqToday->filename) }}"
                            style="width:100%; border-radius:0.3rem;">
                    </a>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .home-intro {
                width: 100%;
                position: fixed;
                bottom: 0;
            }

            .featured-box {
                border-radius: 2rem !important;
                background: rgba(0, 0, 0, 0.2);
            }

            .featured-boxes-modern-style-2 .featured-box:before {
                background: transparent !important;
                /* background: rgba(0, 0, 0, 0.2) !important; */
            }

            #landing-wrapper {
                position: relative;
            }

            #landing {
                position: absolute;
                height: 100%;
                width: 100%;
                padding-top: 5rem;
                padding-bottom: 5rem;
                background-image: linear-gradient(black, black), url('{{ asset('images/landing-bg.jpg') }}');
                background-repeat: no-repeat;
                background-position: center;
                background-size: cover;
                background-attachment: fixed;
                background-blend-mode: soft-light;
                /* background-blend-mode: saturation; */

            }

        </style>
    @endpush

    @push('script')
        <script>
            $(document).ready(function() {
                $("#popUpModal").modal('show');
            });
        </script>
    @endpush

</div>
