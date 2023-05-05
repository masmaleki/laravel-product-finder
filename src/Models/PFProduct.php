<?php

namespace Masmaleki\LaravelProductFinder\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PFProduct extends Model
{
    use HasFactory;

    protected $table = 'pf_products';

    protected $guarded = [];

    protected $casts = [

    ];
}
