<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Crypt;

class Production extends Model
{
    use HasFactory, Uuid;

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

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function getRouteKey()
    {
        return Crypt::encrypt($this->uuid);
    }

    public function resolveRouteBinding($value, $field = null)
    {
        try {
            $decrypted = Crypt::decrypt($value);
            $field = $field ?? $this->getRouteKeyName();

            return parent::resolveRouteBinding($decrypted, $field);
        } catch (\Throwable $th) {
            abort(404);
        }
    }
}
