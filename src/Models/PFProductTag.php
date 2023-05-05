<?php

namespace Masmaleki\LaravelProductFinder\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PFProductTag extends Model
{
    use HasFactory;

    protected $table = 'pf_product_tags';

    protected $guarded = [];

    protected $casts = [

    ];
}
