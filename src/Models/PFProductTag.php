<?php

namespace Masmaleki\LaravelProductFinder\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PFProductTag extends Model
{
    use HasFactory;

    protected $table = 'pf_product_tags';

    protected $guarded = [];

    protected $casts = [

    ];

       /**
     * Get the tag that owns the product tag.
     */
    public function tag()
    {
        return $this->belongsTo(PfTag::class, 'pf_tag_id');
    }

    /**
     * Get the product that owns the product tag.
     */
    public function product()
    {
        return $this->belongsTo('App\Models\PfProduct', 'pf_product_id');
    }
}
