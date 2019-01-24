<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 *
 * @package App\Models
 */
class Category extends Model
{
    /**
     * Fillables
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Boot Method Override
     *
     */
    protected static function boot()
    {
        static::deleting(function ($category) {
            $category->posts()->delete();
        });
    }

    /**
     * HasMany Posts
     *
     * @return mixed
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
