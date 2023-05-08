<?php

namespace Masmaleki\LaravelProductFinder\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PFProduct extends Model
{
    use HasFactory;

    protected $table = 'pf_products';

    protected $guarded = [];

    protected $casts = [

    ];

    /**
     * The tags that belong to the product.
     */
    public function tags()
    {
        return $this->belongsToMany(PfTag::class, 'pf_product_tags', 'pf_product_id', 'pf_tag_id');
    }

    /**
     * Get the form that owns the product.
     */
    public function form()
    {
        return $this->belongsTo(PfForm::class, 'product_id');
    }
}
