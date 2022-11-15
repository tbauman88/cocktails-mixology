<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DrinkIngredient extends Model
{
    use HasFactory;

    public function drink(): BelongsTo
    {
        return $this->belongsTo(Drink::class, 'drink_id', 'id');
    }

    public function ingredient(): BelongsTo
    {
        return $this->belongsTo(Drink::class, 'ingredient_id', 'id');
    }
}
