<?php

namespace App\Models;

use App\Enums\CategoryStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $casts = [
        'status' => CategoryStatus::class,
        'highlighted' => 'boolean',
    ];

    public function products(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('position')
            ->orderBy('position')
            ->withTrashed();
    }

    public function availableProducts(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->products()->withoutTrashed();
    }

    public function trashedProducts(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->products()->onlyTrashed();
    }
}
