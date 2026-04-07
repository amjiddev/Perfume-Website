<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class PerfumeController extends Controller
{
    public function shop()
    {
        return view('frontend.shop');
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function contact()
    {
        return view('frontend.contact');
    }
}
