@extends('layouts.layout')

@section('content')
    <div class="container py-4">
        <div class="row">
            @include('components.sidebar-nav')
            <div class="col-6">

                <form method="post" enctype="multipart/form-data" action="{{ route('users.update', $user->id) }}"
                    class="card">
                    @csrf
                    @method('patch')

                    <div class="px-3 pt-4 pb-2">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center ">

                                <div>
                                    <img style="width:150px" class="me-3 avatar-sm rounded-circle"
                                        src={{ $user->getImageUrl() }} alt="{{ $user->username }}">

                                    <input type="file" name="image-input" class="form-control mt-3">

                                    @error('image-input')
                                        <p>{{ $message }}</p>
                                    @enderror
                                </div>



                                <div>
                                    <input class="form-control" type="text" value="{{ $user->username }}"
                                        name="username-input" />
                                    <p class="fs-6 text-muted">{{ $user->email }}</p>

                                    @error('username-input')
                                        <span>{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>

                        </div>
                        <div class="px-2 mt-4">
                            <h5 class="fs-5"> Biography : </h5>
                            <textarea name="bio-input" type="text" class="form-control" value="Tell us about yourself..." rows="3"> {{ $user->bio ?? '' }}</textarea>
                            @error('bio-input')
                                <span>{{ $message }}</span>
                            @enderror

                            <button class="btn btn-dark btn-sm my-3 " type="submit">Save</button>
                        </div>
                        <div class="d-flex ms-2">
                            <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="fas fa-user me-1">
                                </span> 0 Followers </a>
                            <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="fas fa-brain me-1">
                                </span> {{ $user->ideas()->count() }} </a>
                            <a href="#" class="fw-light nav-link fs-6"> <span class="fas fa-comment me-1">
                                </span> {{ $user->comments()->count() }} </a>
                        </div>
                    </div>
                </form>
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
