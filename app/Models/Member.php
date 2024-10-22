<?php

namespace App\Models;

use App\Filters\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Member extends Model implements HasMedia, Filterable
{
    use HasFactory, InteractsWithMedia;

    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
        'title',
        'social',
        'description',
        'lang',
        'is_active'
    ];

    /**
    * The attributes that should be cast.
    *
    * @var array
    */
    protected $casts = [
        'social' => 'json',
    ];

    public function getFullNameAttribute()
    {
        return $this->first_name . ($this->last_name ? " $this->last_name" : ""); 
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('avatar')
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
    public function scopeNotActive($query)
    {
        $query->where('is_active', 0);
    }

    public function filter(array $filters)
    {
        $query = $this->newQuery();

        if (!empty($filters['name'])) {
            $name = $filters['name'];
            $query->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%$name%"]);;
        }

        if (!empty($filters['phone'])) {
            $query->where('phone', "LIKE", "%{$filters['phone']}%");
        }

        if (!empty($filters['email'])) {
            $query->where('email', "LIKE", "%{$filters['email']}%");
        }
        // dd(isset($filters['active'])  && $filters['active'] !== null);
        if (isset($filters['active'])  && $filters['active'] !== null) {
            $query->where('is_active',  "{$filters['active']}");
        }

        return $query;
    }
}
