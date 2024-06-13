<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Crypt;
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
