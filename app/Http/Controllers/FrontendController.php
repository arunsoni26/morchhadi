<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home()
    {
        return view('frontend.index');
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function products()
    {
        return view('frontend.products');
    }

    public function services()
    {
        return view('frontend.services');
    }

    public function shops()
    {
        return view('frontend.shops');
    }

}
