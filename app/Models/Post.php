<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Morilog\Jalali\Jalalian;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia
{
    use HasFactory;
    use SoftDeletes;
    use InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'summary',
        'description',
        'views',
        'lang',
        'created_by',
        'updated_by',
        'published_at',
        'is_active',
        'is_private',
    ];

    protected $casts = [
        'is_private' => 'boolean',
        'published_at' => 'datetime',
        'updated_at' => 'datetime',
        'created_at' => 'datetime',
    ];

    /**
     * @param $date
     * @return string|null
     */
    public function getUpdatedAtAttribute($date):string|null
    {
        $date = Carbon::parse($date);
        return config('app.locale') == 'en' ? $date->format('Y-m-d') : Jalalian::fromDateTime($date)->format('d %B %Y');
    }

    /**
     * The categories that belong to the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class)->wherePivot('is_main', false);
    }

    /**
     * The mainCategory that belong to the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function mainCategory(): BelongsToMany
    {
        return $this->belongsToMany(Category::class)->wherePivot('is_main', true);
    }

    /**
     * Get the user that owns the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user that owns the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Get the post's comments.
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
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
     * Public Scope
     */
    public function scopePublic($query)
    {
        $query->where('is_private', 0);
    }
    

    /**
     * Private Scope
     */
    public function scopePrivate($query)
    {
        $query->where('is_private', 1);
    }
    
    /**
     * Active Scope
     */
    public function scopeLang($query, $lang = null)
    {
        $query->where('lang', $lang ?: config('app.locale'));
    }
}
