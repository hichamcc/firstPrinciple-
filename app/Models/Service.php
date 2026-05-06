<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['icon', 'title', 'description', 'sort_order'];

    protected static function booted(): void
    {
        static::creating(function (self $model) {
            if (! isset($model->sort_order)) {
                $model->sort_order = (static::max('sort_order') ?? 0) + 1;
            }
        });
    }
}
