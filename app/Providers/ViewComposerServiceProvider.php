<?php

namespace App\Providers;

use Cart;
use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Auth;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('site.partials.nav', function ($view) {
            $view->with('categories', Category::orderByRaw('-name ASC')->get()->nest());
        });

        View::composer('frontend.pages.homepage', function ($view) {
            $view->with('categories', Category::orderByRaw('-name ASC')->get()->nest());
        });
        
        View::composer('frontend.partials.header2', function ($view) {
            $view->with('cartCount', Cart::getContent()->count());
        });

        View::composer('admin.partials.header', function ($view) {
            $view->with('countnotifications', auth()->user()->unreadNotifications->count());
            $view->with('notifications', Auth::user()->unreadNotifications()->take(5)->get());
        });

        View::composer('admin.dashboard.index', function ($view) {
            $view->with('countnotifications', auth()->user()->unreadNotifications->count());
        });
    }
}
