<?php

namespace Masmaleki\LaravelProductFinder\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PFOption extends Model
{
    use HasFactory;

    protected $table = 'pf_options';

    protected $guarded = [];

    protected $casts = [

    ];
}
