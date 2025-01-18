<?php

namespace App\Providers;

use App\Services\NewsService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.app', function ($view) {
            $newsService = resolve(NewsService::class);
            $options = $newsService->getFormOptions();

            $view->with('authors', $options['authors']);
            $view->with('categories', $options['categories']);
        });

        View::composer('layouts.admin.app', function ($view) {
            $newsService = resolve(NewsService::class);
            $options = $newsService->getFormOptions();

            $view->with('authors', $options['authors']);
            $view->with('categories', $options['categories']);
        });

        View::composer('news.admin.show', function ($view) {
            $newsService = resolve(NewsService::class);
            $options = $newsService->getFormOptions();

            $view->with('authors', $options['authors']);
            $view->with('categories', $options['categories']);
        });
    }
}
