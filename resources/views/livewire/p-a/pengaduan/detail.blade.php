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
                                    style="background-color: grey;font-size:10px;">23 Februari 2023</span>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h6 style="font-weight: 500">Penerima</h6>
                                <h5>{{ $penerima }}</h5>
                                <span class="badge-pill badge-primary"
                                    style="background-color: grey;font-size:10px;">04 Maret 2023</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card" style="margin-bottom: 14px; border: solid 1px #7266bc; border-radius: 0.7rem;" hidden>
                    <div class="card-body">
                        <div class="text-center" style="margin-bottom: 20px;">
                            <a href="https://e-office.oganilirkab.go.id:443//data/surat_eksternal/surat_masuk/surat20230304060007NTE2ZMNM_(signed).pdf"
                                class="btn btn-info btn-block btn-outline"><i class="lni lni-download"></i>
                                Log Pengajuan</a>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h6 style="font-weight: 500">Dibuat/dikirim</h6>
                                <h5>{{ $pengirim }}</h5>
                                <span class="badge-pill badge-primary"
                                    style="background-color: grey;font-size:10px;">23 Februari 2023</span>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h6 style="font-weight: 500">Didistribusikan</h6>
                                <h5>BILLY</h5>
                                <p>Inspektur Kab Ogan Ilir</p>
                                <span class="badge-pill badge-primary"
                                    style="background-color: grey;font-size:10px;">04 Maret 2023</span>
                            </div>
                        </div>
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
                        <div class="row">
                            <div class="col-md-4">
                                <a href="{{ route('admin.pengaduan.index') }}"
                                class="btn btn-outline-warning btn-block"><i class="mdi mdi-call-missed"></i>
                                Kembali</a>
                            </div>
                            <div class="col-md-4">
                                <a href="#" wire:click="update('{{ $pengaduanId }}')"
                                class="btn btn-outline-secondary btn-block"><i class="fa fa-edit"></i>
                                Edit Pengaduan</a>
                            </div>
                            <div class="col-md-4">
                                <a href="#" wire:click="confirmDelete('{{ $pengaduanId }}')"
                                class="btn btn-outline-danger btn-block"><i class="fa fa-trash"></i>
                                Hapus Pengaduan</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div wire:ignore.self class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Jenis</h5>
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
                                placeholder="Masukan Nama Jenis" value="{{ $alasantolak }}">
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
</div>
