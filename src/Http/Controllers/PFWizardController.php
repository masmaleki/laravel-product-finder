<?php

namespace Masmaleki\LaravelProductFinder\Http\Controllers;


use Intervention\Image\Facades\Image;
use YektaDG\Medialibrary\Jobs\ImageProcess;
use YektaDG\Medialibrary\Http\Models\ExtendedMedia as Media;
use YektaDG\Medialibrary\Facades\ExtendedMediaFacade as MediaUploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use YektaDG\Medialibrary\Jobs\DeleteMedia;

class PFWizardController extends Controller
{

    public function index(Request $request)
    {
        return view('productFinder::index');
    }

}
