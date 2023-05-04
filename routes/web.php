<?php

use Illuminate\Support\Facades\Route;
use Masmaleki\LaravelProductFinder\Http\Controllers\PFWizardController;

Route::prefix('/product-finder')->name('productfinder.')->controller(PFWizardController::class)->group(function () {
    Route::get('/', 'index')->name('all');
    
});
