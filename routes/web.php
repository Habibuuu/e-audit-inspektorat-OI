<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['visitors'])->group(function () {
    // Route::get('/', App\Http\Livewire\Public\Home\Portal::class)->name('public.portal');
    // Route::get('/', App\Http\Livewire\Public\Home\Portal::class)->name('public.portal-new');
    // Route::get('/', App\Http\Livewire\Public\Home\Landing::class)->name('public.landing');
    Route::get('/', App\Http\Livewire\Public\Home\Index::class)->name('public.index');
    Route::get('/artikel', App\Http\Livewire\Public\Article\Index::class)->name('public.articleIndex');
    Route::get('/artikel/{slug}', App\Http\Livewire\Public\Article\Detail::class)->name('public.articleDetail');
    // Route::get('/layanan', App\Http\Livewire\Public\Layanan\Index::class)->name('public.layanan-index');
    // Route::get('/layanan/{slug}', App\Http\Livewire\Public\Layanan\Category::class)->name('public.layanan-category');
    Route::get('/mtq-2022', App\Http\Livewire\Public\Event\Mtq2022::class)->name('public.mtq-2022');

    // PAGE
    Route::get('/page', App\Http\Livewire\Public\Page\Index::class)->name('public.page-index');
    Route::get('/page/{slug}', App\Http\Livewire\Public\Page\Detail::class)->name('public.page-detail');

    // Videos
    Route::get('/videos/{slug}', App\Http\Livewire\Public\Videos\Detail::class)->name('public.videosDetail');
    Route::get('/videos', App\Http\Livewire\Public\Videos\Index::class)->name('public.videosIndex');

    // Gallery
    Route::get('/gallery', App\Http\Livewire\Public\Gallery\Index::class)->name('public.galleryIndex');
    Route::get('/gallery/{slug}', App\Http\Livewire\Public\Gallery\Detail::class)->name('public.galleryDetail');

    // Download
    Route::get('/download', App\Http\Livewire\Public\Download\Index::class)->name('public.downloadIndex');

    //Contact
    Route::get('/contact', App\Http\Livewire\Public\Contact\Create::class)->name('public.contactCreate');
    Route::get('/contact/detail', App\Http\Livewire\Public\Contact\Detail::class)->name('public.contactDetail');

    //Kontak
    Route::get('/kontak', App\Http\Livewire\Public\Kontak\Index::class)->name('public.kontak-index');

    //Captcha
    Route::get('/reload-captcha', [App\Http\Livewire\Public\Contact\Create::class, 'reloadCaptcha'])->name('public.reloadCaptcha');

    // kirim surat
    Route::get('/kirim-surat', App\Http\Livewire\Public\Surat\Create::class)->name('public.surat.create');
});

