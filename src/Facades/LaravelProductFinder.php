<?php

namespace Masmaleki\LaravelProductFinder\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Masmaleki\LaravelProductFinder\LaravelProductFinder
 */
class LaravelProductFinder extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Masmaleki\LaravelProductFinder\LaravelProductFinder::class;
    }
}
