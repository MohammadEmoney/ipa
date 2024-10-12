<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Airline extends Model
{
    use HasFactory;

    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = [
        'title',
        'title_en',
        'description',
        'is_active',
    ];

    /**
     * Get all of the users for the Airline
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(UserInfo::class);
    }

    /**
     * Active Scope
     */
    public function scopeActive($query)
    {
        $query->where('is_active', 1);
    }
}
