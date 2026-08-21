<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected function casts(): array
    {
        return [
            'ingredients' => 'array',
            'steps' => 'array',
            'estimated_kg' => 'decimal:2',
        ];
    }
}
