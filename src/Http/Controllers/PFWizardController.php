<?php

namespace Masmaleki\LaravelProductFinder\Http\Controllers;

use Illuminate\Http\Request;
use Masmaleki\LaravelProductFinder\Models\PFWizard;

class PFWizardController extends Controller
{
    public function index(Request $request)
    {
        //Todo:: fix this :for getting $wizard
        $pf_wizard = PFWizard::where('id', 1)->where('status', 'active')->first();
        if (isset($pf_wizard)) {
            $pf_steps = $pf_wizard->steps()->where('status', 'active')->orderBY('order')->get();
        }

        return view('productfinder::index', compact('pf_wizard', 'pf_steps'));
    }
}