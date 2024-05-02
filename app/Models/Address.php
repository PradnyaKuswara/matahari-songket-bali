<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Address extends Model implements AuditableContract
{
    use Auditable, HasFactory;

    protected $fillable = [
        'user_id',
        'address',
        'city',
        'province',
        'country',
        'postal_code',
        'additional_information',
        'is_active',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
