<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class TeamMember extends Model
{
    protected $fillable = ['title', 'image', 'years', 'skills', 'sort_order'];

    protected $casts = [
        'skills' => 'array',
    ];

    protected static function booted(): void
    {
        static::creating(function (self $model) {
            if (! isset($model->sort_order)) {
                $model->sort_order = (static::max('sort_order') ?? 0) + 1;
            }
        });

        static::deleting(function (self $model) {
            if ($model->image && ! str_starts_with($model->image, 'http')) {
                Storage::disk('public')->delete($model->image);
            }
        });
    }

    public function getImageSrcAttribute(): ?string
    {
        if (! $this->image) {
            return null;
        }

        return str_starts_with($this->image, 'http')
            ? $this->image
            : '/storage/' . $this->image;
    }
}
