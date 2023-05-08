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

    /**
     * Get the type options associated with the type.
     */
    public function typeOptions()
    {
        return $this->hasMany(PFTypeOption::class);
    }
}
