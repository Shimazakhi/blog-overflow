<?php

    namespace App\Models;

    use App\User;
    use App\Models\Post;
    use Illuminate\Database\Eloquent\Model;

    class Comment extends Model
    {
        /**
         * Fillables
         *
         * @var array
         */
        protected $fillable = [
            'body',
            'user_id',
            'post_id'
        ];

        /**
         * Boot Method Override
         *
         */
        protected static function boot()
        {
            parent::boot();

            static::creating(function ($comment) {
                if (is_null($comment->user_id)) {
                    $comment->user_id = auth()->user()->id;
                }
            });
        }

        /**
         * BelongsTo Post
         *
         * @return mixed
         */
        public function post()
        {
            return $this->belongsTo(Post::class);
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
         * Mark Comment As Correct Answer
         */
        public function setCorrect()
        {
            $this->is_correct = true;
            $this->save();
        }

        /**
         * Clear Correct Answer
         */
        public function clearCorrect()
        {
            $this->is_correct = false;
            $this->save();
        }
    }
