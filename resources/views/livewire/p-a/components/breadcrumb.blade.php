<?php

use Carbon\Carbon;

?>
<div>

   <div class="row mb-3">
      <div class="col-sm-12 col-md-7 col-lg-8 col-xl-8">
         <ol class="breadcrumb">
            <li class="breadcrumb-item">
               <a href="{{ route('admin.dashboard') }}" class="default">{{ env('APP_NAME') }}</a>
            </li>
            <li class="breadcrumb-item">
               <a href="{{ route('admin.dashboard') }}">
                  {{ __('Dashboard') }}
               </a>
            </li>
            @foreach ($bcs as $bc)
               @if ($loop->last != true)
                  <li class="breadcrumb-item">
                     <a href="{{ route($bc['route']) }}">
                        {{ $bc['title'] }}
                     </a>
                  </li>
               @elseif ($loop->last)
                  <li class="breadcrumb-item active" aria-current="page">
                     {{ $bc['title'] }}
                  </li>
               @endif
            @endforeach
         </ol>
      </div>
      <div class="col-sm-12 col-md-5 col-lg-4 col-xl-4 text-center">
         <span class="float-right">
            {{ Carbon::now()->isoFormat('dddd, D MMMM Y') }}
         </span>
      </div>
   </div>

</div>
