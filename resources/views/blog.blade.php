@extends('layouts.app')
@section('content')
<style>
	.text-small-paragraph{
		width: 100%;
		line-height: 1.2em;
		height: 8em;
		background-color: gainsboro;
		overflow: hidden;
		display: -webkit-box;
		-webkit-box-orient: vertical;
		-webkit-line-clamp: 3;
	}
</style>
<section class="cta-section theme-bg-light py-5">
	<div class="container text-center single-col-max-width">
		<h2 class="heading">Want to Create Your Own Blog?</h2>
		<div class="intro">The Best Blog Platform For You</div>
		<div class="single-form-max-width pt-3 mx-auto">
			@if (Route::has('login'))
			<div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
				@auth
				<a href="{{ route('blogs.index') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
				@else
				<a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

				@if (Route::has('register'))
				<a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
				@endif
				@endauth
			</div>
			@endif
			<!--//signup-form-->
		</div>
		<!--//single-form-max-width-->
	</div>
	<!--//container-->
</section>
<section class="blog-list px-3 py-5 p-md-5">
	<div class="container single-col-max-width">

		@foreach($blogs as $key => $blog)
		<div class="item mb-5">
			<div class="row g-3 g-xl-0">
				<div class="col-2 col-xl-3">
					<img class="img-fluid post-thumb " src="{{ url('storage/blog-image/'.$blog->file) }}" alt="{{$blog->title}}">
				</div>
				<div class="col">
					<h3 class="title mb-1"><a class="text-link" href="{{ route('blogs.show', $blog->id) }}">{{$blog->title}}</a></h3>
					<div class="meta mb-1"><span class="date">Published {{$blog->created_at->diffForHumans()}}</span><span class="time">Author: {{ $blog->author->first_name }} {{$blog->author->last_name}}</span></div>
					<div class="intro text-small-paragraph">
						<div class="container">
						{!! html_entity_decode($blog->description) !!}
						</div>
					</div>
					<a class="text-link" href="{{ route('blogs.show', $blog->id) }}">Read more &rarr;</a>
				</div>
				<!--//col-->
			</div>
			<!--//row-->
		</div>
		@endforeach

		{{ $blogs->appends(Request::all())->links('pagination::bootstrap-5') }}

	</div>
</section>
@include('layouts.footer')
@endsection