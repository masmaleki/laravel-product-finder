<?php

namespace Masmaleki\LaravelProductFinder\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PFTypeOption extends Model
{
    use HasFactory;

    protected $table = 'pf_type_options';

    protected $guarded = [];

    protected $casts = [

    ];

    /**
     * Get the type that owns the option.
     */
    public function type()
    {
        return $this->belongsTo(PFType::class, 'pf_type_id');
    }
}
