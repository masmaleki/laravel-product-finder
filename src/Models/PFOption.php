<?php

namespace Masmaleki\LaravelProductFinder\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PFOption extends Model
{
    use HasFactory;

    protected $table = 'pf_options';

    protected $guarded = [];

    protected $casts = [

    ];

    /**
     * Get the question that owns the option.
     */
    public function question()
    {
        return $this->belongsTo(PfQuestion::class, 'pf_question_id');
    }

    /**
     * Get the type option that owns the option.
     */
    public function typeOption()
    {
        return $this->belongsTo(PFTypeOption::class, 'pf_type_option_id');
    }
}