Route::prefix('panel-admin')->group(function () {
    Route::get('login', App\Http\Livewire\Auth\Login::class)->name('admin.login');
    Route::get('logout', App\Http\Livewire\Auth\Logout::class)->name('admin.logout');

    Route::middleware(['panel-admin'])->group(function () {
        // DASHBOARD
        Route::get('/', App\Http\Livewire\PA\Dashboard::class)->name('admin.dashboard');

        // MASTER DATA WILAYAH
        Route::get('/master-data/wilayah', App\Http\Livewire\PA\MasterData\Wilayah::class)->name('admin.master-data.wilayah');
        // MASTER DATA KATEGORI
        Route::get('/master-data/kategori', App\Http\Livewire\PA\MasterData\Kategori::class)->name('admin.master-data.kategori');
        // MASTER DATA JENIS
        Route::get('/master-data/jenis', App\Http\Livewire\PA\MasterData\Jenis::class)->name('admin.master-data.jenis');

        // PENGADUAN
        Route::get('/pengaduan', App\Http\Livewire\PA\Pengaduan\Index::class)->name('admin.pengaduan.index');
        Route::get('/pengaduan/create', App\Http\Livewire\PA\Pengaduan\Create::class)->name('admin.pengaduan.create');
        Route::get('/pengaduan/detail/{id}', App\Http\Livewire\PA\Pengaduan\Detail::class)->name('admin.pengaduan.detail');

        // DISPOSISI PENGADUAN
        Route::get('/pengaduan/disposisi', App\Http\Livewire\PA\Pengaduan\Disposisi\Index::class)->name('admin.pengaduan.disposisi.index');
        Route::get('/pengaduan/disposisi/detail/{id}', App\Http\Livewire\PA\Pengaduan\Disposisi\Detail::class)->name('admin.pengaduan.disposisi.detail');

        // DISPOSISI PENGADUAN
        Route::get('/pengaduan/verifikasi', App\Http\Livewire\PA\Pengaduan\Verifikasi\Index::class)->name('admin.pengaduan.verifikasi.index');
        Route::get('/pengaduan/verifikasi/detail/{id}', App\Http\Livewire\PA\Pengaduan\Verifikasi\Detail::class)->name('admin.pengaduan.verifikasi.detail');

        // LIST SURAT MASUK
        Route::get('/surat-tugas', App\Http\Livewire\PA\SuratTugas\Index::class)->name('admin.surat-tugas');


        // ARTICLES
        Route::get('/articles', App\Http\Livewire\PA\Articles\Index::class)->name('admin.articles-index');
        Route::get('/articles/create', App\Http\Livewire\PA\Articles\Create::class)->name('admin.articles-create');
        Route::get('/articles/edit/{id}', App\Http\Livewire\PA\Articles\Edit::class)->name('admin.articles-edit');

        // PAGES
        Route::get('/page', App\Http\Livewire\PA\Page\Index::class)->name('admin.page-index');
        Route::get('/page/create', App\Http\Livewire\PA\Page\Create::class)->name('admin.page-create');
        Route::get('/page/edit/{id}', App\Http\Livewire\PA\Page\Edit::class)->name('admin.page-edit');

        // INFOGRAPHICS
        Route::get('/infographics', App\Http\Livewire\PA\Infographics\Index::class)->name('admin.infographics-index');

        // Gallery
        Route::get('/gallery', App\Http\Livewire\PA\Gallery\Index::class)->name('admin.gallery-index');
        Route::get('/gallery/create', App\Http\Livewire\PA\Gallery\Create::class)->name('admin.gallery-create');
        Route::get('/gallery/edit/{id}', App\Http\Livewire\PA\Gallery\Edit::class)->name('admin.gallery-edit');

        // VIDEOS
        Route::get('/videos', App\Http\Livewire\PA\Videos\Index::class)->name('admin.videos-index');

        // ARTICLES CATEGORY
        Route::get('/articles-category', App\Http\Livewire\PA\ArticlesCategory\Index::class)->name('admin.articles-category-index');
        // ARTICLES TYPE
        Route::get('/articles-types', App\Http\Livewire\PA\ArticlesType\Index::class)->name('admin.articles-type-index');
        // ARTICLES TAGS
        Route::get('/articles-tags', App\Http\Livewire\PA\ArticlesTags\Index::class)->name('admin.articles-tags-index');

        // DOWNLOAD
        Route::get('/download', App\Http\Livewire\PA\Download\Index::class)->name('admin.download-index');

        // SUGGESTIONS
        Route::get('/suggestions', App\Http\Livewire\PA\Suggestions\Index::class)->name('admin.suggestion-index');

        // Surat Kunjungan
        Route::get('/surat-kunjungan', App\Http\Livewire\PA\Surat\Index::class)->name('admin.surat.index');

        // SUPERADMIN ONLY
        Route::middleware(['can:super-admin'])->group(function () {
            // WEBSITE IDENTITY
            Route::get('/settings/web-identity', App\Http\Livewire\PA\WebsiteIdentity\Edit::class)
                ->name('admin.settings-website-identity');
            // WEBSITE STYLE
            Route::get('/settings/web-style', App\Http\Livewire\PA\WebsiteStyle\Edit::class)
                ->middleware('can:dev')
                ->name('admin.settings-website-style');
            // MENUS
            Route::get('/settings/menus', App\Http\Livewire\PA\Menus\Index::class)
                ->name('admin.settings-menus');
            // MENU PORTALS
            Route::get('/settings/portal', App\Http\Livewire\PA\MenusPortal\Index::class)
                ->name('admin.settings-portal');
            // BANNERS
            Route::get('/settings/banner', App\Http\Livewire\PA\Banners\Index::class)
                ->name('admin.settings-banners');
            // LINKS
            Route::get('/settings/link', App\Http\Livewire\PA\Links\Index::class)
                ->name('admin.settings-link');

            // USERS
            Route::get('/users', App\Http\Livewire\PA\Users\Index::class)
                ->name('admin.users-index');
            });
        });

        Route::get('/me', App\Http\Livewire\PA\Users\Me::class)
            ->name('admin.me');
});
