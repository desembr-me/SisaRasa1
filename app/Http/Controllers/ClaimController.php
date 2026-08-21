<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Rescue;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClaimController extends Controller
{
    /**
     * Claim one portion of a surplus listing.
     */
    public function store(Request $request, Listing $listing): RedirectResponse
    {
        $user = $request->user();

        if ($listing->store->user_id === $user->id) {
            return back()->with('error', 'Kamu tidak bisa mengklaim listing dari tokomu sendiri.');
        }

        $claimed = DB::transaction(function () use ($listing, $user) {
            $listing->refresh();

            if ($listing->isExpired() || $listing->remainingQuantity() < 1) {
                return false;
            }

            $listing->claims()->create([
                'user_id' => $user->id,
                'quantity' => 1,
            ]);

            $user->rescues()->create([
                'source' => 'klaim',
                'description' => "{$listing->title} ({$listing->store->name})",
                'kg_saved' => $listing->estimated_kg,
            ]);

            return true;
        });

        if (! $claimed) {
            return back()->with('error', 'Maaf, listing ini sudah habis atau kedaluwarsa.');
        }

        return back()->with('status', 'listing-claimed');
    }
}
