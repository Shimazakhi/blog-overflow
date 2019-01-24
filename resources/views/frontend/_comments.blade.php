@forelse ($post->comments as $comment)
    <div class="panel {{$comment->is_correct ? 'panel-success' : 'panel-default'}}">
        <div class="panel-heading">
            {{ $comment->user->name }} says...

            <span class="pull-right">{{ $comment->created_at->diffForHumans() }}</span>
        </div>

        <div class="panel-body">
            <p>{{ $comment->body }}</p>
            @includeWhen(Auth::user()->id === $post->user->id, 'frontend._author-controls')
        </div>

    </div>

@empty
    <div class="panel panel-default">
        <div class="panel-heading">Not Found!!</div>

        <div class="panel-body">
            <p>Sorry! No comment found for this post.</p>
        </div>
    </div>
@endforelse
