<?php

namespace Masmaleki\LaravelProductFinder\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PFStep extends Model
{
    use HasFactory;

    protected $table = 'pf_steps';

    protected $guarded = [];

    protected $casts = [

    ];
}
