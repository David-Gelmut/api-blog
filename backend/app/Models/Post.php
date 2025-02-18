<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'user_id',
        'category_id',
        'description',
        'prev_image',
        'preview',
    ];

    public function comments(): HasMany
    {
        return $this
            ->hasMany(Comment::class)
            ->orderBy('created_at','desc');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function tags():BelongsToMany
    {
        return $this->belongsToMany(Tag::class,'tag_posts','post_id','tag_id');
    }
}
