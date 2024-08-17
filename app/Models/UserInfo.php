<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserInfo extends Model
{
    use HasFactory;

    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = [
        'user_id',
        'national_code',
        'birth_date',
        'landline_phone',
        'phone_1',
        'phone_2',
        'job_title',
        'situation',
        'university',
        'company_name',
        'company_phone',
        'company_address',
        'address',
        'education',
    ];

    /**
     * Get the user that owns the UserInfo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
