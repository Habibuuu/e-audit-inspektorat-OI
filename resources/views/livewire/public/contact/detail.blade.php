<?php

use Carbon\Carbon;
use Illuminate\Support\Str;

?>
{{-- @push('pageName')
    {{ $data->title }} |
@endpush --}}
<div>
    <section class="wrapper bg-light">
        <div class="container py-2 py-md-2">
            <div class="row gx-lg-8 gx-xl-12">
                <div class="col-lg-8">
                    <div class="blog single">
                        <div class="card">
                            <center>
                                {{-- <h6 class="h1 m-4">{{ $data->title }}</h6> --}}
                            </center>
                            <figure class="card img-fluid">
                                {{-- <img src="{{ asset('storage/images/thumbnail/original/' . $data->thumbnail) }}"
                                    alt="" /> --}}
                            </figure>
                            <div class="card-body">
                                <div class="classic-view">
                                    <article class="post">
                                        <div class="post-content mb-5">
                                            <div class="post-meta">
                                                <ul class="post-meta d-flex mb-0">
                                                    {{-- <li class="post-date"><i
                                                            class="uil uil-calendar-alt"></i><small>{{ Carbon::parse($data->created_at)->isoFormat('dddd, DD MMMM YYYY') }}</small>
                                                    </li> --}}
                                                    {{-- <li class="post-author"><a href="#"><i
                                                                class="uil uil-user"></i><small>{{ $data->Author->fullname }}</small></a>
                                                    </li> --}}
                                                    <li class="post-likes">
                                                        {{-- <a href="#">
                                                            <small><i
                                                                    class="uil uil-file"></i>{{ $data->Type->name }}</small>
                                                        </a> --}}
                                                    </li>
                                                </ul>
                                            </div>
                                            {{-- <div class="py-3">
                                                {!! $data->content !!}
                                            </div> --}}
                                        </div>
                                        <!-- /.post-content -->
                                        <div
                                            class="post-footer d-md-flex flex-md-row justify-content-md-between align-items-center mt-8">
                                            <div>
                                                <ul class="list-unstyled tag-list mb-0">
                                                    <li>
                                                        {{-- @foreach ($data->getTags as $tag)
                                                            <a href="#"
                                                                class="btn btn-soft-ash btn-sm rounded-pill mb-0">{{ $tag->name }}</a>
                                                            @if (!$loop->last)
                                                            @endif
                                                        @endforeach --}}
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="mb-0 mb-md-2">
                                                <div class="dropdown share-dropdown btn-group">
                                                    <button
                                                        class="btn btn-sm btn-red rounded-pill btn-icon btn-icon-start dropdown-toggle mb-0 me-0"
                                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i class="uil uil-share-alt"></i> Share </button>
                                                    <div class="dropdown-menu">
                                                        @push('script')
                                                            <script async defer crossorigin="anonymous" src="https://connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v13.0"
                                                                                                                        nonce="TV5iuEd8"></script>
                                                        @endpush
                                                        {{-- <a class="dropdown-item"
                                                            href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2F127.0.0.1%3A8000%2Fartikel%2F{{ $data->slug }}&amp;src=sdkpreparse"><i
                                                                class="uil uil-facebook-f"></i>Facebook</a> --}}
                                                    </div>
                                                    <!--/.dropdown-menu -->
                                                </div>
                                                <!--/.share-dropdown -->
                                            </div>
                                        </div>
                                        <!-- /.post-footer -->
                                    </article>
                                    <!-- /.post -->
                                </div>
                                <!-- /.classic-view -->
                                <hr />
                                <h3 class="mb-3">Would you like to share your thoughts?</h3>
                                <p class="mb-7">Your email address will not be published. Required fields are
                                    marked *</p>
                                <form class="comment-form">
                                    <div class="form-floating mb-4">
                                        <input type="text" class="form-control" placeholder="Name*" id="c-name">
                                        <label for="c-name">Name *</label>
                                    </div>
                                    <div class="form-floating mb-4">
                                        <input type="email" class="form-control" placeholder="Email*" id="c-email">
                                        <label for="c-email">Email*</label>
                                    </div>
                                    <div class="form-floating mb-4">
                                        <input type="text" class="form-control" placeholder="Website" id="c-web">
                                        <label for="c-web">Website</label>
                                    </div>
                                    <div class="form-floating mb-4">
                                        <textarea name="textarea" class="form-control" placeholder="Comment" style="height: 150px"></textarea>
                                        <label>Comment *</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary rounded-pill mb-0">Submit</button>
                                </form>
                                <!-- /.comment-form -->
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.blog -->
                </div>
                <!-- /column -->
                <aside class="col-lg-4 sidebar mt-11 mt-lg-6">
                    <livewire:public.component.sidebar>
                </aside>
                <!-- /column .sidebar -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>

</div>
