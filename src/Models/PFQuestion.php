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


    /**
     * Get the step that owns the question.
     */
    public function step()
    {
        return $this->belongsTo('App\Models\PFStep', 'pf_step_id');
    }

    /**
     * Get the type option that owns the question.
     */
    public function typeOption()
    {
        return $this->belongsTo(PFTypeOption::class, 'pf_type_option_id');
    }

    /**
     * Get the options for the question.
     */
    public function options()
    {
        return $this->hasMany(PfOption::class);
    }
}
