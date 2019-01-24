<?php

namespace App\Models;

use App\User;
use App\Models\Tag;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * Fillables
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'body',
        'user_id',
        'category_id',
        'is_published'
    ];

    /**
     * Boot method override
     *
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            if(is_null($post->user_id)) {
                $post->user_id = auth()->user()->id;
            }
        });

        static::deleting(function ($post) {
            $post->comments()->delete();
            $post->tags()->detach();
        });
    }

    /**
     * BelongsTo Category
     *
     * @return mixed
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * BelongsTo User
     *
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * BelongsToMany Tags
     *
     * @return mixed
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    /**
     * HasMany Comments
     *
     * @return mixed
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * HasOne Answer
     *
     * @return mixed
     */
    public function answer()
    {
        return $this->hasOne(Comment::class)->where('is_correct',true);
    }


    /**
     * If is published Scope
     *
     * @param $query
     * @return mixed
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /**
     * If is drafted Scope
     *
     * @param $query
     * @return mixed
     */
    public function scopeDrafted($query)
    {
        return $query->where('is_published', false);
    }

    /**
     * Is Publised computed
     *
     * @return string
     */
    public function getPublishedAttribute()
    {
        return ($this->is_published) ? 'Yes' : 'No';
    }
}
