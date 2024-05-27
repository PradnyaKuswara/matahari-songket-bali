<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Str;

trait CustomId
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Str::uuid()->toString();

            $id = str_pad((string) rand(0, 999999), 6, '0', STR_PAD_LEFT);

            $date = Carbon::now()->format('dmy');

            if ($model instanceof \App\Models\Order) {
                // It's an Order
                $type = 'ORD';
            } elseif ($model instanceof \App\Models\Transaction) {
                // It's a Transaction
                $type = 'INV';
            } else {
                return;
            }

            $model->generate_id = $type.'-'.$date.'-'.$id;
        });
    }
}
