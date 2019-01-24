<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Models\Tag;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListingController extends Controller
{
    /**
     * Tags
     *
     * @return mixed
     */
    public function tags()
    {
        $tags = Tag::paginate(10);

        return $tags;
    }

    /**
     * Categories
     *
     * @return mixed
     */
    public function categories()
    {
        $categories = Category::paginate(10);

        return $categories;
    }

    /**
     * Users
     *
     * @return mixed
     */
    public function users()
    {
        $users = User::paginate(10);

        return $users;
    }
}
