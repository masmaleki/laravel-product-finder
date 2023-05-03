<?php

namespace Masmaleki\LaravelProductFinder\Commands;

use Illuminate\Console\Command;

class LaravelProductFinderCommand extends Command
{
    public $signature = 'laravel-product-finder';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
