<?php

namespace App\Http\Controllers;

use App\Enums\PlanEnum;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    /**
     * Create a new checkout session for the given plan.
     */
    public function create(Request $request, string $plan): RedirectResponse
    {
        $planEnum = PlanEnum::tryFrom($plan);

        abort_unless($planEnum && $planEnum !== PlanEnum::Free, 404, 'Invalid plan.');

        // Simpan target plan ke session
        session(['checkout_target_plan' => $plan]);

        // Arahkan ke simulasi pembayaran
        return redirect()->route('checkout.simulation');
    }

    /**
     * Display the payment simulation page.
     */
    public function simulation(Request $request): View|RedirectResponse
    {
        $plan = session('checkout_target_plan');

        if (!$plan) {
            return redirect()->route('billing.index')->with('error', 'Silakan pilih paket langganan terlebih dahulu.');
        }

        $planEnum = PlanEnum::tryFrom($plan);
        $amount = $planEnum === PlanEnum::Pro ? 79000 : 29000;

        return view('checkout.simulation', [
            'plan' => $plan,
            'planLabel' => $planEnum->label(),
            'amount' => $amount,
        ]);
    }

    /**
     * Handle payment success.
     */
    public function success(Request $request): View|RedirectResponse
    {
        $plan = session('checkout_target_plan', 'student');
        $planEnum = PlanEnum::tryFrom($plan);

        if (!$planEnum || $planEnum === PlanEnum::Free) {
            return redirect()->route('dashboard');
        }

        $user = $request->user();

        // Batalkan/expired-kan langganan aktif sebelumnya jika ada
        $user->subscriptions()->where('status', 'active')->update(['status' => 'expired']);

        // Update user's plan
        $user->plan = $planEnum;
        $user->save();

        // Tambahkan subscription dummy baru
        $user->subscriptions()->create([
            'plan' => $planEnum,
            'status' => 'active',
            'amount' => $planEnum === PlanEnum::Pro ? 79000 : 29000,
            'midtrans_order_id' => 'ORDER-' . strtoupper(uniqid()),
            'midtrans_transaction_id' => 'MID-' . strtoupper(uniqid()),
            'started_at' => now(),
            'expires_at' => now()->addMonth(),
        ]);

        // Hapus session target plan
        session()->forget('checkout_target_plan');

        return view('checkout.success', [
            'planLabel' => $planEnum->label(),
        ]);
    }

    /**
     * Handle payment pending.
     */
    public function pending(Request $request): View
    {
        return view('checkout.pending');
    }

    /**
     * Handle payment error/failed.
     */
    public function error(Request $request): View
    {
        return view('checkout.error');
    }

    /**
     * Handle Midtrans payment callback/notification.
     */
    public function callback(Request $request): void
    {
        // TODO: Implement Midtrans callback handler
    }
}
