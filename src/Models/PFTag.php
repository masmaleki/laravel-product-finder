<?php

namespace Masmaleki\LaravelProductFinder\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PFTag extends Model
{
    use HasFactory;

    protected $table = 'pf_tags';

    protected $guarded = [];

    protected $casts = [

    ];
}
