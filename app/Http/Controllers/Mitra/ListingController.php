<?php

namespace App\Http\Controllers\Mitra;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ListingController extends Controller
{
    /**
     * Show the mitra's store profile and their listings.
     */
    public function index(Request $request): View
    {
        $store = $request->user()->store;
        $listings = $store->listings()->withSum('claims', 'quantity')->latest()->get();

        return view('mitra.listings.index', [
            'store' => $store,
            'listings' => $listings,
            'activeCount' => $listings->filter(fn (Listing $l) => $l->isAvailable())->count(),
            'totalClaimed' => (int) $listings->sum(fn (Listing $l) => $l->claims_sum_quantity ?? 0),
            'totalKgDistributed' => $listings->sum(fn (Listing $l) => (float) ($l->claims_sum_quantity ?? 0) * (float) $l->estimated_kg),
        ]);
    }

    /**
     * Show the form to post a new surplus listing.
     */
    public function create(): View
    {
        return view('mitra.listings.create');
    }

    /**
     * Store a new surplus listing under the mitra's store.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validated($request);

        $request->user()->store->listings()->create($validated);

        return redirect()->route('mitra.listings.index')->with('status', 'listing-created');
    }

    /**
     * Show the form to edit an existing listing.
     */
    public function edit(Request $request, Listing $listing): View
    {
        $this->authorizeOwnership($request, $listing);

        return view('mitra.listings.edit', ['listing' => $listing]);
    }

    /**
     * Update an existing listing.
     */
    public function update(Request $request, Listing $listing): RedirectResponse
    {
        $this->authorizeOwnership($request, $listing);

        $listing->update($this->validated($request));

        return redirect()->route('mitra.listings.index')->with('status', 'listing-updated');
    }

    /**
     * Delete a listing.
     */
    public function destroy(Request $request, Listing $listing): RedirectResponse
    {
        $this->authorizeOwnership($request, $listing);

        $listing->delete();

        return redirect()->route('mitra.listings.index')->with('status', 'listing-deleted');
    }

    private function authorizeOwnership(Request $request, Listing $listing): void
    {
        abort_unless($listing->store_id === $request->user()->store->id, 403);
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:500'],
            'quantity' => ['required', 'integer', 'min:1', 'max:1000'],
            'price_type' => ['required', 'in:gratis,diskon'],
            'original_price' => ['required_if:price_type,diskon', 'nullable', 'integer', 'min:0'],
            'discounted_price' => ['required_if:price_type,diskon', 'nullable', 'integer', 'min:0'],
            'estimated_kg' => ['required', 'numeric', 'min:0.1', 'max:100'],
            'expires_at' => ['required', 'date', 'after:now'],
        ]);
    }
}
