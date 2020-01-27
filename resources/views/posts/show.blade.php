@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-2">
    <div class="col-md-7 offset-md-3">
        <div class="card mb-3" style="min-width: 18rem;">
            {{-- <img src="{{asset('storage/coverImages/' . $post->image)}}" alt="" height="200"> --}}
            <img src="{{asset('uploads/coverImages/' . $post->image)}}" alt="" height="200">
            <div class="card-body">
                <div class="card-title">
                    <h4> {{$post->title}}</h4>
                </div>
                <div class="card-text">
                    {{$post->body}}
                </div>
                <hr>
                <p style="color:brown;">created by: {{$post->user->name}}</p>
                <small class="text-muted"> <p> {{$post->created_at}}</p></small>
                @auth
                    @if (Auth()->user()->id == $post->user_id )
                        <div>
                            <a href="{{route('posts.edit',['id'=>$post->id])}}" class="btn btn-primary float-left"> Edit</a>
                            <form action="{{route('posts.delete', ['id' => $post->id])}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger float-right"> Delete</button>
                            </form>
                        </div>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</div>
</div>
@endsection
