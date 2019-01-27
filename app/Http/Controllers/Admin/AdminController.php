<?php

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use App\Models\Category;
    use App\Models\Comment;
    use App\Models\Post;
    use App\Models\Tag;

    /**
     * Class AdminController
     * Admin Utility Controller
     *
     * @package App\Http\Controllers\Admin
     */
    class AdminController extends Controller
    {
        /**
         * Show Stats Page
         *
         * @return mixed
         */
        public function showStatsPage()
        {
            $posts      = Post::count();
            $comments   = Comment::count();
            $tags       = Tag::count();
            $categories = Category::count();

            return view('admin.stats.index',get_defined_vars());
        }

    }
