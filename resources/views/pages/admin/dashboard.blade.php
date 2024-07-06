@extends('layouts.layout')

@section('content')
    <div class="container py-4">
        <div class="row">
            @include('components.sidebar-nav')
            <div class="col-6">
                @auth()
                    @include('components.submit-idea-form')
                @endauth

                @guest
                    <h2>Log in to share your ideas!</h2>
                @endguest

                <div class="mt-3">

                </div>
            </div>
            <div class="col-3">
                @include('components.search-bar')
                @include('components.who-to-follow')
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
@endsection
