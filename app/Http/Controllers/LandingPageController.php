<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index(){
        return view('landing',[
            'title'=>'Landing Page',
            'events'=>Event::all(),
        ]);
    }
}
