<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRescueRequest;
use App\Models\Rescue;
use App\Models\User;
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
        $totalActions = $user->rescues()->count();
        $nextMilestone = ((int) floor($totalKg / 10)) * 10 + 10;
        $streak = $this->currentStreak($user);

        return view('dashboard', [
            'totalKg' => $totalKg,
            'totalCo2' => round($totalKg * Rescue::CO2_PER_KG, 2),
            'totalRp' => round($totalKg * Rescue::RP_PER_KG),
            'totalActions' => $totalActions,
            'recent' => $user->rescues()->latest()->take(10)->get(),
            'nextMilestone' => $nextMilestone,
            'progressToMilestone' => min(100, $totalKg / $nextMilestone * 100),
            'trend' => $this->weeklyTrend($user),
            'streak' => $streak,
            'sourceBreakdown' => $this->sourceBreakdown($user),
            'badges' => $this->badges($totalActions, $totalKg, $streak),
        ]);
    }

    /**
     * How many consecutive days (counting back from today or yesterday, so an
     * as-yet-unlogged today doesn't reset the streak) the user has logged at
     * least one rescue.
     */
    private function currentStreak(User $user): int
    {
        $days = $user->rescues()
            ->orderByDesc('created_at')
            ->pluck('created_at')
            ->map(fn ($date) => $date->format('Y-m-d'))
            ->unique()
            ->values();

        if ($days->isEmpty()) {
            return 0;
        }

        $cursor = now()->startOfDay();

        if ($days->first() !== $cursor->format('Y-m-d')) {
            $cursor = $cursor->subDay();
        }

        $streak = 0;

        foreach ($days as $day) {
            if ($day !== $cursor->format('Y-m-d')) {
                break;
            }

            $streak++;
            $cursor = $cursor->subDay();
        }

        return $streak;
    }

    /**
     * kg saved split by source, for the dashboard's "masak vs klaim" chart.
     *
     * @return array{masak: float, klaim: float}
     */
    private function sourceBreakdown(User $user): array
    {
        $totals = $user->rescues()
            ->selectRaw('source, SUM(kg_saved) as total')
            ->groupBy('source')
            ->pluck('total', 'source');

        return [
            'masak' => (float) ($totals['masak'] ?? 0),
            'klaim' => (float) ($totals['klaim'] ?? 0),
        ];
    }

    /**
     * Achievement badges, unlocked purely from existing totals (no extra state to track).
     *
     * @return array<int, array{label: string, desc: string, icon: string, achieved: bool}>
     */
    private function badges(int $totalActions, float $totalKg, int $streak): array
    {
        return [
            ['label' => 'Langkah Pertama', 'desc' => 'Catat aksi pertamamu', 'icon' => 'clipboard', 'achieved' => $totalActions >= 1],
            ['label' => '5 kg Terselamatkan', 'desc' => 'Selamatkan 5 kg makanan', 'icon' => 'leaf', 'achieved' => $totalKg >= 5],
            ['label' => 'Konsisten 3 Hari', 'desc' => 'Aktif 3 hari berturut-turut', 'icon' => 'flame', 'achieved' => $streak >= 3],
            ['label' => '10 Aksi Tercatat', 'desc' => 'Catat 10 aksi penyelamatan', 'icon' => 'clipboard', 'achieved' => $totalActions >= 10],
            ['label' => 'Konsisten 7 Hari', 'desc' => 'Aktif 7 hari berturut-turut', 'icon' => 'flame', 'achieved' => $streak >= 7],
            ['label' => 'Pahlawan Pangan', 'desc' => 'Selamatkan 50 kg makanan', 'icon' => 'trophy', 'achieved' => $totalKg >= 50],
        ];
    }

    /**
     * Daily kg_saved totals for the last 14 days, oldest first, with gap days
     * filled in as zero so the dashboard chart has a continuous timeline.
     *
     * @return array{labels: array<int, string>, data: array<int, float>}
     */
    private function weeklyTrend(User $user): array
    {
        $byDay = $user->rescues()
            ->where('created_at', '>=', now()->subDays(13)->startOfDay())
            ->get(['kg_saved', 'created_at'])
            ->groupBy(fn ($rescue) => $rescue->created_at->format('Y-m-d'))
            ->map(fn ($group) => (float) $group->sum('kg_saved'));

        $labels = [];
        $data = [];

        for ($i = 13; $i >= 0; $i--) {
            $day = now()->subDays($i);
            $labels[] = $day->translatedFormat('d M');
            $data[] = round((float) ($byDay[$day->format('Y-m-d')] ?? 0), 2);
        }

        return ['labels' => $labels, 'data' => $data];
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
