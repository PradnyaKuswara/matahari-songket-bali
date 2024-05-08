<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Production extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date',
        'material',
        'service',
        'total',
        'goods_price',
        'estimate',
    ];

    public function items(): BelongsToMany
    {
        return $this->belongsToMany(Item::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot('weaver_name');
    }
}
