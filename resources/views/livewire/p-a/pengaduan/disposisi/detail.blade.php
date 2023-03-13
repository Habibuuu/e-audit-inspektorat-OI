<?php

use Carbon\Carbon;

?>
<div>
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Detail Pengaduan</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Pengaduan</a></li>
                            <li class="breadcrumb-item active">Detail</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-3">
                <div class="card" style="margin-bottom: 14px; border: solid 1px #7266bc; border-radius: 0.7rem;">
                    <div class="card-body">
                        <div class="row" style="display: flex; justify-content: center; border-top: solid 5px #7266bc;">
                            <div class="text-center">
                                <div>
                                    @if($status == 'belum_diverifikasi')
                                    <i style="color: #f8ac5a; font-size: 48px;" class="mdi mdi-email"></i>
                                    <p>Belum Diverifikasi</p>
                                    @endif
                                    @if($status == 'sudah_diverifikasi')
                                    <i style="color: #23b5e2; font-size: 48px;" class="mdi mdi-email"></i>
                                    <p>Sudah Diverifikasi</p>
                                    @endif
                                    @if($status == 'ditolak')
                                    <i style="color: #f15050; font-size: 48px;" class="mdi mdi-email"></i>
                                    <p>Ditolak</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h6 style="font-weight: 500">Pengirim</h6>
                                <h5>{{ $pengirim }}</h5>
                                <span class="badge-pill badge-primary"
                                    style="background-color: grey;font-size:10px;">{{ Carbon::parse($tgl_pengaduan)->isoFormat('DD MMMM YYYY') }}</span>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h6 style="font-weight: 500">Penerima</h6>
                                <h5>{{ $penerima }}</h5>
                                <span class="badge-pill badge-primary"
                                    style="background-color: grey;font-size:10px;">{{ Carbon::parse($created_at)->isoFormat('DD MMMM YYYY') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card" style="margin-bottom: 14px; border: solid 1px #7266bc; border-radius: 0.7rem;">
                    <div class="card-body">
                        <div class="text-center" style="margin-bottom: 20px;">
                            <a href="https://e-office.oganilirkab.go.id:443//data/surat_eksternal/surat_masuk/surat20230304060007NTE2ZMNM_(signed).pdf"
                                class="btn btn-info btn-block btn-outline"><i class="lni lni-download"></i>
                                Log Pengajuan</a>
                        </div>
                        @foreach ($datalog as $log)
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h6 style="font-weight: 500">{{ $log->status_log }}</h6>
                                <h5>{{ $log->pegawai }}</h5>
                                <span class="badge-pill badge-primary"
                                    style="background-color: grey;font-size:10px;">{{ Carbon::parse($log->tgl_log)->isoFormat('DD MMMM YYYY') }}</span>
                            </div>
                        </div>
                        <hr>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-xl-9">
                <div class="card" style="margin-bottom: 14px; border: solid 1px #7266bc; border-radius: 0.7rem;">
                    <div class="card-body">
                        <div class="row" style="border-top: solid 5px #7266bc; padding-top: 20px; padding-left: 10px;">
                            <div>
                                <h3 style="color: #7266bc" class="box-title"><span style="color: #222">PERIHAL : </span> {{ $perihal }}</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            <table class="table b-b" style="margin-bottom: 0px;">
                                <tbody>
                                    <tr>
                                        <td style="width: 120px;">No Pengaduan </td>
                                        <td> <strong>: {{ $no_pengaduan }} </strong></td>
                                    </tr>
                                    @if ($datkat)
                                    <tr>
                                        <td style="width: 120px;">Kategori</td>
                                        <td>
                                            <strong>:
                                                @foreach ($datkat as $key => $kat)
                                                <span> {{ $kat->name }},</span>
                                                @endforeach
                                            </strong>
                                        </td>
                                    </tr>
                                    @endif
                                    @if ($datwil)
                                    <tr>
                                        <td style="width: 120px;">Wilayah</td>
                                        <td>
                                            <strong>:
                                                @foreach ($datwil as $key => $wil)
                                                <span> {{ $wil->name }},</span>
                                                @endforeach
                                            </strong>
                                        </td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td style="width: 120px;">Alamat</td>
                                        <td> <strong>: {{ $alamat }} </strong></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 120px;">Isi Singkat</td>
                                        <td> <strong>: {{ $isi }} </strong></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 120px;">Catatan</td>
                                        <td> <strong>: {{ $catatan }} </strong></td>
                                    </tr>
                                    @if($scanPrev)
                                    <tr>
                                        <td style="width: 120px;">Scan File</td>
                                        <td> <strong>:
                                            @foreach ($scanPrev as $scan)
                                            <a href="{{ asset('storage/pengaduan/scanfile/' . $scan) }}" target="_blank">
                                                <button class="badge-pill badge-info" style="border: solid 1px #000000;" data-toggle="tooltip" data-placement="top" title="Klik untuk melihat">{{ $scan }}</button> |
                                            </a>
                                            @endforeach
                                        </strong></td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                            </div>
                            <!--/span-->
                        </div>
                    </div>
                </div>
                <div class="card" style="margin-bottom: 14px; border: solid 1px #7266bc; border-radius: 0.7rem;">
                    <div class="card-body">
                        <table>
                            <tbody>
                                @if($lampiranPrev)
                                <tr>
                                    <td style="background-color: #fff;padding: 10px;font-weight: 500;border-left: solid 3px #6003C8; width: 120px;">Lampiran</td>
                                    <td>
                                    <strong>:
                                        @foreach ($lampiranPrev as $lampiran)
                                        <a href="{{ asset('storage/pengaduan/lampiran/' . $lampiran) }}" target="_blank">
                                            <button class="badge-pill badge-info" style="border: solid 1px #000000;" data-toggle="tooltip" data-placement="top" title="Klik untuk melihat">{{ $lampiran }}</button> |
                                        </a>
                                        @endforeach
                                    </strong>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card" style="margin-bottom: 14px; border: solid 1px #7266bc; border-radius: 0.7rem;">
                    <div class="card-body">
                        @canany(['onlyAdmin', 'inspektur'])
                        <div class="row">
                            @if ($disposisi !== null)
                            <div class="col-md-12">
                                <div class="card text-white bg-info mb-0">
                                    <div class="card-body">
                                        <p>Pengaduan Sudah didisposisikan ke {{ $disposisi }}</p>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="col-md-4">
                                <a href="{{ route('admin.pengaduan.disposisi.index') }}"
                                class="btn btn-outline-warning btn-block"><i class="mdi mdi-call-missed"></i>
                                Kembali</a>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-outline-info btn-block" data-toggle="modal"
                                        data-target="#updateModalPengaduan" wire:click="disposisiPengaduan({{ $pengaduanId }})"><i
                                        class="fa fa-check"></i> Disposisi Pengaduan
                                </button>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-outline-danger btn-block" data-toggle="modal"
                                        data-target="#updateModal" wire:click="reject({{ $pengaduanId }})"><i
                                        class="feather-x"></i> Tolak Pengaduan
                                </button>
                            </div>
                            @endif
                        </div>
                        @endcanany
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- modal tolak --}}
    <div wire:ignore.self class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tolak Pengaduan</h5>
                    <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group mb-3">
                            <input type="hidden" wire:model.defer="jenisId">
                            <label class="form-label">Nama Jenis</label>
                            <input type="text" class="form-control" wire:model.defer="alasantolak"
                                placeholder="Masukan Alasan" value="{{ $alasantolak }}">
                            @error('alasantolak')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click.prevent="cancel()" class="btn btn-warning"
                        data-dismiss="modal">
                        <i class="fa fa-times"></i> Tutup
                    </button>
                    <button type="button" wire:click.prevent="updateAlasan()" class="btn btn-primary">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- modal disposisi --}}
    <div wire:ignore.self class="modal fade" id="updateModalPengaduan" tabindex="-1" aria-labelledby="updateModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Disposisikan surat</h5>
                    <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group mb-3" wire:ignore>
                            <input type="hidden" wire:model.defer="jenisId">
                            <label>Penerima Disposisi</label>
                            <select  wire:model.defer="disposisi" class="form-control" data-toggle="select2">
                                <option>Pilih penerima</option>
                                @foreach ($datas as $data)
                                <option value="{{ $data->fullname }}">{{ $data->fullname }} - {{ $data->jabatan }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- <div class="form-group mb-3">
                            <label class="form-label">Instruksi</label>
                            <input type="text" class="form-control" wire:model.defer="instruksi"
                                placeholder="Masukan Instruksi" value="{{ $instruksi }}">
                        </div> --}}
                        <div class="form-group mb-3" wire:ignore>
                            <label>Instruksi</label>
                            <select  wire:model.defer="instruksi" style="width: 100%;" class="form-control instruksi" id="instruksiSelect" data-toggle="select2" multiple>
                                <option value="Wakili / Hadiri / Terima / Laporkan Hasilnya">Wakili / Hadiri / Terima / Laporkan Hasilnya</option>
                                <option value="Agendakan / Persiapan / Koordinasi">Agendakan / Persiapan / Koordinasi</option>
                                <option value="Selesaikan Sesuai Ketentuan / Peraturan yang Berlaku">Selesaikan Sesuai Ketentuan / Peraturan yang Berlaku</option>
                                <option value="Pelajari / Telaah / Sarannya">Pelajari / Telaah / Sarannya</option>
                                <option value="Untuk Ditindaklanjuti / Dipedomani / Dipenuhi sesuai Ketentuan">Untuk Ditindaklanjuti / Dipedomani / Dipenuhi sesuai Ketentuan</option>
                                <option value="Untuk Dibantu / Difasilitasi / Dipenuhi sesuai Ketentuan">Untuk Dibantu / Difasilitasi / Dipenuhi sesuai Ketentuan</option>
                                <option value="Untuk Dijawab / Dicatat / FILE">Untuk Dijawab / Dicatat / FILE</option>
                                <option value=" Siapkan Pointer / Sambutan / Bahan Lebih Lanjut"> Siapkan Pointer / Sambutan / Bahan Lebih Lanjut</option>
                                <option value="Untuk Dibantu Sesuai Kemampuan dan Ketentuan">Untuk Dibantu Sesuai Kemampuan dan Ketentuan</option>
                                <option value="ACC, Sesuai Ketentuan yang Berlaku">ACC, Sesuai Ketentuan yang Berlaku</option>
                                <option value="ACC, Saran Saudara">ACC, Saran Saudara</option>
                                <option value="AMM">AMM</option>
                                <option value="Instruksi Lainnya">Instruksi Lainnya</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Catatan (opsional)</label>
                            <input type="text" class="form-control" wire:model.defer="catatandis"
                                placeholder="Masukan Catatan" value="{{ $catatandis }}">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click.prevent="cancel()" class="btn btn-warning"
                        data-dismiss="modal">
                        <i class="fa fa-times"></i> Tutup
                    </button>
                    <button type="button" wire:click.prevent="updateDisposisi()" class="btn btn-primary">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('script')
    <script>
        $(document).ready(function() {
            $('.instruksi').select2();
        });

        $('#instruksiSelect').on('change', function(e) {
            let data = $(this).val();
            @this.set('instruksi', data);
        });
    </script>
    @endpush()
</div>
