<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['source', 'description', 'kg_saved'])]
class Rescue extends Model
{
    /** kg CO2e prevented per kg of food saved — matches the landing page's impact model */
    public const CO2_PER_KG = 2.5;

    /** Rp economic value saved per kg of food saved — matches the landing page's impact model */
    public const RP_PER_KG = 15000;

    protected function casts(): array
    {
        return [
            'kg_saved' => 'decimal:2',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function co2Prevented(): float
    {
        return round((float) $this->kg_saved * self::CO2_PER_KG, 2);
    }

    public function moneySaved(): float
    {
        return round((float) $this->kg_saved * self::RP_PER_KG);
    }

    public function sourceLabel(): string
    {
        return match ($this->source) {
            'masak' => 'Masak dari sisa',
            'klaim' => 'Klaim surplus',
            default => $this->source,
        };
    }
}
