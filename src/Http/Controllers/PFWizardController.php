<?php

namespace Masmaleki\LaravelProductFinder\Http\Controllers;

use Illuminate\Http\Request;

class PFWizardController extends Controller
{
    public function index(Request $request)
    {
        return view('productfinder::index');
    }
}
