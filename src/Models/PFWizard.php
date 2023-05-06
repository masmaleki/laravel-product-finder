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


     /**
     * Get the steps associated with the wizard.
     */
    public function steps()
    {
        return $this->hasMany(PFStep::class);

    }

     /**
     * Get the forms associated with the wizard.
     */
    public function forms()
    {
        return $this->hasMany(PFForm::class);
    }
}
