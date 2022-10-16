@extends('layouts.app')
@extends('layouts.side-nav')
@section('content')
<div class="main-wrapper">

    @if (session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('status') }}.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <div class="text-center">
    {{ __('You are logged in!') }}
    </div>
    @endif


    <section class="blog-list px-3 py-5 p-md-5">
	<div class="container single-col-max-width">

		@foreach($blogs as $key => $blog)
		<div class="item mb-5">
			<div class="row g-3 g-xl-0">
				<div class="col-2 col-xl-3">
				<img class="img-fluid post-thumb" 
				onError="this.onerror=null;this.src='https://picsum.photos/500/300?random=4';"
				src="{{ url('storage/blog-image/'.$blog->file) }}" alt="{{$blog->title}}">
				</div>
				<div class="col">
					<h3 class="title mb-1"><a class="text-link" href="blog-post.html">{{$blog->title}}</a></h3>
					<div class="meta mb-1"><span class="date">Published {{$blog->created_at->diffForHumans()}}</span><span class="time">Author: {{ $blog->author->first_name }}  {{$blog->author->last_name}}</span></div>
					<div class="intro">{{$blog->description}}</div>
					<a class="text-link" href="blog-post.html">Read more &rarr;</a>
				</div>
				<!--//col-->
			</div>
			<!--//row-->
		</div>
		@endforeach

		<nav class="blog-nav nav nav-justified my-5">
			<a class="nav-link-prev nav-item nav-link d-none rounded-left" href="#">Previous<i class="arrow-prev fas fa-long-arrow-alt-left"></i></a>
			<a class="nav-link-next nav-item nav-link rounded" href="#">Next<i class="arrow-next fas fa-long-arrow-alt-right"></i></a>
		</nav>

	</div>
</section>
    @include('layouts.footer')
</div>
@endsection