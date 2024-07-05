<div class="card my-4">
    <div class="px-3 pt-4 pb-2">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img style="width:50px" class="me-2 avatar-sm rounded-circle" src={{ $idea->user->getImageUrl() }}
                    alt="{{ $idea->user->username ?? 'No user' }}">
                <div>
                    <h5 class="card-title mb-0"><a href={{ route('users.show', ['user' => $idea->user]) }}>
                            {{ $idea->user->username ?? 'No user' }}
                            {{--  This framework is really fucking smart innit --}}
                        </a></h5>
                </div>

            </div>

            @if (auth()->id() === $idea->user->id)
                <form action={{ route('ideas.destroy', ['idea' => $idea]) }} method="post">
                    @csrf
                    @method('delete')

                    <a href={{ route('ideas.edit', $idea->id) }}>Edit</a>

                    <button type="submit">🗑️</button>
                </form>
            @endif




        </div>
    </div>
    <div class="card-body">
        @if ($editing ?? false)
            <form action={{ route('ideas.update', $idea->id) }} method="PATCH" class="row">
                @csrf
                @method('patch')

                <div class="mb-3">
                    <textarea class="form-control" id="contentBox" name="contentBox" rows="3">{{ $idea->content }}</textarea>

                    @error('contentBox')
                        <p class="fs-6 mt-2 text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <button class="btn btn-dark btn-sm" type="submit">Save
                    </button>
                </div>
            </form>
        @else
            <p class="fs-6 fw-light text-muted">
                {{ $idea->content }}
            </p>
        @endif
        <div class="d-flex justify-content-between">
            <div>
                @if (auth()->user()->hasLiked(auth()->user(), $idea))
                    <form action="{{ route('ideas.unlike', $idea) }}" method="post" class="fw-light nav-link fs-6">
                        @csrf
                        @method('post')
                        <button>
                            <span class="fas fa-heart me-1">
                            </span> {{ $idea->likes()->count() }}</button>
                    </form>
                @else
                    <form action="{{ route('ideas.like', $idea) }}" method="post" class="fw-light nav-link fs-6">
                        @csrf
                        @method('post')
                        <button>
                            <span class="fas fa-heart me-1">
                            </span> {{ $idea->likes()->count() }}</button>
                    </form>
                @endif

            </div>
            <div>
                <span class="fs-6 fw-light text-muted"> <span class="fas fa-clock"> </span>
                    {{ $idea->created_at }} </span>
            </div>
        </div>

        <a href={{ route('ideas.show', $idea->id) }}>
            Comment
        </a>
        @include('components.comment-form')
    </div>
</div>
