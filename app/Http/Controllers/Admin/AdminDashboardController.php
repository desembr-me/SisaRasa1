<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rescue;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    /**
     * Site-wide analytics + searchable user list.
     */
    public function index(Request $request): View
    {
        $totalKg = (float) Rescue::sum('kg_saved');

        $users = User::query()
            ->withCount('rescues')
            ->withSum('rescues', 'kg_saved')
            ->when($request->string('q')->trim()->toString(), function ($query, $q) {
                $query->where(function ($query) use ($q) {
                    $query->where('name', 'like', "%{$q}%")
                        ->orWhere('email', 'like', "%{$q}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.dashboard', [
            'totalUsers' => User::count(),
            'totalActions' => Rescue::count(),
            'totalKg' => $totalKg,
            'totalCo2' => round($totalKg * Rescue::CO2_PER_KG, 2),
            'totalRp' => round($totalKg * Rescue::RP_PER_KG),
            'users' => $users,
            'q' => $request->string('q')->toString(),
        ]);
    }

    /**
     * Show one user's profile and their logged activity.
     */
    public function show(User $user): View
    {
        $user->loadCount('rescues')->loadSum('rescues', 'kg_saved');

        return view('admin.users.show', [
            'viewedUser' => $user,
            'rescues' => $user->rescues()->latest()->paginate(15),
        ]);
    }

    /**
     * Toggle a user between the 'user' and 'admin' roles.
     */
    public function updateRole(Request $request, User $user): RedirectResponse
    {
        if ($user->is($request->user())) {
            return back()->with('error', 'Kamu tidak bisa mengubah role akunmu sendiri.');
        }

        $user->forceFill(['role' => $user->isAdmin() ? 'user' : 'admin'])->save();

        return back()->with('status', 'role-updated');
    }

    /**
     * Delete a user account.
     */
    public function destroy(Request $request, User $user): RedirectResponse
    {
        if ($user->is($request->user())) {
            return back()->with('error', 'Kamu tidak bisa menghapus akunmu sendiri.');
        }

        $user->delete();

        return back()->with('status', 'user-deleted');
    }
}
