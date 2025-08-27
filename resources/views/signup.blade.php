{{-- ==================================== --}}
{{-- bug mdb : label masih turun saat value inputnya ada --}}
{{-- ==================================== --}}
@extends('templates.app')

@section('content')
    <div class="d-block mx-auto w-75 my-5">
        <form method="POST" action="{{ route('sign_up.add') }}">
            {{-- csrf key  --}}
            @csrf
            <!-- 2 column grid layout with text inputs for the first and last names -->
            <div class="row mb-4">
                <div class="col">
                    <div data-mdb-input-init class="form-outline">
                        <input type="text" id="form3Example1" class="form-control @error('first_name') is-invalid @enderror"
                            name="first_name" value="{{ old('first_name') }}" />
                        <label class="form-label" for="form3Example1">First name</label>
                    </div>
                    @error('first_name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col">
                    <div data-mdb-input-init class="form-outline">
                        <input type="text" id="form3Example2"
                            class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                            value="{{ old('last_name') }}" />
                        <label class="form-label" for="form3Example2">Last name</label>
                    </div>
                    @error('last_name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <!-- Email input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <input type="email" id="form3Example3" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" />
                <label class="form-label" for="form3Example3">Email address</label>
            </div>
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror

            <!-- Password input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <input type="password" id="form3Example4" class="form-control @error('password') is-invalid @enderror"
                    name="password" />
                <label class="form-label" for="form3Example4">Password</label>
            </div>
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror

            <!-- Submit button -->
            <button data-mdb-ripple-init class="btn btn-primary btn-block mb-4" type="submit">Sign
                up</button>

            <!-- Register buttons -->
            <div class="text-center">
                <p>or sign up with:</p>
                <button data-mdb-ripple-init type="button" class="btn btn-secondary btn-floating mx-1">
                    <i class="fab fa-facebook-f"></i>
                </button>

                <button data-mdb-ripple-init type="button" class="btn btn-secondary btn-floating mx-1">
                    <i class="fab fa-google"></i>
                </button>

                <button data-mdb-ripple-init type="button" class="btn btn-secondary btn-floating mx-1">
                    <i class="fab fa-twitter"></i>
                </button>

                <button data-mdb-ripple-init type="button" class="btn btn-secondary btn-floating mx-1">
                    <i class="fab fa-github"></i>
                </button>
            </div>
        </form>
    </div>
@endsection
