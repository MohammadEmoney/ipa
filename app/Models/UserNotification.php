<?php

namespace App\Models;

use App\Enums\EnumNotificationMethods;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserNotification extends Model
{
    use HasFactory;

    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = [
        'user_id',
        'title',
        'from',
        'to',
        'roles',
        'send_via',
        'users',
        'message',
    ];

    /**
    * The attributes that should be cast.
    *
    * @var array
    */
    protected $casts = [
        'to' => 'json',
        'roles' => 'json',
        'send_via' => 'json',
        'users' => 'json',
    ];

    /**
     * Get the user that owns the UserNotification
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getSendViaAsStringAttribute()
    {
        $sendVia = collect($this->send_via)->map(function($value, $key){
            return EnumNotificationMethods::trans($value);
        })->implode(' - ');
        return $sendVia;
    }

    public function getSendToAsStringAttribute()
    {
        $sendTo = collect($this->to)->implode(', ');
        return $sendTo;
    }
}
