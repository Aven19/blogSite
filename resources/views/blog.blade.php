@extends('layouts.app')
@section('content')
<style>
	.blog-read-more-div {
		line-height: 18px;
		overflow: hidden;
		max-height: 200px; /* line-height * 3 */

	}
	.blog-card-height{
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
		</div>
	</div>
</section>
<section class="blog-list px-3 py-5 p-md-5">
	<div class="container single-col-max-width">
		@foreach($blogs as $key => $blog)
		<div class="item pt-5 mb-5">
			<div class="row g-3 g-xl-0">
				<div class="container">
					<div class="row">
						<div class="col-5 col-md-5 col-sm-12">
						<div class="blog-card-height">
						<img class="img-fluid post-thumb mb-3"
						onError="this.onerror=null;this.src='https://picsum.photos/500/300?random={{$blog->id}}';"
						src="{{ url('storage/blog-image/'.$blog->file) }}" alt="{{$blog->title}}">
							<h3 class="title mb-3">
								<a class="text-link" href="{{ route('blogs.show', $blog->id) }}">
									{{$blog->title}}
								</a>
							</h3>
							<div class="meta mb-1">
								<span class="date">Published {{$blog->created_at->diffForHumans()}}</span><span class="time">Author: {{ $blog->author->first_name }} {{$blog->author->last_name}}</span>
							</div>
						</div>
						</div>
						<div class="col-7 col-md-7 col-sm-12">
							<div class="intro blog-card-height blog-read-more-div">
							{!! html_entity_decode($blog->description) !!}
							</div>
							<a class="text-link" href="{{ route('blogs.show', $blog->id) }}">Read more &rarr;</a>
						</div>
					</div>
				</div>
			</div>
			@endforeach
			{{ $blogs->appends(Request::all())->links('pagination::bootstrap-5') }}
		</div>
</section>
@include('layouts.footer')
@endsection