<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Pagination\Paginator;
use App\Http\Composers\CategoryComposer;

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
        View::composer('components.header', CategoryComposer::class);
        View::composer('components.header', function ($view) {
            $keyword = request()->get('keyword', '');
            $view->with('keyword', $keyword);
        });
        if (App::environment(['production'])) {
            URL::forceScheme('https');
        }
    }
}
