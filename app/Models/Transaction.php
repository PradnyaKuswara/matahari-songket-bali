<?php

namespace App\Models;

use App\Traits\CustomId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Crypt;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Transaction extends Model implements AuditableContract
{
    use Auditable, CustomId, HasFactory;

    protected $fillable = [
        'user_id',
        'order_id',
        'generate_id',
        'type',
        'item_total_price',
        'shipping_price',
        'tax',
        'total_price',
        'money',
        'snap_token',
        'status',
        'expired_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
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
