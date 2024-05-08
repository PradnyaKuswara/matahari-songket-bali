<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class ItemCategory extends Model implements AuditableContract
{
    use Auditable, HasFactory;

    protected $fillable = [
        'name',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }
}
