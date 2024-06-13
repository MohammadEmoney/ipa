<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Layout extends Model implements HasMedia
{
    use HasFactory, NodeTrait, InteractsWithMedia;

    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = [
        'layout_group_id',
        'type',
        'data',
        'title',
        'description',
        'release_type',
        'start_date_release',
        'end_date_release',
        'priority',
        'icon',
        'tag',
        'count_list',
        'is_active',
        'parent_id',
    ];

    /**
    * The attributes that should be cast.
    *
    * @var array
    */
    protected $casts = [
        'data' => 'json',
    ];

    /**
     * Get the layoutGroup that owns the Layout
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function layoutGroup(): BelongsTo
    {
        return $this->belongsTo(LayoutGroup::class);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('mainImage')
            ->nonQueued();
    }
    
    /**
     * Active Scope
     */
    public function scopeActive($query)
    {
        $query->where('is_active', 1);
    }
    
    /**
     * Active Scope
     */
    public function scopeLang($query, $lang = null)
    {
        $query->where('lang', $lang ?: config('app.locale'));
    }
}
