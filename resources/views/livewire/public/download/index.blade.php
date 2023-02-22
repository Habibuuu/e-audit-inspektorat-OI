<?php

use Carbon\Carbon;

?>

<div class="container mx-auto px-4 mt-4">

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-2">
        <div class="sm:col-span-3">
            <div class="bg-white bg-opacity-20 rounded shadow-md p-4">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="text-xl font-bold text-black border-b border-dashed border-gray-300 pb-2 mb-2">
                            Download Area
                        </h1>
                    </div>
                    <div class="col-md-4 pull-right">
                        <input type="text" class="form-control" placeholder="Cari Berkas" wire:model="searchTerm" />
                    </div>
                </div>

                @if($datas->count())
                <div class="grid grid-cols gap-y-2">
                    <!-- <input type="text"  class="form-control col-lg-8 d-none" placeholder="Cari Berkas" wire:model="searchTerm" /> -->
                    <div class="w-full">
                        <table class="table-auto w-full" id="download">
                            <thead>
                                <tr class="border border-gray-400 bg-blue-900 text-gray-200">
                                    <th width="10px" class="border-r border-gray-400 p-2 py-3">No.</th>
                                    <th class="border-r border-gray-400 p-2 py-3">Judul</th>
                                    <th width="100px" class="p-2 py-3">Pilihan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                <tr class="border border-gray-400">
                                    <td class="text-center border-r border-gray-400 p-2">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="border-r border-gray-400 p-2">
                                        <p class="font-semibold text-gray-800 cursor-pointer hover:text-indigo-700 triggerModal"
                                            onclick="openModal(true)" data-title="{{ $data->title }}"
                                            data-file="{{ $data->file }}">
                                            {{ $data->title }}
                                        </p>
                                        <p class="text-xs italic text-gray-600"><i class="fa fa-calendar"></i>
                                            {{ Carbon::parse($data->created_at)->locale('id_ID')->isoFormat('dddd, D MMMM YYYY') }}
                                        </p>
                                    </td>
                                    <td class="flex p-2 text-center">
                                        <a class="bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded text-white focus:outline-none mr-2 cursor-pointer"
                                            href="{{ asset('storage/downloads/' . $data->file) }}" target="_blank"
                                            download="{{ $data->title }}" title="Download"><i
                                                class="fa fa-download"></i> Download
                                        </a>
                                        <button onclick="openModal(true)"
                                            class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded text-white focus:outline-none triggerModal cursor-pointer"
                                            data-title="{{ $data->title }}" data-file="{{ $data->file }}"
                                            title="Lihat..">
                                            <i class="fa fa-search-plus"></i> Lihat
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="w-full mt-4">
                    {{ $datas->links() }}
                </div>
                @else
                <h2 class="text-xl text-stone-600 dark:text-stone-500 tracking-wide flex-1 font-serif py-8">No results
                    found.</h2>
                @endif
            </div>
        </div>

        {{-- <aside class="col-lg-auto sidebar mt-8 mt-lg-6">
            <!-- <input type="text"  class="form-control col-sm-12 d-none" placeholder="Cari Berkas" wire:model="searchTerm" /> -->
            <br>
            <livewire:public.component.sidebar />
        </aside> --}}
        <br>
    </div>
</div>

<!-- overlay -->
<div id="modal_overlay"
    class="hidden fixed z-20 inset-0 bg-black bg-opacity-70 h-screen w-full flex justify-center items-start md:items-center pt-5 md:pt-0">

    <!-- modal -->
    <div id="modal"
        class="opacity-0 transform -translate-y-full scale-150 relative w-10/12 md:w-3/4 h-full md:h-3/4 bg-white rounded shadow-lg transition-opacity transition-transform duration-300">

        <!-- button close -->
        <button onclick="openModal(false)"
            class="absolute -top-3 -right-3 bg-red-500 hover:bg-red-600 text-2xl w-10 h-10 z-20 rounded-full focus:outline-none text-white">
            &cross;
        </button>

        <!-- header -->
        <div class="px-4 py-3 border-b border-gray-200 w-full6 relative" style="height:10%">
            <h2 class="text-xl font-semibold text-gray-600" id="downloadLabel"></h2>
        </div>

        <!-- body -->
        <div class="w-full relative p-3" style="height:80%">
            <div class="w-full h-full" id="embedCont">
            </div>
        </div>

        <!-- footer -->
        <div class="relative bottom-0 left-0 px-4 py-3 border-t border-gray-200 w-full flex justify-end items-center gap-3"
            style="height:10%">
            <button onclick="openModal(false)"
                class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded text-white focus:outline-none">Close</button>
        </div>
    </div>

</div>

@push('styles')
<!-- Datatable -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<!-- End Datatable -->
@endpush

@push('script')
<!-- tailwind -->
<script src="https://cdn.tailwindcss.com"></script>

<script>
    $(".triggerModal").on('click', function (e) {
        e.preventDefault();
        var title = $(this).data('title');
        var file = $(this).data('file');
        $("#downloadLabel").html(title);
        $("#embedSrc").remove();
        $("#embedCont").append(
            '<iframe class="w-full h-full relative" id="embedSrc" src="{{ asset("storage/downloads/") }}/' +
            file + '" style="width:100%;margin:0;"></iframe>')
    });

</script>

<script>
    const modal_overlay = document.querySelector('#modal_overlay');
    const modal = document.querySelector('#modal');

    function openModal(value) {
        const modalCl = modal.classList
        const overlayCl = modal_overlay

        if (value) {
            overlayCl.classList.remove('hidden')
            setTimeout(() => {
                modalCl.remove('opacity-0')
                modalCl.remove('-translate-y-full')
                modalCl.remove('scale-150')
            }, 100);
        } else {
            modalCl.add('-translate-y-full')
            setTimeout(() => {
                modalCl.add('opacity-0')
                modalCl.add('scale-150')
            }, 100);
            setTimeout(() => overlayCl.classList.add('hidden'), 300);
        }
    }
    openModal(false)

</script>
<!-- end Tailwind -->
<!-- Datatable -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#downloads').DataTable();
    });

</script>
<!-- End Datatable -->
@endpush
