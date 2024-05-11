<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VisitorMeta extends Model
{
    use HasFactory;

    protected $fillable = [
        'visitor_id',
        'identity',
        'link',
        'slug',
    ];

    protected $casts = [
        'indentity' => 'integer',
    ];

    public function visitor(): BelongsTo
    {
        return $this->belongsTo(Visitor::class);
    }
}
