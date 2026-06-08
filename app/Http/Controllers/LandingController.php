<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class LandingController extends Controller
{
    /**
     * Display the landing page.
     */
    public function index(): View
    {
        return view('landing');
    }

    /**
     * Show deployment documentation page.
     */
    public function deployment(): View
    {
        return view('deployment');
    }
}
