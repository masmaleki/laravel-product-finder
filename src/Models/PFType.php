<?php

namespace Masmaleki\LaravelProductFinder\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PFType extends Model
{
    use HasFactory;

    protected $table = 'pf_types';

    protected $guarded = [];

    protected $casts = [

    ];
}
