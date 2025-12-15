<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    /**
     * Display the landing page for guest users.
     */
    public function index()
    {
        return view('landing');
    }
}
