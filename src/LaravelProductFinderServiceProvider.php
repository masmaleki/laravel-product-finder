<?php

namespace Masmaleki\LaravelProductFinder;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Masmaleki\LaravelProductFinder\Commands\LaravelProductFinderCommand;

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
            ->name('laravel-product-finder')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_product_finders_wizards_table')
            ->hasMigration('create_product_finders_steps_table')
            ->hasMigration('create_product_finders_questions_table')
            ->hasMigration('create_product_finders_options_table')
            ->hasMigration('create_product_finders_forms_table')
            ->hasMigration('create_product_finders_answers_table')
            ->hasCommand(LaravelProductFinderCommand::class);
    }
}
