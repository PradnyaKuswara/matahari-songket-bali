<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Item extends Model implements AuditableContract
{
    use Auditable, HasFactory, Uuid;

    protected $fillable = ['item_category_id', 'name', 'price'];

    public function itemCategory(): BelongsTo
    {
        return $this->belongsTo(ItemCategory::class);
    }

    public function productions(): BelongsToMany
    {
        return $this->belongsToMany(Production::class);
    }

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }
}
