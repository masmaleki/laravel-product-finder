<?php

namespace Masmaleki\LaravelProductFinder;

use Illuminate\Support\Facades\Route;
use Masmaleki\LaravelProductFinder\Commands\LaravelProductFinderCommand;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelProductFinderServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('productfinder')
            ->hasConfigFile()
            ->hasViews('productfinder')
            ->hasMigrations([
                'create_pf_tags_table',
                'create_pf_products_table',
                'create_pf_product_tags_table',
                'create_pf_wizards_table',
                'create_pf_types_table',
                'create_pf_type_options_table',
                'create_pf_steps_table',
                'create_pf_questions_table',
                'create_pf_options_table',
                'create_pf_forms_table',
                'create_pf_answers_table',
            ])
            ->hasAssets()
            ->hasRoute('web')
            // ->hasViewComposer()
            // ->hasViewComponents()
            ->runsMigrations()
            ->hasCommand(LaravelProductFinderCommand::class)
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->startWith(function (InstallCommand $command) {
                        $command->info('Hello, and welcome to my great new package!');
                    })
                    ->publishConfigFile()
                    ->publishAssets()
                    ->publishMigrations()
                    // ->copyAndRegisterServiceProviderInApp()
                    // ->askToStarRepoOnGitHub()
                    ->endWith(function (InstallCommand $command) {
                        $command->info('Have a great day!');
                    });
            });
    }

    protected function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
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
