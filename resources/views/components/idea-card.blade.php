<div class="card my-4">
    <div class="px-3 pt-4 pb-2">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img style="width:50px" class="me-2 avatar-sm rounded-circle" src={{ $idea->user->getImageUrl() }}
                    alt="{{ $idea->user->username ?? 'No user' }}">
                <div>
                    <h5 class="card-title mb-0"><a href={{ route('users.show', ['user' => $idea->user]) }}>
                            {{ $idea->user->username ?? 'No user' }}
                        </a></h5>
                </div>
            </div>

            <span class="fs-6 fw-light text-muted"> <span class="fas fa-clock"> </span>
                {{ $idea->created_at->diffForHumans() }} </span>





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
                @auth {{-- Checks if there is a user logged in --}}
                    @include('components.like-button')
                @endauth
            </div>

        </div>

        @auth {{-- Checks if there is a user logged in --}}

            <div class="d-flex align-items-center justify-content-between"><a href={{ route('ideas.show', $idea->id) }}>
                    Comment
                </a>


                <form action={{ route('ideas.destroy', ['idea' => $idea]) }} method="post">
                    @csrf
                    @method('delete')

                    <a href={{ route('ideas.edit', $idea->id) }}>Edit</a>

                    <button type="submit">🗑️</button>
                </form>
            </div>
            @include('components.comment-form')
        @endauth
    </div>
</div>
