@extends('layouts.layout')

@section('content')
    <div class="container py-4">
        <div class="row">
            @include('components.sidebar-nav')
            <div class="col-6">
                <div class="card">
                    <div class="px-3 pt-4 pb-2">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <img style="width:150px" class="me-3 avatar-sm rounded-circle" src={{ $user->getImageUrl() }}
                                    alt="{{ $user->username }}">
                                <div>
                                    <h3 class="card-title mb-0"> {{ $user->username }}
                                    </h3>
                                    <p class="fs-6 text-muted">{{ $user->email }}</p>
                                </div>
                            </div>
                            @if (Auth::id() === $user->id)
                                <a href="{{ route('users.edit', ['user' => $user]) }}">Edit</a>
                            @endif
                        </div>
                        <div class="px-2 mt-4">
                            <h5 class="fs-5"> About : </h5>
                            <p class="fs-6 fw-light">
                                {{ $user->bio ?? '' }}
                            </p>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex">
                                    <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="fas fa-user me-1">
                                        </span> {{ $user->followers()->count() }} Followers </a>
                                    <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="fas fa-brain me-1">
                                        </span> {{ $user->ideas()->count() }} </a>
                                    <a href="#" class="fw-light nav-link fs-6"> <span class="fas fa-comment me-1">
                                        </span> {{ $user->comments()->count() }} </a>
                                </div>
                                @auth
                                    @if (Auth::id() !== $user->id)
                                        @if (Auth::user()->follows($user))
                                            <form action="{{ route('users.unfollow', $user->id) }}" method="POST">
                                                @csrf
                                                @method('post')


                                                <div class="mt-3">
                                                    <button class="btn btn-primary btn-sm" type="submit"> unfollow </button>
                                                </div>
                                            </form>
                                        @else
                                            <form action="{{ route('users.follow', $user->id) }}" method="POST">
                                                @csrf
                                                @method('post')


                                                <div class="mt-3">
                                                    <button class="btn btn-primary btn-sm" type="submit"> Follow </button>
                                                </div>
                                            </form>
                                        @endif
                                    @endif
                                @endauth
                            </div>

                        </div>
                    </div>
                </div>
                <hr>
                <div class="mt-3">
                    @forelse ($user->ideas as $idea)
                        @include('components.idea-card')
                    @empty
                        <p>No ideas yet</p>
                    @endforelse
                </div>
            </div>
            <div class="col-3">
                @include('components.who-to-follow')
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
@endsection
