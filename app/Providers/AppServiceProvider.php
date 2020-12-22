<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\UrlGenerator;

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
     * @param UrlGenerator $url
     * @return void
     */
    public function boot(UrlGenerator $url)
    {
        $url->forceScheme('https');

        if (Schema::hasTable('categories')) {
            $categories = Category::all();
            view()->share('categories', $categories);
        }
    }
}
