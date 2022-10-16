@extends('layouts.app')
@section('content')

<style>
    .jumbotron {
        background: url("https://images.pexels.com/photos/799443/pexels-photo-799443.jpeg") no-repeat center center;
        -webkit-background-size: 100% 100%;
        -moz-background-size: 100% 100%;
        -o-background-size: 100% 100%;
        background-size: 100% 100%;
    }

    .blog-wrapper img {
        width: 100%;
        max-width: 400px;
        height: auto;
    }
</style>

<div class="jumbotron p-4 p-md-5 mb-4" style='background-image: url("https://picsum.photos/500/300?random=1"); background-size: 100%; height: 400px;'>
    <div class="col-md-6 px-0">
        <h1 class="display-4 pt-5 fst-italic"></h1>
        <p class="lead pt-5 my-3"></p>
    </div>
</div>

<article class="blog-post px-3 py-5 p-md-5">
    <div class="container text-center">
        <h3 class="text-center">{{$blog->title}}</h3>


    </div>
    <div class="container text-center single-col-max-width">
        <header class="blog-post-header">

        </header>
        <div class="d-flex justify-content-between bd-highlight pt-5 mb-3">
            <div class="p-2 bd-highlight">
                <div class="meta mb-1">
                    <span class="date">Published {{$blog->created_at->diffForHumans()}}</span>
                    <span class="time">Author: {{ $blog->author->first_name }} {{$blog->author->last_name}}</span>
                </div>
            </div>
            <div class="p-2 bd-highlight"></div>
            <div class="p-2 bd-highlight"><a href="{{ url()->previous() }}">Go Back</a></div>
        </div>

        <div class="text-break blog-post-body pt-5">
            <div class="container blog-wrapper">
                {!! html_entity_decode($blog->description) !!}
            </div>
        </div>
    </div>

</article>
@include('layouts.footer')
@endsection