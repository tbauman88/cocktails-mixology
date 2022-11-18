<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Drink extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "description",
        "owner",
        "published",
        "save_count"
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "owner", "id");
    }

    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(Ingredient::class)
            ->withPivot('amount', 'amount_unit')
            ->withTimestamps();
    }
}
