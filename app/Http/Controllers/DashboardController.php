<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRescueRequest;
use App\Models\Rescue;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the user's impact dashboard.
     */
    public function index(Request $request): View
    {
        $user = $request->user();

        $totalKg = (float) $user->rescues()->sum('kg_saved');

        return view('dashboard', [
            'totalKg' => $totalKg,
            'totalCo2' => round($totalKg * Rescue::CO2_PER_KG, 2),
            'totalRp' => round($totalKg * Rescue::RP_PER_KG),
            'totalActions' => $user->rescues()->count(),
            'recent' => $user->rescues()->latest()->take(10)->get(),
        ]);
    }

    /**
     * Log a new food-rescue action for the current user.
     */
    public function store(StoreRescueRequest $request): RedirectResponse
    {
        $request->user()->rescues()->create($request->validated());

        return redirect()->route('dashboard')->with('status', 'rescue-added');
    }
}
