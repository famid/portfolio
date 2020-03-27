@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Create Blog
                <button type="button" class="btn btn-outline-primary float-right">
                    <a href="{{route('createBlog')}}"> <i class="fa fa-plus"></i></a>

                </button>

            </div>
        </div>
        @foreach($data['blogs']->chunk(3) as $chunkData)
            <div class="row">
                @foreach($chunkData as $blog)
                    <div class="col-md-4 col-sm-12 col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                {{$blog->title}}

                            </div>
                            <div class="card-body">
                                <h5 class="card-title">
                                    <p>Link: {{$blog->link}}</p>
                                </h5>
                                <p class="card-text">
                                    <span  style="color: #1d643b;">Tags </span>: {{$blog->tags}} <br>
                                    <span  style="color: #1d643b;">Description </span>: {{$blog->description}} <br>

                                </p>
                                <a href="{{route('editBlog', ['id'=> $blog->id])}}">
                                    <i class="fa fa-minus"></i>EDIT
                                </a>
                                <a href="{{route('deleteBlog', ['id'=> $blog->id])}}" class="btn btn-danger"><i class="fa fa-minus">Delete</i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
@endsection
