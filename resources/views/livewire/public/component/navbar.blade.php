<?php

use Carbon\Carbon;
use App\Models\Util\Menus;
use App\Models\Settings\WebsIdentity;
use App\Models\Articles\Article;

$menus = Menus::where('status', 'Publish')
    ->where('parent_id', 0)
    ->orderBy('sort')
    ->get();

$identitas = WebsIdentity::find(1);
$arrBeritaBanner = Article::where('category_id', '1')->where('type_id', '1')->orderBy('id', 'DESC')->limit(3)->get();

?>
<!--Start Page Header-->
<header class="page-header menu-on-end" id="page-header">
    <!--start navbar-->
    <div class="container-fluid">
        <nav class="main-navbar " id="main-nav">
            <a class="navbar-brand " href="#">
                <img class="brand-logo light-logo " src="assets_public/assets/Images/logo/logo-eaudit.png" alt="" />
                <!-- img-fluid-->
                <img class="brand-logo dark-logo " src="assets_public/assets/Images/logo/logo-eaudit.png" alt="" />
                <!-- img-fluid-->
            </a>
            <div class="menu-toggler-btn"><span></span><span></span><span></span></div>
            {{-- <div class=" navbar-menu-wraper  " id="navbar-menu-wraper">
                <ul class="navbar-nav  mobile-menu ">
                    @foreach ($menus as $menu)
                    @if ($menu->Childs->count() == 0)
                    <li class="nav-item">
                        <a href="{{ $menu->url }}" class="nav-link">{{ $menu->name }}</a>
                    </li>
                    <li class="nav-item has-sub-menu">
                        @elseif($menu->Childs->count() > 0)
                        <a href="{{ $menu->url }}" class="nav-link">{{ $menu->name }} <i
                                class="fas fa-chevron-down"></i></a>
                        <ul class="sub-menu">
                            @foreach ($menu->Childs as $child)
                            @if ($child->status == 'Publish')
                            <li class="nav-item sub-menu-item">
                                <a href="{{ $child->url }}" class="nav-link sub-menu-link">{{ $child->name }}</a>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                    </li>
                    @endif
                    @endforeach
                </ul>
            </div> --}}
            <a href="{{ route('admin.login') }}" class="header-cta  ma-btn-primary">Login</a>
        </nav>
    </div>
    <!--End navbar-->
</header>
<!--End Page Header-->
