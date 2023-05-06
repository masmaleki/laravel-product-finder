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

    /**
     * Get the wizard that owns the step.
     */
    public function wizard()
    {
        return $this->belongsTo(PFWizard::class, 'pf_wizard_id');

    }

    /**
     * Get the questions associated with the step.
     */
    public function questions()
    {
        return $this->hasMany(PFQuestion::class);
    }
}
