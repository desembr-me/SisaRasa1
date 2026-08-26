<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Listing extends Model
{
    protected $fillable = ['title', 'description', 'quantity', 'price_type', 'original_price', 'discounted_price', 'estimated_kg', 'expires_at'];

    protected function casts(): array
    {
        return [
            'expires_at' => 'datetime',
            'estimated_kg' => 'decimal:2',
        ];
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function claims(): HasMany
    {
        return $this->hasMany(Claim::class);
    }

    public function isExpired(): bool
    {
        return $this->expires_at->isPast();
    }

    public function remainingQuantity(): int
    {
        $claimed = $this->claims_sum_quantity ?? $this->claims()->sum('quantity');

        return max(0, $this->quantity - $claimed);
    }

    public function isAvailable(): bool
    {
        return ! $this->isExpired() && $this->remainingQuantity() > 0;
    }

    public function priceLabel(): string
    {
        if ($this->price_type === 'gratis') {
            return 'Gratis';
        }

        return 'Rp'.number_format((float) $this->discounted_price, 0, ',', '.');
    }
}
