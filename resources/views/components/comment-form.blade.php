<div>
    @if ($commentable ?? false)
        <form action={{ route('ideas.comments.store', ['idea' => $idea->id]) }} method="POST">
            @csrf
            @method('post')
            <div class="mb-3">
                <textarea class="fs-6 form-control" rows="1" name="comment-box"></textarea>
            </div>
            <div>
                <button class="btn btn-primary btn-sm" type="submit"> Post Comment </button>
            </div>
        </form>
    @endif

    @if (count($idea->comments) > 0)
        <hr>
    @endif

    @foreach ($idea->comments as $comment)
        @include('components.comment-card', $comment)
    @endforeach
</div>
