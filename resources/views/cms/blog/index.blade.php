@extends('layouts.app')

@section('content')
@include('layouts.side-nav')
<style>
	@media(max-width: 768px) {
		.full-width {
			width: 100%;
		}
	}
</style>
<div class="main-wrapper">

	<section class="cta-section theme-bg-light py-5">
		<div class="container text-center">
			<div class="d-flex justify-content-between align-items-center pb-5">
				<h3>Blogs List</h3>
				<div>Total Record:{{$blogs->total()}}</div>
			</div>
			<div class="row">
				<form method="get" action="" class="signup-form row g-2 g-lg-2 align-items-center">
					@csrf
					<div class="col-lg-9 col-md-9">
						<label class="sr-only" for="search_text">Enter title to search</label>
						<input type="text" id="search_text" name="q" class="form-control me-md-1" placeholder="Enter title to search..." value="{{request()->get('q')}}" autocomplete="off">
					</div>
					<div class="col-lg-2 col-md-2">
						<button type="submit" class="btn btn-primary full-width" >Search</button>
					</div>
					<div class="col-lg-1 col-md-1">
						<a href="{{ route('blogs.create') }}" class="btn btn-primary full-width" >Add</a>
					</div>
				</form>
			</div>

		</div>
	</section>
	<section class="blog-list px-3 py-5 p-md-5">
		<div class="container single-col-max-width">
			<table class="table table-stripped">
				<thead>
					<tr>
						<th scope="col">Sr. no</th>
						<th scope="col">Title</th>
						<th scope="col">Thumbnail Image</th>
						<th scope="col">created_at</th>
						<th scope="col">Actions</th>
					</tr>
				</thead>
				<tbody>


					@foreach($blogs as $key => $blog)
					<tr>
						<th scope="row">{{ $loop->iteration }}</th>
						<td>{{ $blog->title }}</td>
						<td>
							<img class="img-fluid post-thumb" 
							onError="this.onerror=null;this.src='https://picsum.photos/500/300?random={{$blog->id}}';"
							src="{{ url('storage/blog-image/'.$blog->file) }}" alt="{{$blog->title}}">
						</td>
						<td>{{ $blog->created_at }}</td>
						<td>
							<a href="{{ route('blogs.edit',$blog->id) }}" class="" style="cursor: pointer;">Edit</i></a>
							<form action="{{ route('blogs.destroy',$blog->id) }}" id="blog_{{$blog->id}}" method="Post">
								@csrf
								@method('DELETE')
								<a class="text-danger" style="cursor: pointer;" href="javascript:document.getElementById('blog_{{$blog->id}}').submit();" onclick="return confirm('Are you sure you want to delete this blog?');">
									Delete
								</a>
							</form>
						</td>
					</tr>


					@endforeach
				</tbody>
			</table>
			{{ $blogs->appends(Request::all())->links('pagination::bootstrap-5') }}

		</div>
	</section>
	@include('layouts.footer')
</div>
@endsection