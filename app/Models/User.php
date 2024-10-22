<?php

namespace App\Models;

use App\Filters\Filterable;
use App\Traits\DateTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasMedia, MustVerifyEmail, Filterable
{
    use HasFactory, Notifiable, HasRoles, SoftDeletes, InteractsWithMedia, DateTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'phone',
        'email_verified_at',
        'phone_verified_at',
        'password',
        'otp_code',
        'code',
        'lang',
        'is_active'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ($this->last_name ? " $this->last_name" : ""); 
    }

    /**
     * Get the userInfo associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function userInfo(): HasOne
    {
        return $this->hasOne(UserInfo::class);
    }

    /**
     * Get all of the orders for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get all of the transactions for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('avatar')
            ->nonQueued();
        $this
            ->addMediaConversion('nationalCard')
            ->nonQueued();
        $this
            ->addMediaConversion('license')
            ->nonQueued();
        $this
            ->addMediaConversion('bankReceipt')
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
        $query = $this->newQuery()->with(['userInfo']);

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

        if (!empty($filters['situation'])) {
            $query->whereHas('userInfo',function (Builder $q) use($filters){
                $q->where('situation',  "{$filters['situation']}");
            });
        }

        if(!empty($filters['register_start'])){
            $startDate = $this->convertToGeorgianDate($filters['register_start']);
            $query->whereDate('created_at', ">=", $startDate);
        }

        if(!empty($filters['register_end'])){
            $endDate = $this->convertToGeorgianDate($filters['register_end']);
            $query->whereDate('created_at', "<=", $endDate);
        }

        if (!empty($filters['airline'])) {
            $query->whereHas('userInfo',function (Builder $q) use($filters){
                $q->where('airline_id',  "{$filters['airline']}");
            });
        }

        return $query;
    }
}
