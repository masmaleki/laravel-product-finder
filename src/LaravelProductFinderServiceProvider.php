<?php

namespace Masmaleki\LaravelProductFinder;

use Masmaleki\LaravelProductFinder\Commands\LaravelProductFinderCommand;
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
            ->name('laravel-product-finder')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_pf_wizards_table')
            ->hasMigration('create_pf_types_table')
            ->hasMigration('create_pf_type_option_table')
            ->hasMigration('create_pf_steps_table')
            ->hasMigration('create_pf_questions_table')
            ->hasMigration('create_pf_options_table')
            ->hasMigration('create_pf_forms_table')
            ->hasMigration('create_pf_answers_table')
            ->hasCommand(LaravelProductFinderCommand::class);
    }
}
