<?php

use Carbon\Carbon;
?>
<div>

    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Dashboard</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Panel Admin</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-md-6 col-xl-3">
                <div class="card bg-primary border-primary">
                    <div class="card-body">
                        <div class="mb-4">
                            <span class="badge badge-soft-light float-right">Semua data</span>
                            <h5 class="card-title mb-0 text-white">Artikel</h5>
                        </div>
                        <div class="row d-flex align-items-center mb-4">
                            <div class="col-8">
                                <h2 class="d-flex align-items-center mb-0 text-white">
                                    {{ number_format($articleCount, 0, '.', '.') }}
                                </h2>
                            </div>
                            <div class="col-4 text-right">
                                <h1 class="text-white"><i class="mdi mdi-notebook-multiple"></i></h1>
                            </div>
                        </div>

                        <div class="progress badge-soft-light shadow-sm" style="height: 5px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="card bg-success border-success">
                    <div class="card-body">
                        <div class="mb-4">
                            <span class="badge badge-soft-light float-right">Semua data</span>
                            <h5 class="card-title mb-0 text-white">Album</h5>
                        </div>
                        <div class="row d-flex align-items-center mb-4">
                            <div class="col-8">
                                <h2 class="d-flex align-items-center text-white mb-0">
                                    {{ number_format($albumCount, 0, '.', '.') }}
                                </h2>
                            </div>
                            <div class="col-4 text-right">
                                <h1 class="text-white"><i class="mdi mdi-image-filter"></i></h1>
                            </div>
                        </div>

                        <div class="progress badge-soft-light shadow-sm" style="height: 7px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="card bg-warning border-warning">
                    <div class="card-body">
                        <div class="mb-4">
                            <span class="badge badge-soft-light float-right">Semua data</span>
                            <h5 class="card-title mb-0 text-white">Video</h5>
                        </div>
                        <div class="row d-flex align-items-center mb-4">
                            <div class="col-8">
                                <h2 class="d-flex align-items-center text-white mb-0">
                                    {{ number_format($videoCount, 0, '.', '.') }}
                                </h2>
                            </div>
                            <div class="col-4 text-right">
                                <h1 class="text-white"><i class="mdi mdi-file-video-outline"></i></h1>
                            </div>
                        </div>

                        <div class="progress badge-soft-light shadow-sm" style="height: 7px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="card bg-info border-info">
                    <div class="card-body">
                        <div class="mb-4">
                            <span class="badge badge-soft-light float-right">Semua data</span>
                            <h5 class="card-title mb-0 text-white">Berkas</h5>
                        </div>
                        <div class="row d-flex align-items-center mb-4">
                            <div class="col-8">
                                <h2 class="d-flex align-items-center text-white mb-0">
                                    {{ number_format($berkasCount, 0, '.', '.') }}
                                </h2>
                            </div>
                            <div class="col-4 text-right">
                                <h1 class="text-white"><i class="mdi mdi-file-document-box-check"></i></h1>
                            </div>
                        </div>

                        <div class="progress badge-soft-light shadow-sm" style="height: 7px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col-->
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Chart Pengunjung</h4>

                        <div class="col-12" style="min-height: 400px">
                            <div id="chartVisitor"></div>
                        </div>

                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>

    </div> <!-- container-fluid -->

</div>

@push('script')
    <!-- Apex Charts -->
    <script src="{{ asset('assets_admin/vendor/apex/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets_admin/vendor/apex/custom/sales/sparkline.js') }}"></script>
    <script>
        var options = {
            chart: {
                height: 400,
                type: 'area',
                toolbar: {
                    show: false,
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: 3
            },
            series: [{
                name: 'Pengunjung',
                data: [
                    @foreach ($charts as $chart)
                        {{ $chart['value'] }},
                    @endforeach
                ]
            }],
            grid: {
                borderColor: '#e0e6ed',
                strokeDashArray: 5,
                xaxis: {
                    lines: {
                        show: true
                    }
                },
                yaxis: {
                    lines: {
                        show: false,
                    }
                },
                padding: {
                    top: 0,
                    right: 0,
                    bottom: 10,
                    left: 0
                },
            },
            xaxis: {
                categories: [
                    @foreach ($charts as $chart)
                        "{{ $chart['date'] }}",
                    @endforeach
                ],
            },
            yaxis: {
                labels: {
                    show: false,
                }
            },
            colors: ['#435EEF'],
            markers: {
                size: 0,
                opacity: 0.3,
                colors: ['#435EEF'],
                strokeColor: "#ffffff",
                strokeWidth: 2,
                hover: {
                    size: 7,
                }
            },
        }

        var chart = new ApexCharts(
            document.querySelector("#chartVisitor"),
            options
        );

        chart.render();
    </script>
@endpush
