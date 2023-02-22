<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Visitors;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisitorsMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role_id != '4') {
            $tipe = 'Admin';
        } else {
            $tipe = 'Public';
            $agent = new Agent();

            $referal = request()->headers->get('referer');
            $ip_address = request()->ip();
            $url = url()->full();
            $date = date("Y-m-d");
            $os = $agent->platform();
            $device = $agent->device();
            $browser = $agent->browser();
            $country = 'kosong';
            $country_code = 'kosong';

            $visitors = new Visitors();
            $visitors->ip_address = $ip_address;
            $visitors->date = $date;
            $visitors->url = $url;
            $visitors->referal = $referal;
            $visitors->os = $os;
            $visitors->device = $device;
            $visitors->browser = $browser;
            $visitors->country = $country;
            $visitors->country_code = $country_code;
            $visitors->tipe = $tipe;
            $visitors->visit = "1";
            $visitors->save();
        }

        return $next($request);
    }
}
