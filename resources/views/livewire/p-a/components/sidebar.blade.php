<div>
    <div class="vertical-menu">

        <div data-simplebar class="h-100">

            <div class="navbar-brand-box">
                <a href="{{ route('admin.dashboard') }}" class="logo">
                    <i class="mdi mdi-alpha-h-circle"></i>
                    <span>
                        DASHBOARD
                    </span>
                </a>
            </div>

            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <!-- Left Menu Start -->
                <ul class="metismenu list-unstyled" id="side-menu">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="waves-effect"><i class="feather-airplay"></i><span>Dashboard</span></a>
                    </li>

                    @canany(['dev', 'super-admin'])
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="feather-copy"></i><span>Master Data</span></a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li class="
                                {{ Request::routeIs('admin.master-data.wilayah') ? 'active' : '' }}
                            ">
                                <a href="{{ route('admin.master-data.wilayah') }}">Wilayah</a>
                            </li>
                            <li class="
                                {{ Request::routeIs('admin.master-data.kategori') ? 'active' : '' }}
                            ">
                                <a href="{{ route('admin.master-data.kategori') }}">Kategori</a>
                            </li>
                            <li class="
                                {{ Request::routeIs('admin.master-data.jenis') ? 'active' : '' }}
                            ">
                                <a href="{{ route('admin.master-data.jenis') }}">Jenis</a>
                            </li>
                            {{-- <li class="
                                {{ Request::routeIs('admin.articles-tags-index') ? 'active' : '' }}
                            ">
                                <a href="{{ route('admin.articles-tags-index') }}">Tahun Anggaran</a>
                            </li> --}}
                        </ul>
                    </li>
                    @endcanany

                    <li class="menu-title">Pengaduan</li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="mdi mdi-email-mark-as-unread"></i><span>Pengaduan</span></a>
                        <ul class="sub-menu" aria-expanded="false">
                            @canany(['dev', 'super-admin', 'admin'])
                            <li class="
                                {{ Request::routeIs('admin.pengaduan.index') ? 'active' : '' }}
                                ">
                                <a href="{{ route('admin.pengaduan.index') }}">Daftar Pengaduan</a>
                            </li>
                            @endcanany
                            @canany(['dev', 'super-admin', 'admin', 'inspektur'])
                            <li class="
                                {{ Request::routeIs('admin.pengaduan.disposisi.index') ? 'active' : '' }}
                            ">
                            <a href="{{ route('admin.pengaduan.disposisi.index') }}">Disposisi Pengaduan</a>
                            </li>
                            @endcanany
                            @canany(['dev', 'super-admin', 'admin', 'irban'])
                            <li class="
                                {{ Request::routeIs('admin.pengaduan.verifikasi.index') ? 'active' : '' }}
                            ">
                                <a href="{{ route('admin.pengaduan.verifikasi.index') }}">Verifikasi Pengaduan</a>
                            </li>
                            @endcanany
                        </ul>
                    </li>

                    <li class="menu-title">Tata Naskah Surat</li>

                    <li class="
                        {{ Request::routeIs('admin.surat-tugas') ? 'mm-active' : ''}}
                    ">
                        <a href="{{ route('admin.surat-tugas') }}" class="waves-effect
                            {{ Request::routeIs('admin.surat-tugas') ? 'active' : ''}}
                        ">
                        <i class="mdi mdi-email-mark-as-unread"></i><span>Surat Tugas</span></a>
                    </li>

                    @canany(['dev', 'super-admin'])
                    <li hidden class="menu-title">Menu Frontend</li>

                    <li hidden class="
                        {{ Request::routeIs('admin.articles-index') ? 'mm-active' : '' }}
                        {{ Request::routeIs('admin.articles-create') ? 'mm-active' : '' }}
                        {{ Request::routeIs('admin.articles-edit') ? 'mm-active' : '' }}
                    ">
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="mdi mdi-file-table"></i><span>Artikel</span></a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li>
                                <a href="{{ route('admin.articles-index') }}" class="
                                    {{ Request::routeIs('admin.articles-index') ? 'active' : '' }}
                                    {{ Request::routeIs('admin.articles-create') ? 'active' : '' }}
                                    {{ Request::routeIs('admin.articles-edit') ? 'active' : '' }}
                                ">Daftar Artikel</a>
                            </li>
                            <li class="
                                {{ Request::routeIs('admin.articles-type-index') ? 'active' : '' }}
                            ">
                                <a href="{{ route('admin.articles-type-index') }}">Jenis Artikel</a>
                            </li>
                            <li class="
                                {{ Request::routeIs('admin.articles-category-index') ? 'active' : '' }}
                            ">
                                <a href="{{ route('admin.articles-category-index') }}">Kategori Artikel</a>
                            </li>
                            <li class="
                                {{ Request::routeIs('admin.articles-tags-index') ? 'active' : '' }}
                            ">
                                <a href="{{ route('admin.articles-tags-index') }}">Tags Artikel</a>
                            </li>
                        </ul>
                    </li>

                    <li hidden class="
                        {{ Request::routeIs('admin.page-index') ? 'mm-active' : ''}}
                        {{ Request::routeIs('admin.page-edit') ? 'mm-active' : ''}}
                        {{ Request::routeIs('admin.page-create') ? 'mm-active' : ''}}
                    ">
                        <a href="{{ route('admin.page-index') }}" class="waves-effect
                            {{ Request::routeIs('admin.page-index') ? 'active' : ''}}
                            {{ Request::routeIs('admin.page-edit') ? 'active' : ''}}
                            {{ Request::routeIs('admin.page-create') ? 'active' : ''}}
                        ">
                        <i class="feather-calendar"></i><span>Halaman</span></a>
                    </li>

                    {{-- Media --}}
                    <li hidden class="
                        {{ Request::routeIs('admin.videos-index') ? 'mm-active' : '' }}
                        {{ Request::routeIs('admin.gallery-create') ? 'mm-active' : '' }}
                        {{ Request::routeIs('admin.gallery-edit') ? 'mm-active' : '' }}
                    ">
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="feather-copy"></i><span>Media</span></a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li>
                                <a href="{{ route('admin.gallery-index') }}" class="
                                    {{ Request::routeIs('admin.gallery-index') ? 'active' : '' }}
                                    {{ Request::routeIs('admin.gallery-create') ? 'active' : '' }}
                                    {{ Request::routeIs('admin.gallery-edit') ? 'active' : '' }}
                                ">gallery</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.videos-index') }}" class="
                                    {{ Request::routeIs('admin.videos-index') ? 'active' : '' }}
                                    {{ Request::routeIs('admin.videos-create') ? 'active' : '' }}
                                    {{ Request::routeIs('admin.videos-edit') ? 'active' : '' }}
                                ">Video</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.download-index') }}" class="
                                    {{ Request::routeIs('admin.download-index') ? 'active' : '' }}
                                    {{ Request::routeIs('admin.download-create') ? 'active' : '' }}
                                    {{ Request::routeIs('admin.download-edit') ? 'active' : '' }}
                                ">Download</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.surat.index') }}" class="
                                    {{ Request::routeIs('admin.surat.index') ? 'active' : '' }}
                                ">Surat kunjungan kerja</a>
                            </li>
                        </ul>
                    </li>

                    {{-- Pengaturan --}}
                    <li hidden class="
                        {{ Request::routeIs('admin.videos-index') ? 'mm-active' : '' }}
                        {{ Request::routeIs('admin.gallery-create') ? 'mm-active' : '' }}
                        {{ Request::routeIs('admin.gallery-edit') ? 'mm-active' : '' }}
                    ">
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="feather-settings"></i><span>Pengaturan</span></a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li>
                                <a href="{{ route('admin.settings-website-identity') }}" class="
                                    {{ Request::routeIs('admin.settings-website-identity') ? 'active' : '' }}
                                ">Informasi Website</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.settings-menus') }}" class="
                                    {{ Request::routeIs('admin.settings-menus') ? 'active' : '' }}
                                ">Menu</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.settings-banners') }}" class="
                                    {{ Request::routeIs('admin.settings-banners') ? 'active' : '' }}
                                ">Banners</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.settings-link') }}" class="
                                    {{ Request::routeIs('admin.settings-link') ? 'active' : '' }}
                                ">Link Terkait</a>
                            </li>
                        </ul>
                    </li>

                    <li hidden class="
                        {{ Request::routeIs('admin.users-index') ? 'mm-active' : ''}}
                    ">
                        <a href="{{ route('admin.users-index') }}" class="waves-effect
                            {{ Request::routeIs('admin.users-index') ? 'active' : ''}}
                        ">
                        <i class="feather-calendar"></i><span>Akun</span></a>
                    </li>
                    @endcanany
                </ul>
            </div>
            <!-- Sidebar -->
        </div>
    </div>
</div>
