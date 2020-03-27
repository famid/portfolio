@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                      Edit Blog
                    </div>

                    <div class="card-body">
                        <form action="{{route('updateBlog',['id'=> $blog->id])}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="inputTitle">Title</label>
                                <input name="title" type="text" class="form-control" id="inputTitle"  value="{{$blog->title}}">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" type="text" class="form-control" id="description">{!!$blog->description!!}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="link">Link</label>
                                <input  name="link" type="text" class="form-control" id="link"  value="{{$blog->link}}">
                            </div>


                            <div class="form-group">
                                <label for="tags">Tags</label>
                                <input name="tags" type="text" class="form-control" id="tags"  value="{{$blog->tags}}">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-success">Save</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
