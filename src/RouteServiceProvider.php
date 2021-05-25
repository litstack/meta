<?php

namespace Litstack\Meta;

use Carbon\CarbonInterval;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as LaravelRouteServiceProvider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Litstack\Meta\Models\Redirect;

class RouteServiceProvider extends LaravelRouteServiceProvider
{
    public function map()
    {
        $ttl = CarbonInterval::minutes(60)->totalMinutes;

        try {
            Cache::remember('lit.redirects', $ttl, function () {
                return Redirect::all();
            })->each(function (Redirect $redirect) {
                Route::redirect('/'.$redirect->old_url, '/'.$redirect->new_url, $redirect->status);
            });
        } catch (QueryException $e) {
        }
    }
}
