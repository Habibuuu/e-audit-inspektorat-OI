<?php

use Carbon\Carbon;
use Illuminate\Support\Str;

?>
<div>
    <section class="page-header page-header-classic page-header-md">
        <div class="container" wire:ignore>
            <div class="row">
                <div class="col-md-8 order-2 order-md-1 align-self-center p-static">
                    <h1 data-title-border>{{ $service->name }}</h1>
                </div>
                <div class="col-md-4 order-1 order-md-2 align-self-center">
                    <ul class="breadcrumb d-block text-md-end">
                        <li><a href="{{ route('public.index') }}">Beranda</a></li>
                        <li><a href="{{ route('public.layanan-index') }}">Layanan</a></li>
                        <li class="active">{{ Str::words(strip_tags($service->name), 3, '...') }}</li>
                    </ul>

                </div>
            </div>
        </div>
    </section>

    <div class="container">

        <div class="row">
            <div class="col-lg-3 order-lg-2">
                <livewire:public.component.sidebar />
            </div>
            <div class="col-lg-9 order-lg-1">

                <ul class="list list-icons list-primary list-borders list-side-borders">
                    @foreach($datas as $data)
                    <li class="appear-animation" data-appear-animation="fadeInUp" data-appear-animation-delay="{{ $loop->index*300 }}">
                        <a href="#" class="text-dark text-decoration-none">
                            <i class="fas fa-archive fs-5"></i>
                            <h4 class="m-0">{{ $data->title }}</h4>
                            <p class="m-0">
                                <small>
                                    <i class="fa fa-calendar-alt"></i>
                                    {{ Carbon::parse($data->created_at)->isoFormat('dddd, DD MMMM YYYY') }}
                                </small>
                            </p>
                        </a>
                    </li>
                    @endforeach
                </ul>

                @if($datas->count() == 0)
                <div class="alert alert-info">
                    <strong>
                        <i class="fas fa-exclamation-circle"></i>
                        Belum Ada Informasi Layanan.
                    </strong>
                </div>
                @endif

            </div>
        </div>

    </div>
</div>
