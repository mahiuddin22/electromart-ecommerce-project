<?php

namespace App\Providers;

use App\Models\Admin\Admin;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\SiteSettings;
use App\Models\Slider;
use Illuminate\Support\ServiceProvider;
use View;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        View::share('categories', $categories = Category::all());
        View::share('limitcategories', $limitcategories = Category::take(2)->inRandomOrder()->get());
        View::share('settings', $settings = SiteSettings::latest()->first());
        View::share('sliders', $sliders = Slider::where('status', 1)->get());
        View::share('admin', $admin = Admin::latest()->first());
    }
}
