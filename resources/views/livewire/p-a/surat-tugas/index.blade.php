<?php

use Carbon\Carbon;

?>
<div>
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Pengaduan</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Pengaduan</a></li>
                            <li class="breadcrumb-item active">Daftar</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="card" style="border-top: solid 10px #7266bc; border-radius: 0.7rem;">
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card" style="border: solid 3px #7266bc; padding-bottom: 15px; display: flex; justify-content: center; height: 100%; border-radius: 0.7rem;">
                            <div class="row">
                                <div class="col-md-2 col-sm-2 text-center my-auto" style="border-right: 1px solid rgba(120, 130, 140, 0.21);">
                                    <img src="https://e-office.oganilirkab.go.id:443/asset/logo/surat.png" width="80px" height="60px" alt="">
                                </div>
                                <div class="col-md-10 col-sm-10">
                                    <div class="row p-3">
                                        <div class="col-md-12 text-center" style="padding-bottom: 15px; border-bottom: 1px solid rgba(120, 130, 140, 0.21); color: #7266bc">
                                            <b>STATUS PENGAJUAN</b>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 text-center" style="border-right: 1px solid rgba(120, 130, 140, 0.21);" >
                                            <h3 class="box-title m-b-0">{{ $PengaduanCount }}</h3>
                                            <a style="color: #6003c8" href="{{ route('admin.pengaduan.index') }}">Total Pengaduan</a>
                                        </div>
                                        <div class="col-md-3 text-center" style="border-right: 1px solid rgba(120, 130, 140, 0.21);" >
                                            <h3 class="box-title m-b-0">{{ $UnverifiedCount }}</h3>
                                            <a style="color: #6003c8" href="#">Belum diverifikasi</a>
                                        </div>
                                        <div class="col-md-3 text-center" style="border-right: 1px solid rgba(120, 130, 140, 0.21);">
                                            <h3 class="box-title m-b-0">{{ $VerifiedCount }}</h3>
                                            <a style="color: #6003c8" href="#">Sudah diverifikasi</a>
                                        </div>
                                        <div class="col-md-3 text-center">
                                            <h3 class="box-title m-b-0">{{ $RejectCount }}</h3>
                                            <a style="color: #6003c8" href="#">ditolak</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-md-8">
                                <h4 class="card-title">Daftar Pengaduan</h4>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search Pengaduan">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                        <i class="fa fa-search"></i> Search
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="text-align: center; vertical-align: middle; width: 40px;">No.</th>
                                        <th style="text-align: center; vertical-align: middle;">Aduan (Perihal)</th>
                                        <th style="text-align: center; vertical-align: middle;">Pengirim</th>
                                        <th style="text-align: center; vertical-align: middle;">Tanggal</th>
                                        <th style="text-align: center; vertical-align: middle; width: 100px;">Status</th>
                                        <th style="text-align: center; vertical-align: middle;">Surat Tugas</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($datas as $data)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $data->perihal }}</td>
                                        <td>{{ $data->pengirim }}</td>
                                        <td>{{ Carbon::parse($data->tgl_pengaduan)->isoFormat('DD MMMM YYYY') }}</td>
                                        @if ($data->status == 'belum_diverifikasi')
                                        <td style="vertical-align: middle;"><p class="badge badge-warning">Belum diverifikasi</p></td>
                                        @elseif ($data->status == 'sudah_diverifikasi')
                                        <td style="vertical-align: middle;"><p class="badge badge-info">Sudah diverifikasi</p></td>
                                        @else
                                        <td style="vertical-align: middle;"><p class="badge badge-danger">Ditolak</p></td>
                                        @endif
                                        <td style="vertical-align: middle;">
                                            @if ($data->surat_tugas == null)
                                                <button class="btn btn-light w-100">
                                                    Surat tugas belum ada.
                                                </button>
                                            @else
                                                <div class="btn-group w-100">
                                                    <a href="{{ asset('storage/pengaduan/surat_tugas/'. $data->surat_tugas) }}" target="_blank" class="btn btn-secondary waves-effect waves-light"><i class="mdi mdi-download"></i></a>
                                                    <button type="button" class="btn btn-outline-secondary waves-effect waves-light">{{ $data->surat_tugas }}</button>
                                                </div>
                                            @endif
                                        </td>
                                        <td style="vertical-align: middle;">
                                            @if ($data->status == 'belum_diverifikasi')
                                                <button class="btn btn-light w-100" data-toggle="tooltip" data-placement="top" title="Pengaduan belum di verifikasi">
                                                    <i class="mdi mdi-file-cancel"></i> Upload Surat
                                                </button>
                                            @else
                                                <button class="btn btn-primary w-100" data-toggle="modal"
                                                    data-target="#Modal-{{ $data->id }}" wire:click="uploadST({{ $data->id }})">
                                                    <i class="mdi mdi-file-upload"></i>  Upload Surat
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="100">
                                            <div class="alert alert-warning">
                                                Data tidak ditemukan.
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <!-- end card-body-->
                </div>
            </div
        </div>
        <!-- end row -->

    </div> <!-- container-fluid -->

    {{-- Modal Upload Surat Tugas --}}
    <div wire:ignore.self class="modal fade" id="Modal-{{ $pengaduanId }}" tabindex="-1" aria-labelledby="updateModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload Surat Tugas</h5>
                    <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group" wire:ignore>
                            <div class="custom-file">
                                <input wire:model="surat_tugas" type="file" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" style="color: #7266bb;" for="customFile"><i class="mdi mdi-file-upload"></i> Upload Surat Tugas</label>
                            </div>
                            @error('surat_tugas')
                                <small class="text-danger error">{{ $message }}</small>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning close-btn" data-dismiss="modal"><i
                            class="fa fa-times"></i>
                        Tutup</button>
                    <button type="button" wire:click.prevent="store({{ $pengaduanId }})" class="btn btn-primary close-modal"><i
                            class="fa fa-save"></i> Simpan</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Lihat Disposisi --}}
    <div wire:ignore.self class="modal fade" id="Modal-{{ $disposisi }}" tabindex="-1" aria-labelledby="updateModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Disposisi Surat</h5>
                    <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row pl-3 pr-3 pb-2">
                        <div style="width: 100px;">
                            Penerima
                        </div>
                        <div style="width: 10px;">
                            :
                        </div>
                        <div class="p-2" style="border-radius: 10px; border: 1px solid #6003c8; width: 348px;">
                            {{ $disposisi }}
                        </div>
                    </div>
                    <div class="row pl-3 pr-3 pb-2">
                        <div style="width: 100px;">
                            Instruksi
                        </div>
                        <div style="width: 10px;">
                            :
                        </div>
                        <div class="p-2" style="border-radius: 10px; border: 1px solid #6003c8; width: 348px;">
                            {{ $instruksi }}
                        </div>
                    </div>
                    <div class="row pl-3 pr-3 pb-2">
                        <div style="width: 100px;">
                            Catatan (opsional)
                        </div>
                        <div style="width: 10px;">
                            :
                        </div>
                        <div class="p-2" style="border-radius: 10px; border: 1px solid #6003c8; width: 348px;">
                            {{ $catatandis }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
