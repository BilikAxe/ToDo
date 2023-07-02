<?php

namespace App\Providers;

use App\Services\ImageService;
use App\Services\TagService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(TagService::class, function() {
            return new TagService();
        });

        $this->app->bind(ImageService::class, function() {
            return new ImageService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
