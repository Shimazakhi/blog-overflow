<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * Fillables
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * BelongsToMany Post
     *
     * @return mixed
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class)->withTimestamps();
    }
}
