<?php

namespace App\Providers;

use App\Http\ViewComposers\Trends\TrendsComposer;
use Illuminate\Support\ServiceProvider;
use App\Models\RequestProduct;
use App\Models\Group;
use App\Models\Unit;
use Auth;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.app', function ($view){
            $view->with('units', Unit::all());
            $groups = Group::whereAdmin(Auth::user()->id)->whereStatus(1)->get();
            $view->with('groups', $groups);
        });

        view()->composer('layouts._notifications', function ($view) {

            $requestProducts = RequestProduct::whereMemberId(Auth::user()->id)->get();
            $notifications = [];
            foreach ($requestProducts as $requestProduct) {
                if (count($requestProduct->notification) != 0) {
                    foreach ($requestProduct->notification as $value) {
                        $notifications[] = $value;
                    }
                }
            }

            $view->with('notifications', $notifications);
        });

        \view()->composer(['partials.trends'], TrendsComposer::class);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}