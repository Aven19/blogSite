@extends('layouts.app')
@section('content')
@include('layouts.side-nav')
<div class="main-wrapper">
    <section class="cta-section theme-bg-light py-5">
        <div class="container">
            <div class="single-form-max-width mx-auto">
                <h2 class="heading ">{{ __('Register') }}</h2>
                <div class="intro pt-3">Create a unique and beautiful blog easily yourself.</div>
                <form method="POST" action="{{ route('register') }}" class="signup-form row g-2 g-lg-2 align-items-center pt-5 registration_form">
                    @csrf
                    <div class="col-6 col-md-6">
                        <label class="pb-3 label-text" for="first_name">First Name <span class="text-danger">*</span></label>
                        <input type="text" value="{{old('first_name')}}" id="first_name" name="first_name" class="form-control @error('first_name') is-invalid @enderror me-md-1" placeholder="Enter Your First Name">
                        @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-6 col-md-6">
                        <label class="pb-3 label-text" for="last_name">Last Name <span class="text-danger">*</span></label>
                        <input type="text" value="{{old('last_name')}}" id="last_name" name="last_name" class="form-control @error('last_name') is-invalid @enderror me-md-1" placeholder="Enter Your Last Name">
                        @error('last_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-12 col-md-12">
                        <label class="pb-3 label-text" for="email">Email Address <span class="text-danger">*</span></label>
                        <input type="text" value="{{old('email')}}" id="email" name="email" class="form-control @error('email') is-invalid @enderror me-md-1" placeholder="Enter Your Email Address">
                        @error('mobile')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-12 col-md-12">
                        <label class="pb-3 label-text" for="mobile">Mobile Number <span class="text-danger">*</span></label>
                        <input type="text" value="{{old('mobile')}}" id="mobile" name="mobile" class="form-control @error('mobile') is-invalid @enderror me-md-1" placeholder="Enter Your Mobile Number">
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
                    <div class="col-12 col-md-12">
                        <label class="pb-3 label-text" for="password_confirmation">Confirm Password <span class="text-danger">*</span></label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror me-md-1" placeholder="Confirm Your Password">
                        @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-9 col-md-9">
                    </div>
                    <div class="col-12 col-md-12">
                        <button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
                    </div>

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
