@if (Auth::user()->hasLiked($idea))
    <!--UNLIKE BUTTON-->
    <form action="{{ route('ideas.unlike', $idea) }}" method="post" class="fw-light nav-link fs-6">
        @csrf
        @method('post')
        <button style="border:none;background:white">
            <span class="fas fa-heart me-1">
            </span> {{ $idea->likes_count }}</button>
    </form>
@else
    <!--LIKE BUTTON-->
    <form action="{{ route('ideas.like', $idea) }}" method="post" class="fw-light nav-link fs-6">
        @csrf
        @method('post')
        <button style="border:none;background:white">
            <span class="far fa-heart me-1">
            </span> {{ $idea->likes_count }}</button>
    </form>
@endif
