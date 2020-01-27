@extends('layouts.app')
@section('content')
<div class="container">
    @include('layouts.messages')
    <h2> List of all Posts</h2>
    <hr>
    <div class="row">
        <div class="col-md-9 ">
                <div class="row">
                    @foreach($posts as $post)
                        <div class="col-md-4">
                            <div class="card mb-3" >
                                <img src="{{asset('storage/coverImages/' . $post->image)}}" alt="" height="200">
                                <div class="card-header bg-dark text-white">
                                        {{$post->title}}
                                </div>
                                <div class="card-body">
                                    <div class="card-text">
                                        {{$post->body}}
                                    </div>
                                    <hr>
                                    <p style="color:brown;">created by: {{$post->user->name}}</p>
                                <a href="{{'/posts/'. $post->id}}" class="btn btn-primary"> Show Post</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
        </div>
        <div class="col-md-3">
                <div class="card mb-3" >
                        <div class="card-header bg-info text-white"> Stats.</div>
                        <div class="card-body">
                        <p class="card-text"> All Posts: {{$count}}</p>
                        </div>
                    </div>
        </div>
    </div>
    <div class="row ">
        <div class="col-md-12 d-flex justify-content-center ">
            {{$posts->links()}}
        </div>
    </div>
</div>
@endsection
