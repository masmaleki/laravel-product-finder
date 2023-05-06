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

    /**
     * Get the wizard that owns the form.
     */
    public function wizard()
    {
        return $this->belongsTo(PFWizard::class, 'pf_wizard_id');
    }

    /**
     * Get the product that owns the form.
     */
    public function product()
    {
        return $this->belongsTo(PfProduct::class, 'product_id');
    }

    /**
     * Get the answers for the form.
     */
    public function answers()
    {
        return $this->hasMany(PfAnswer::class);
    }
}
