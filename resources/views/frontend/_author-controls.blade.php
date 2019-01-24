<div id="author-controls">
    <div class="row">
        <div class="col-lg-12">
            @if(!$comment->is_correct)
                <form method="POST" action="{{route('post.comment.correct.set', [$post, $comment])}}">
                    {{csrf_field()}}
                    <button class="btn btn-sm btn-success pull-right">Mark as Correct Answer</button>
                </form>
            @else
                <form method="POST" action="{{route('post.comment.correct.clear', [$post, $comment])}}">
                    {{csrf_field()}}
                    <button class="btn btn-sm btn-danger pull-right">Clear Correct Answer</button>
                </form>
            @endif
        </div>
    </div>
</div>
