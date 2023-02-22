<?php

use Carbon\Carbon;
use App\Models\Settings\WebsIdentity;
use App\Models\Articles\Article;
use App\Models\Articles\ArticleType;
use App\Models\Articles\ArticleTags;
use App\Models\Articles\ArticleCategory;

$arrType = ArticleType::orderBy('name')->get();
$arrCategory = ArticleCategory::orderBy('name')->get();
$arrPengumuman = Article::where('type_id', '2')->orderBy('id', 'DESC')->paginate(5);

$identitas = WebsIdentity::find(1);

?>
<div class="col-lg-4">
    <div class="widget bg-secondary">
        <ul class="nav tab-style1 mb-25 text-uppercase">
            <li>
                <a style="font-size: 12px;" class="nav-link active" id="agenda-tab" data-toggle="tab" href="#agenda" aria-controls="agenda">Agenda</a>
            </li>
            <li>
                <a style="font-size: 12px;" class="nav-link" id="populer-tab" data-toggle="tab" href="#populer" aria-controls="populer">Berita Populer</a>
            </li>
            <li>
                <a style="font-size: 12px;" class="nav-link" id="pengumuman-tab" data-toggle="tab" href="#pengumuman" aria-controls="pengumuman">Pengumuman</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="agenda" role="tabpanel" aria-labelledby="agenda-tab">
                <div class="recent-post-style3 column-2-md">
                    @foreach ($arrAgenda as $agenda)
                    <div class="recent-post media">
                        <div class="media-img">
                            <img src="{{ asset('storage/images/thumbnail/small/' . $agenda->thumbnail) }}" alt="Recent Post Image">
                        </div>
                        <div class="media-body">
                            <div class="blog-meta style-slash text-xs">
                                <a href="#"><i class="far fa-eye" ></i>{{ $agenda->view }} Views</a>
                                <a href="#"><i class="fal fa-calendar-alt"></i>{{ Carbon::parse($agenda->created_at)->isoFormat('dddd, DD MMMM YYYY') }}</a>
                            </div>
                            <h4 class="recent-post-title h6 mb-0 "><a href="{{ route('public.articleDetail', $agenda->slug) }}">{{ $agenda->title }}</a></h4>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="tab-pane fade" id="populer" role="tabpanel" aria-labelledby="populer-tab">
                <div class="recent-post-style3 column-2-md">
                    @foreach ($arrPopuler as $populer)
                    <div class="recent-post media">
                        <div class="media-img">
                            <img src="{{ asset('storage/images/thumbnail/small/' . $populer->thumbnail) }}" alt="Recent Post Image">
                        </div>
                        <div class="media-body">
                            <div class="blog-meta style-slash text-xs">
                                <a href="#"><i class="far fa-eye" ></i>{{ $populer->view }} Views</a>
                                <a href="#"><i class="fal fa-calendar-alt"></i>{{ Carbon::parse($populer->created_at)->isoFormat('dddd, DD MMMM YYYY') }}</a>
                            </div>
                            <h4 class="recent-post-title h6 mb-0 "><a href="{{ route('public.articleDetail', $populer->slug) }}">{{ $populer->title }}</a></h4>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="tab-pane fade" id="pengumuman" role="tabpanel" aria-labelledby="pengumuman-tab">
                <div class="recent-post-style3 column-2-md">
                    @foreach ($arrPengumuman as $pengumuman)
                    <div class="recent-post media">
                        <div class="media-img">
                            <img src="{{ asset('storage/images/thumbnail/small/' . $pengumuman->thumbnail) }}" alt="Recent Post Image">
                        </div>
                        <div class="media-body">
                            <div class="blog-meta style-slash text-xs">
                                <a href="#"><i class="far fa-eye" ></i>{{ $pengumuman->view }} Views</a>
                                <a href="#"><i class="fal fa-calendar-alt"></i>{{ Carbon::parse($pengumuman->created_at)->isoFormat('dddd, DD MMMM YYYY') }}</a>
                            </div>
                            <h4 class="recent-post-title h6 mb-0 "><a href="{{ route('public.articleDetail', $pengumuman->slug) }}">{{ $pengumuman->title }}</a></h4>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div id="fb-root"></div>
    <div class="fb-page" data-href="https://www.facebook.com/bappedaoganilir" data-tabs="timeline" data-width="400" data-height="680" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/bappedaoganilir" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/bappedaoganilir">Bappeda Ogan Ilir</a></blockquote></div>
    </div>
</div>
