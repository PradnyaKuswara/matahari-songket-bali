<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Shipping extends Model implements AuditableContract
{
    use Auditable, HasFactory, Uuid;

    protected $fillable = [
        'order_id',
        'user_id',
        'name',
        'courier',
        'tracking_number',
        'tracking_link',
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

    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
