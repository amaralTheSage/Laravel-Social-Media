@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-8 col-md-6">
                <form class="form mt-5" method="post" name="registerForm" action={{ route('register') }}>
                    @csrf
                    @method('post')



                    <h3 class="text-center text-dark">Register</h3>
                    <div class="form-group ">
                        <label for="username" class="text-dark">Username:</label><br>
                        <input type="text" name="username-box" id="username" class="form-control">
                        @error('username-box')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label for="email" class="text-dark">Email:</label><br>
                        <input type="email" name="email-box" id="email" class="form-control">
                        @error('email-box')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label for="password" class="text-dark">Password:</label><br>
                        <input type="password" name="password" id="password" class="form-control">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label for="password_confirmation" class="text-dark">Confirm Password:</label><br>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">

                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-dark btn-md" value="submit">


                    </div>
                    <div class="text-right mt-2">
                        <a href="/login" class="text-dark">Login here</a>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
@endsection
