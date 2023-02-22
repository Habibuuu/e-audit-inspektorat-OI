<?php
use App\Models\Settings\WebsIdentity;
$identitas = WebsIdentity::find(1);
?>
<div class="portal">
    <div class="container-fluid p-0">
        <!--START NAVBAR-->
        <nav class="navbar navbar-light nav-header">
            <a class="navbar-brand" href="">
                <img src="img/logo.png" alt="">
                <span class="navbar-text">
                    <span class="navbar-text-site">Portal Resmi</span>
                    <span class="navbar-text-brand">KABUPATEN OGAN ILIR</span>
                </span>
            </a>
            {{-- <button class="learn-more">
                    <span class="circle" aria-hidden="true">
                        <span class="icon arrow"></span>
                    </span>
                    <span class="button-text">
                        <a href="{{ route('public.index') }}">
                            MASUK WEB
                        </a>
                    </span>
                </button> --}}
            <span class="navbar-brand-left d-inline-block d-lg-none">

            </span>
            <span class="navbar-brand-right text-lg-right">
                <img src="img/bangkit.png" alt="">
            </span>
        </nav>
        <!--END NAVBAR-->
        <!--START CONTENT-->
        <div class="row m-0 content">
            <div class="col-12">
                <div class="row">
                    <div class="col-12 col-lg-3 col-xl-3">
                        <div class="circle-widget">
                            <div class="img-wrap">
                                <img src="img/bupati.png" alt="" class="w-100" />
                            </div>
                            <div class="text-widget">
                                <div class="title">BUPATI OGAN ILIR</div>
                                <div class="sub">PANCA WIJAYA AKBAR, S.H.</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 col-xl-6 px-lg-0 text-center" id="map">
                        <img src="img/map9.png" alt="" class="peta" />
                    </div>
                    <div class="col-12 col-lg-3 col-xl-3">
                        <div class="circle-widget">
                            <div class="img-wrap">
                                <img src="img/wakil-bupati.png" alt="" class="w-100" />
                            </div>
                            <div class="text-widget">
                                <div class="title">WAKIL BUPATI OGAN ILIR</div>
                                <div class="sub">H. ARDANI, S.H.,M.H.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--END CONTENT-->
    </div>
    <nav class="fixed-bottom animation-ogan-ilir"></nav>
    <!--START TOOLBAR-->
    <nav class="navbar fixed-bottom navbar-light nav-footer">

        <div class="toolbar mx-lg-auto">
            @foreach ($portals as $portal)
                @if ($portal->level == 'level1')
                    <div class="toolbar-grid">
                        <a href="{{ $portal->url }}" target="_blank">
                            <div class="toolbar-icon" style=" background: linear-gradient( 133deg, {{ $portal->color_1 }}, {{ $portal->color_2 }} );">
                            <img src=" {{ asset('/storage/images/portal/small/' . $portal->photo) }}"
                                class="img img-portal eva">
                            </div>
                            <div class="toolbar-text">{{ $portal->name }}</div>
                        </a>
                    </div>
                @else
                <div class="toolbar-grid">
                    <a href="javascript:void(0);" data-toggle="modal" data-target="#{{ $portal->slug . 'Modal' }}">
                        <div class="toolbar-icon" style=" background: linear-gradient( 133deg, {{$portal->color_1}}, {{$portal->color_2}} );">
                            <img src="{{ asset('/storage/images/portal/small/' . $portal->photo) }}" class="img img-portal eva">
                        </div>
                        <div class="toolbar-text">{{ $portal->name }}</div>
                    </a>
                </div>
                @endif
            @endforeach


            <div class="toolbar-grid hide-desktop">
                <a href="javascript:void(0);" data-toggle="modal" data-target="#sosialmediaModal">
                    <div class="toolbar-icon" style=" background: linear-gradient( 133deg, {{$portal->color_1}}, {{$portal->color_2}} );">
                        <span data-eva="browser-outline"></span>
                    </div>
                    <div class="toolbar-text">MEDIA SOSIAL</div>
                </a>
            </div>
        </div>
    </nav>
    <!--END TOOLBAR-->
    <!--START PATTERN-->
    <div class="green-pattern d-none d-lg-block">
        <div class="dot-green-pattern"></div>
        <div class="box-green-pattern"></div>
    </div>
    <!--END PATTERN-->
    <!--START MODAL-->
    <!--Pemerintahan Modal-->
    @foreach ($portals->where('level', 'level2') as $portal)
        <div class="modal p-0" id="{{ $portal->slug . 'Modal' }}" tabindex="-1" role="dialog"
            aria-labelledby="{{ $portal->slug }}ModalLabel" aria-hidden="true">
            <div class="modal-portal modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="w-100 text-center">
                            <h2 class="modal-title" id="{{ $portal->slug }}ModalLabel">{{ $portal->name }}</h2>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            @foreach ($portal->Childs->where('status', 'Publish') as $child)
                                <div class="col-lg-3 col-6 px-4">
                                    <a href="{{ $child->url }}" target="_blank">
                                        <div class="card-medium">
                                            <span class="fa">
                                                <img src="{{ asset('/storage/images/portal/small/' . $child->photo) }}"
                                                    class="img img-portal"
                                                    style="width:100%; height:50px; object-fit:contain">
                                            </span>
                                            <div class="card-medium-text">
                                                {{ $child->name }}
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- End --}}
</div>
