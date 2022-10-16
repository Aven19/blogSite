@extends('layouts.app')
@section('content')
@include('layouts.side-nav')
<div class="main-wrapper">
    <section class="cta-section theme-bg-light py-5" style="height: 90vh;">
        <div class="container">
            <h2 class="heading  text-center">{{ __('Login') }}</h2>
            <div class="single-form-max-width pt-3 mx-auto">
                <form method="POST" action="{{ route('login') }}" class="login_form signup-form row g-2 g-lg-2 align-items-center">
                    @csrf

                    <div class="col-12 col-md-12">
                        <label class="pb-3 label-text" for="mobile">Mobile Number <span class="text-danger">*</span></label>
                        <input type="text" id="mobile" name="mobile" class="form-control @error('mobile') is-invalid @enderror me-md-1" placeholder="Your Mobile Number" autocomplete="off">
                        @error('mobile')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-12 col-md-12">
                        <label class="pb-3 label-text" for="password">Password <span class="text-danger">*</span></label>
                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror me-md-1" placeholder="Enter Your Password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <!-- <div class="col-3 col-md-3 form-check">
                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                </div> -->
                    <div class="col-9 col-md-9">
                    </div>
                    <div class="col-12 col-md-12">
                        <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
                    </div>
                    @if (Route::has('password.request'))
                    <!-- <a class="btn btn-link" href="{{ route('password.request') }}"> -->
                    <!-- {{ __('Forgot Your Password?') }} -->
                    <!-- </a> -->
                    @endif
                </form>
                <!--//signup-form-->
            </div>
            <!--//single-form-max-width-->
        </div>
        <!--//container-->
    </section>
    @include('layouts.footer')
</div>
@endsection
@section('scripts')
@vite([
    "resources/assets/custom-file-validation.js"
])
@endsection