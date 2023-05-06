<?php

namespace Masmaleki\LaravelProductFinder\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PFAnswer extends Model
{
    use HasFactory;

    protected $table = 'pf_answers';

    protected $guarded = [];

    protected $casts = [

    ];

    /**
     * Get the question that owns the answer.
     */
    public function question()
    {
        return $this->belongsTo(PfQuestion::class, 'pf_question_id');
    }

    /**
     * Get the form that owns the answer.
     */
    public function form()
    {
        return $this->belongsTo(PfForm::class, 'pf_form_id');
    }
}
