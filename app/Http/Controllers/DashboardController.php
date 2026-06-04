<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index(Request $request): View
    {
        $user = $request->user();

        return view('dashboard.index', [
            'user' => $user,
            'linksCount' => $user->links()->count(),
            'activeLinksCount' => $user->links()->active()->count(),
            'totalClicks' => $user->links()->sum('click_count'),
            'linkLimit' => $user->getLinkLimit(),
        ]);
    }
}
