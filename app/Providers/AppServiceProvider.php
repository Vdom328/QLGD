<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        App::register('App\Classes\RepositoryProvider');
        App::register('App\Classes\ServiceProvider');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::component('input', \App\View\Components\Forms\Input::class);
        Blade::component('select', \App\View\Components\Forms\Select::class);
        Blade::component('textarea', \App\View\Components\Forms\TextArea::class);
        Blade::component('button', \App\View\Components\Forms\Button::class);
        Blade::component('select-dynamic', \App\View\Components\Forms\SelectDynamic::class);
        Blade::component('btn-link', \App\View\Components\Forms\BtnLink::class);
    }
}
