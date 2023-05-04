<?php

namespace Masmaleki\LaravelProductFinder;

use Illuminate\Support\Facades\Route;
use Masmaleki\LaravelProductFinder\Commands\LaravelProductFinderCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Illuminate\Support\ServiceProvider;

class LaravelProductFinderServiceProvider extends ServiceProvider
{
    // public function configurePackage(Package $package): void
    // {
    //     /*
    //      * This class is a Package Service Provider
    //      *
    //      * More info: https://github.com/spatie/laravel-package-tools
    //      */
    //     $package
    //         ->name('laravel-product-finder')
    //         ->hasConfigFile()
    //         ->hasViews()
    //         ->hasMigration('create_pf_wizards_table')
    //         ->hasMigration('create_pf_types_table')
    //         ->hasMigration('create_pf_type_option_table')
    //         ->hasMigration('create_pf_steps_table')
    //         ->hasMigration('create_pf_questions_table')
    //         ->hasMigration('create_pf_options_table')
    //         ->hasMigration('create_pf_forms_table')
    //         ->hasMigration('create_pf_answers_table')
    //         ->hasCommand(LaravelProductFinderCommand::class);
    // }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'productFinder');

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->registerRoutes();
        $this->publishes([
            __DIR__ . '/../resources/views/assets' => public_path('vendor/masmaleki/productfinder'),

        ], 'public');
    }
    protected function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        });
    }
    protected function routeConfiguration(): array
    {
        return [
            'prefix' => 'pf',
            // 'middleware' => config('medialibrary.middleware'),
        ];
    }
}
