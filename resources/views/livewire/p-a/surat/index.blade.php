<div>
    {{-- The Master doesn't talk, he acts. --}}
    {{-- Daftar Surat Kunjungana --}}
    <div class="card">
        
        <!-- /.card-header -->
        <div class="card-body">
            <div class="d-flex flex-column flex-sm-row gap-2 justify-content-between mb-3">
                <h4 class="text-dark fw-bold">
                    <i class="fa fa-list"></i>
                    Daftar Surat Kunjungan Kerja
                </h4>
            </div>
            <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Asal Surat</th>
                            <th>Nomor Surat</th>
                            <th>Tanggal Surat</th>
                            <th>Perihal</th>
                            <th>Tujuan</th>
                            <th>Keterangan</th>
                            <th>File Surat</th>
                            <th>Alamat Kantor/Instansi Asal</th>
                            <th>Nama Pengirim Surat</th>
                            <th>No Whatsapp Pengirim</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->asal_surat }}</td>
                            <td>{{ $item->no_surat }}</td>
                            <td>{{ $item->tanggal_surat }}</td>
                            <td>{{ $item->keperluan }}</td>
                            <td>{{ $item->tujuan }}</td>
                            <td>{{ $item->keterangan_surat }}</td>
                            <td>
                                <a href="{{ asset('/storage/files/surat/'. $item->file) }}" target="_blank">Lihat Berkas</a>
                            </td>
                            <td>{{ $item->alamat }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->no_hp }}</td>
                            <td>
                                {{-- <button wire:click="edit({{ $item->id }})" class="btn btn-primary btn-sm">Edit</button> --}}
                                <button wire:click="delete({{ $item->id }})" class="btn btn-danger btn-sm">Hapus</button>
                            </td>
                        </tr>
                        @endforeach
                        {{-- if empty data --}}
                        @if ($data->count() == 0)
                        <tr>
                            <td colspan="12" class="text-center">Tidak ada data</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
</div>

@push('script')
    <script type="text/javascript">
        window.livewire.on('dataStore', () => {
            $('.modal').modal('hide');
        });
    </script>
@endpush
