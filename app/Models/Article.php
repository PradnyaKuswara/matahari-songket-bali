<?php

namespace App\Models;

use App\Traits\Slugable;
use App\Traits\UseUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as ContractsAuditable;

class Article extends Model implements ContractsAuditable
{
    use Auditable, HasFactory, Slugable, UseUuid;

    const IMAGE_PATH = 'articles';

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'thumbnail',
        'slug',
        'meta_desc',
        'meta_keyword',
        'is_active',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function thumbnail(): string
    {
        return Storage::url($this->thumbnail);
    }
}
