<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Shipping extends Model implements AuditableContract
{
    use Auditable, HasFactory, Uuid;

    protected $fillable = [
        'order_id',
        'user_id',
        'name',
        'courier_code',
        'courier',
        'tracking_number',
        'address',
        'city',
        'province',
        'country',
        'postal_code',
        'additional_information',
        'phone_number',
        'status',
        'shipped_at',
        'delivered_at',
        'max_confirm',
    ];

    protected $casts = [
        'shipped_at' => 'datetime',
        'delivered_at' => 'datetime',
        'max_confirm' => 'datetime',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
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
