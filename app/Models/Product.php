<?php

namespace App\Models;

use App\Traits\Slugable;
use App\Traits\UseUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Product extends Model implements AuditableContract
{
    use Auditable, HasFactory, Slugable, UseUuid;

    const IMAGE_PATH = 'products';

    protected $fillable = [
        'product_category_id',
        'name',
        'image_1',
        'image_2',
        'image_3',
        'image_4',
        'stock',
        'goods_price',
        'sell_price',
        'description',
        'color',
        'type',
        'is_active',
        'slug',
    ];

    public function productCategory(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function productions(): BelongsToMany
    {
        return $this->belongsToMany(Production::class)->withPivot('weaver_name');
    }

    public function image1(): string
    {
        return Storage::url($this->image_1);
    }

    public function image2(): string
    {
        return Storage::url($this->image_2);
    }

    public function image3(): string
    {
        return Storage::url($this->image_3);
    }

    public function image4(): string
    {
        return Storage::url($this->image_4);
    }
}
