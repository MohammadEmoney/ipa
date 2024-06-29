<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = [
        'user_id',
        'track_number',
        'tax',
        'discount_amount',
        'order_amount',
        'payable_amount',
        'description',
        'status',
        'payment_type',
        'payment_method',
        'gateway',
    ];

    /**
     * Get the user that owns the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the transctions for the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transctions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
