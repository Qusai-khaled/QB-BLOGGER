@extends('layouts.app')
@section('content')
<div class="container">
    @include('layouts.messages')
    <div class="row">
        <div class="col-md-9 offset-md-2">
            <h3>Edit Post Form</h3>
            <hr>
                <form action="{{route('posts.update' , ['id'=>$post->id])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{$post->title}}">
                    </div>
                    <div class="form-group">
                    <label for="body">Body</label>
                    <textarea name="body" id="body" cols="30" rows="4" class="form-control"> {{$post->body}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="body">Image</label>
                        <input type="file" name="coverImage" id="coverImage" class="form-control-file">
                    </div>
                    <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
        </div>
    </div>
</div>
@endsection
