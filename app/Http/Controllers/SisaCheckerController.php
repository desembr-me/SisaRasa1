<?php

namespace App\Http\Controllers;

use App\Services\RecipeMatcherService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SisaCheckerController extends Controller
{
    public function __construct(private readonly RecipeMatcherService $matcher) {}

    /**
     * Step 1: type in the leftover ingredients.
     */
    public function create(): View
    {
        return view('sisa-checker.create');
    }

    /**
     * Parse the typed ingredient list, then move to confirmation.
     */
    public function identify(Request $request): RedirectResponse
    {
        $request->validate([
            'ingredients_text' => ['required', 'string', 'max:500'],
        ]);

        $ingredients = collect(explode(',', (string) $request->string('ingredients_text')))
            ->map(fn ($item) => trim($item))
            ->filter()
            ->unique()
            ->values()
            ->all();

        if (empty($ingredients)) {
            return redirect()->route('sisa-checker.create')
                ->withErrors(['ingredients_text' => 'Ketik minimal satu bahan, dipisahkan koma.'])
                ->withInput();
        }

        session(['sisa_checker.ingredients' => $ingredients]);

        return redirect()->route('sisa-checker.confirm');
    }

    /**
     * Step 2: let the user review/edit the ingredient list before matching a recipe.
     */
    public function confirm(): View|RedirectResponse
    {
        $ingredients = session('sisa_checker.ingredients', []);

        if (empty($ingredients)) {
            return redirect()->route('sisa-checker.create');
        }

        return view('sisa-checker.confirm', ['ingredients' => $ingredients]);
    }

    /**
     * Match the confirmed ingredient list against the recipe collection.
     */
    public function recipe(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'ingredients' => ['required', 'array', 'min:1'],
            'ingredients.*' => ['required', 'string', 'max:60'],
        ]);

        $recipe = $this->matcher->findBestMatch($validated['ingredients']);

        if (! $recipe) {
            session(['sisa_checker.ingredients' => $validated['ingredients']]);

            return redirect()->route('sisa-checker.confirm')->withErrors([
                'ingredients' => 'Belum ada resep yang cocok dengan bahan itu. Coba ubah atau tambah bahan lain.',
            ]);
        }

        session(['sisa_checker.recipe' => $recipe]);
        session()->forget('sisa_checker.ingredients');

        return redirect()->route('sisa-checker.result');
    }

    /**
     * Step 3: show the matched recipe, with an option to log it as a rescue.
     */
    public function result(): View|RedirectResponse
    {
        $recipe = session('sisa_checker.recipe');

        if (blank($recipe)) {
            return redirect()->route('sisa-checker.create');
        }

        return view('sisa-checker.result', ['recipe' => $recipe]);
    }
}
