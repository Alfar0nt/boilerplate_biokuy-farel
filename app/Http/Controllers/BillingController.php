<?php

namespace App\Http\Controllers;

use App\Enums\PlanEnum;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BillingController extends Controller
{
    /**
     * Display the billing page with plan comparison.
     */
    public function index(Request $request): View
    {
        $user = $request->user();

        return view('billing.index', [
            'user' => $user,
            'currentPlan' => $user->getActivePlan(),
            'plans' => PlanEnum::cases(),
            'activeSubscription' => $user->activeSubscription,
        ]);
    }
}
