<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barrio;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
 

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $barrios = Barrio::whereNotNull('latitude')->whereNotNull('longitude')->get();
        return view('welcome', compact('barrios'));
    }
    
    
}
