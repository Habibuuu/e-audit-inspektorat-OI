<div>
   @push('page_title')
      {{ 'Tambah User | Panel Admin' }}
   @endpush

   <div class="section-header">
      <h1>Tambah User</h1>
      <div class="section-header-breadcrumb">
         <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
         <div class="breadcrumb-item active"><a href="{{ route('admin.users-index') }}">Users</a></div>
         <div class="breadcrumb-item">Tambah User</div>
      </div>
   </div>
   <div class="section-body">
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-body">
                  <form wire:submit.prevent="store">
                     @csrf
                     <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" wire:model.defer="nama_lengkap"
                           class="form-control @error('nama_lengkap') is-invalid @enderror"
                           placeholder="Masukkan Nama Lengkap" value="{{ $nama_lengkap }}" autocomplete="new-name">
                        @error('nama_lengkap')
                           <span class="invalid-feedback">
                              {{ $message }}
                           </span>
                        @enderror
                     </div>
                     <div class="form-group">
                        <label>Email</label>
                        <input type="email" wire:model.defer="email"
                           class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan Email"
                           value="{{ $email }}" autocomplete="new-email">
                        @error('email')
                           <span class="invalid-feedback">
                              {{ $message }}
                           </span>
                        @enderror
                     </div>
                     <div class="form-group">
                        <label>Username</label>
                        <input type="text" wire:model.defer="username"
                           class="form-control @error('username') is-invalid @enderror" placeholder="Masukkan Username"
                           value="{{ $username }}" autocomplete="new-username">
                        @error('username')
                           <span class="invalid-feedback">
                              {{ $message }}
                           </span>
                        @enderror
                     </div>
                     <div class="row">
                        <div class="col-md-3">
                           <div class="form-group" wire:ignore>
                              <label>Photo Profile</label>
                              <div id="image-preview" class="image-preview" style="width:100%; min-height:250px;">
                                 <label for="image-upload" id="image-label">Choose File</label>
                                 <input type="file" wire:model.defer="photo_profile" id="image-upload" />
                              </div>
                              <div wire:loading wire:target="photo_profile">Uploading...</div>
                           </div>
                           @error('photo_profile')
                              <span class="invalid-feedback d-block">
                                 {{ $message }}
                              </span>
                           @enderror
                        </div>
                        <div class="col-md-9">
                           <div class="form-group">
                              <label>Role</label>
                              <select wire:model.defer="role"
                                 class="form-control @error('role') is-invalid @enderror">
                                 <option hidden>-- Pilih Role --</option>
                                 @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                 @endforeach
                              </select>
                              @error('role')
                                 <span class="invalid-feedback">
                                    {{ $message }}
                                 </span>
                              @enderror
                           </div>
                           <div class="form-group">
                              <label>Password</label>
                              <input type="password" wire:model.defer="password"
                                 class="form-control @error('password') is-invalid @enderror"
                                 placeholder="Masukkan Password" autocomplete="new-password">
                              @error('password')
                                 <span class="invalid-feedback">
                                    {{ $message }}
                                 </span>
                              @enderror
                           </div>
                           <div class="form-group">
                              <label>Konfirmasi Password</label>
                              <input type="password" wire:model.defer="password_confirmation"
                                 class="form-control @error('password_confirmation') is-invalid @enderror"
                                 placeholder="Masukkan Konfirmasi Password" autocomplete="new-password_confirmation">
                              @error('password_confirmation')
                                 <span class="invalid-feedback">
                                    {{ $message }}
                                 </span>
                              @enderror
                           </div>
                        </div>

                     </div>
                     <div class="form-group">
                        <div class="text-right">
                           <a href="{{ route('admin.users-index') }}" class="btn btn-outline-warning"><i
                                 class="fa fa-arrow-left"></i> Kembali</a>
                           <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Simpan</button>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- <div wire:loading>
        <div class="loading-backdrop" id="submitLoading" style="display: block; z-index: 9999;">
            @include('admin.loading.image')
        </div> -->
</div>

@push('script')
   <script
      src="{{ URL::asset('admin_assets/node_modules/jquery_upload_preview/assets/js/jquery.uploadPreview.min.js') }}">
   </script>
   <script>
      $.uploadPreview({
         input_field: "#image-upload", // Default: .image-upload
         preview_box: ".image-preview", // Default: .image-preview
         label_field: "#image-label", // Default: .image-label
         label_default: "Choose File", // Default: Choose File
         label_selected: "Change File", // Default: Change File
         no_label: false, // Default: false
         success_callback: null // Default: null
      });
   </script>
@endpush

</div>
