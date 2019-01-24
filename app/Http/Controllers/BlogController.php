<?php

    namespace App\Http\Controllers;

    use App\Models\Comment;
    use App\Models\Post;
    use Illuminate\Http\Request;

    /**
     * Class BlogController
     *
     * @package App\Http\Controllers
     */
    class BlogController extends Controller
    {
        /**
         * Get Blog Index
         *
         * @param Request $request
         * @return mixed
         */
        public function index(Request $request)
        {
            $posts = Post::when($request->search, function ($query) use ($request) {
                $search = $request->search;

                return $query->where('title', 'like', "%$search%")
                    ->orWhere('body', 'like', "%$search%");
            })->with('tags', 'category', 'user')
                ->withCount('comments')
                ->published()
                ->orderBy('created_at', 'DESC')
                ->simplePaginate(5);

            return view('frontend.index', compact('posts'));
        }

        /**
         * Get Post Page
         *
         * @param Post $post
         * @return mixed
         */
        public function post(Post $post)
        {
            $post = $post->load(['comments.user', 'tags', 'user', 'category']);

            return view('frontend.post', compact('post'));
        }

        /**
         * Set Correct Answer
         *
         * @param Post $post
         * @param Comment $comment
         * @return mixed
         */
        public function setCorrectAnswer(Post $post, Comment $comment)
        {

            $comment = $post->comments()->findOrFail($comment->id);

            if ($post->answer) {
                $post->answer->clearCorrect();
            }

            $comment->setCorrect();

            flash()->overlay('Correct Answer Chosen');

            return redirect("/posts/{$post->id}");

        }

        /**
         * Clear Correct Answer
         *
         * @param Post $post
         * @param Comment $comment
         * @return mixed
         */
        public function clearCorrectAnswer(Post $post, Comment $comment)
        {

            $comment = $post->comments()->findOrFail($comment->id);

            $comment->clearCorrect();

            flash()->overlay('Correct Answer Removed');

            return redirect("/posts/{$post->id}");
        }

        /**
         * Store Comment
         *
         * @param Request $request
         * @param Post $post
         * @return mixed
         */
        public function comment(Request $request, Post $post)
        {
            $this->validate($request, ['body' => 'required']);

            $post->comments()->create([
                'body' => $request->body
            ]);
            flash()->overlay('Comment successfully created');

            return redirect("/posts/{$post->id}");
        }
    }
