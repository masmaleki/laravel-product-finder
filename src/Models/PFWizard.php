<?php

namespace Masmaleki\LaravelProductFinder\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PFWizard extends Model
{
    use HasFactory;

    protected $table = 'pf_wizards';

    protected $guarded = [];

    protected $casts = [

    ];
}
