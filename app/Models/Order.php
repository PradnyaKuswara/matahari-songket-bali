<?php

namespace App\Models;

use App\Traits\CustomId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Order extends Model implements AuditableContract
{
    use Auditable, CustomId, HasFactory;

    protected $fillable = [
        'user_id',
        'address_id',
        'generate_id',
        'item_total_price',
        'shipping_price',
        'tax',
        'quantity',
        'total_price',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity', 'price', 'total_price')->withTimestamps();
    }

    public function transaction(): HasOne
    {
        return $this->hasOne(Transaction::class);
    }

    public function shipping(): HasOne
    {
        return $this->hasOne(Shipping::class);
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
