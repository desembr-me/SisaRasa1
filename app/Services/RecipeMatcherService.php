<?php

namespace App\Services;

use App\Models\Recipe;
use Illuminate\Support\Str;

class RecipeMatcherService
{
    /**
     * Find the recipe whose ingredient list best overlaps with what the user has on hand.
     *
     * @param  array<int, string>  $userIngredients
     * @return array{title: string, description: string, cook_time_minutes: int, estimated_kg_saved: float, ingredients_used: array<int, string>, steps: array<int, string>}|null
     */
    public function findBestMatch(array $userIngredients): ?array
    {
        $normalized = collect($userIngredients)
            ->map(fn ($item) => Str::lower(trim($item)))
            ->filter()
            ->unique()
            ->values();

        if ($normalized->isEmpty()) {
            return null;
        }

        $best = null;
        $bestScore = 0;
        $bestRatio = 0.0;

        foreach (Recipe::all() as $recipe) {
            $recipeIngredients = collect($recipe->ingredients)->map(fn ($item) => Str::lower($item));

            $score = $recipeIngredients->filter(
                fn ($ri) => $normalized->contains(fn ($ui) => Str::contains($ri, $ui) || Str::contains($ui, $ri))
            )->count();

            if ($score === 0) {
                continue;
            }

            $ratio = $score / max(1, $recipeIngredients->count());

            if ($score > $bestScore || ($score === $bestScore && $ratio > $bestRatio)) {
                $best = $recipe;
                $bestScore = $score;
                $bestRatio = $ratio;
            }
        }

        if (! $best) {
            return null;
        }

        return [
            'title' => $best->title,
            'description' => $best->description,
            'cook_time_minutes' => $best->cook_time_minutes,
            'estimated_kg_saved' => (float) $best->estimated_kg,
            'ingredients_used' => $best->ingredients,
            'steps' => $best->steps,
        ];
    }
}
