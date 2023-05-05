<?php

namespace Masmaleki\LaravelProductFinder\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PFQuestion extends Model
{
    use HasFactory;

    protected $table = 'pf_questions';

    protected $guarded = [];

    protected $casts = [

    ];
}
