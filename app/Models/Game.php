<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Game extends Model
{
    protected $fillable = [
    'title',
    'platform_id',
    'price',
    'stock',
    'is_available',
    'is_featured',
    ];

    protected function casts(): array
    {
        return [
            'stock' => 'integer',
            'is_featured' => 'boolean',
            'price' => 'decimal:2',
        ];
    }

    public function platform(): BelongsTo
    {
        return $this->belongsTo(Platform::class);
    }
}