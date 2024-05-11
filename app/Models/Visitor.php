<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'ip_address',
    ];

    const TYPE_ARTICLE = 'article';

    const TYPE_PRODUCT = 'product';

    public function visitorMeta(): HasOne
    {
        return $this->hasOne(VisitorMeta::class);
    }
}
