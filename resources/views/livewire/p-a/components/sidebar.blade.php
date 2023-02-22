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
                @canany(['dev', 'super-admin', 'admin'])
                <ul class="metismenu list-unstyled" id="side-menu">
                    <li class="menu-title">Menu</li>

                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="waves-effect"><i class="feather-airplay"></i><span
                                class="badge badge-pill badge-primary float-right">7</span><span>Dashboard</span></a>
                    </li>

                    <li class="
                        {{ Request::routeIs('admin.articles-index') ? 'mm-active' : '' }}
                        {{ Request::routeIs('admin.articles-create') ? 'mm-active' : '' }}
                        {{ Request::routeIs('admin.articles-edit') ? 'mm-active' : '' }}
                    ">
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="feather-copy"></i><span>Artikel</span></a>
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

                    <li class="
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
                    <li class="
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
                    <li class="
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

                </ul>
                @endcanany
            </div>
            <!-- Sidebar -->
        </div>
    </div>
</div>
