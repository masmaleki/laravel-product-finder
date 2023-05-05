<?php

namespace Masmaleki\LaravelProductFinder\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PFForm extends Model
{
    use HasFactory;

    protected $table = 'pf_forms';

    protected $guarded = [];

    protected $casts = [

    ];
}
