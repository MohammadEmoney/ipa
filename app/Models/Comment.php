<?php

namespace App\Models;

use App\Enums\EnumCommentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Kalnoy\Nestedset\NodeTrait;

class Comment extends Model
{
    use HasFactory, NodeTrait;

    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = [
        'user_id',
        'title',
        'message',
        'commentable_type',
        'commentable_id',
        'status',
        'parent_id',
    ];

    /**
     * Get the user that owns the Comment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the parent commentable model (page or post).
     */
    public function commentable()
    {
        return $this->morphTo();
    }

    public function scopeAllowed($query)
    {
        $query->where('status', EnumCommentStatus::ALLOWED);
    }

    public function scopeRejected($query)
    {
        $query->where('status', EnumCommentStatus::REJECTED);
    }

    public function scopeWating($query)
    {
        $query->where('status', EnumCommentStatus::WAITING);
    }
}
