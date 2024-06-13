<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class LayoutGroup extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = [
        'title',
        'description',
        'tag',
        'lang',
        'count_list',
        'is_active',
    ];
    
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

    /**
     * Get all of the layouts for the LayoutGroup
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function layouts(): HasMany
    {
        return $this->hasMany(Layout::class);
    }
}
