<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\View\View;

class PetaSurplusController extends Controller
{
    /**
     * Show the surplus food map with every currently claimable listing.
     */
    public function index(): View
    {
        $listings = Listing::query()
            ->with('store')
            ->withSum('claims', 'quantity')
            ->where('expires_at', '>', now())
            ->get()
            ->filter(fn (Listing $listing) => $listing->quantity > ($listing->claims_sum_quantity ?? 0));

        $stores = $listings
            ->groupBy('store_id')
            ->map(function ($storeListings) {
                $store = $storeListings->first()->store;

                return [
                    'id' => $store->id,
                    'name' => $store->name,
                    'address' => $store->address,
                    'latitude' => (float) $store->latitude,
                    'longitude' => (float) $store->longitude,
                    'listings' => $storeListings->map(fn (Listing $listing) => [
                        'id' => $listing->id,
                        'title' => $listing->title,
                        'description' => $listing->description,
                        'price_label' => $listing->priceLabel(),
                        'remaining' => $listing->remainingQuantity(),
                        'expires_at' => $listing->expires_at->translatedFormat('d M Y H:i'),
                    ])->values(),
                ];
            })
            ->values();

        return view('peta-surplus.index', ['stores' => $stores]);
    }
}
