<?php

use Carbon\Carbon;

?>
<div>
   @push('page_title')
      {{ 'Kritin & Saran | Panel Admin' }}
   @endpush

   <div class="section-header">
      <h1>Daftar Kritin & Saran</h1>
      <div class="section-header-breadcrumb">
         <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
         <div class="breadcrumb-item">Kritin & Saran</div>
      </div>
   </div>

   <div class="section-body">
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-body">

                  <div class="table-responsive">
                     <table class="table table-bordered">
                        <thead>
                           <tr>
                              <th width="1px">No.</th>
                              <th>Nama</th>
                              <th width="330px">Email</th>
                              <th width="150px">Status</th>
                              <th width="50px">Opsi</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach ($datas as $data)
                              <tr id="item-{{ $data->id }}">
                                 <td>{{ $loop->iteration }}</td>
                                 <td>
                                    <a href="#" data-toggle="modal" data-target="#exampleModal"
                                       wire:click.prevent="getData('{{ $data->id }}')">
                                       <h6 class="text-dark">
                                          {{ $data->nama }}
                                       </h6>
                                    </a>
                                 </td>
                                 <td>
                                    {{ $data->email }}
                                 </td>
                                 <td>
                                    @if ($data->status == 'pending')
                                       <div class="badge badge-primary text-capitalize">
                                          Pending
                                       </div>
                                    @elseif($data->status == 'allowed')
                                       <div class="badge badge-success text-capitalize">
                                          Setujui
                                       </div>
                                    @endif
                                 </td>
                                 <td>
                                    <div class="dropdown d-inline mr-2">
                                       <button class="btn btn-outline-primary dropdown-toggle" type="button"
                                          id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                          aria-expanded="false">
                                          <i class="fas fa-cog"></i>
                                       </button>
                                       <div class="dropdown-menu">
                                          <div style="cursor: pointer" class="dropdown-item"
                                             wire:click.prevent="verify('{{ $data->id }}')">
                                             Setujui
                                          </div>
                                          <div style="cursor: pointer" class="dropdown-item"
                                             wire:click.prevent="pending('{{ $data->id }}')">
                                             Pending
                                          </div>
                                          <div style="cursor: pointer" class="dropdown-item"
                                             wire:click.prevent="confirmDelete('{{ $data->id }}')">
                                             Hapus
                                          </div>
                                       </div>
                                    </div>
                                 </td>
                              </tr>
                           @endforeach
                        </tbody>
                        @if ($datas->count() >= 10)
                           <tfoot>
                              <tr>
                                 <td colspan="40">
                                    {{ $datas->links() }}
                                 </td>
                              </tr>
                           </tfoot>
                        @endif
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- Modal -->
   <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">
                  Kritik & Saran
               </h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               @if ($selectedData != null)
                  <div class="table-responsive">
                     <table class="table table-striped">
                        <tbody>
                           <tr>
                              <th width="200px">Nama</th>
                              <td>
                                 {{ $selectedData->nama }}
                              </td>
                           </tr>
                           <tr>
                              <th>Email</th>
                              <td>
                                 {{ $selectedData->email }}
                              </td>
                           </tr>
                           <tr>
                              <th>Kritik & Saran</th>
                              <td>
                                 <div style="white-space: pre-line">{!! $selectedData->content !!}</div>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               @endif
            </div>
         </div>
      </div>
   </div>

</div>
