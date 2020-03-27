@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Create Blog
                    </div>

                    <div class="card-body">
                        <form action="{{route('createBlog')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="inputTitle">Title</label>
                                <input name="title" type="text" class="form-control" id="inputTitle"  placeholder="Enter title">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" type="text" class="form-control" id="description"  placeholder="write shortly"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="link">Link</label>
                                <input  name="link" type="text" class="form-control" id="link"  placeholder="put your link address">
                            </div>


                            <div class="form-group">
                                <label for="tags">Tags</label>
                                <input name="tags" type="text" class="form-control" id="tags"  placeholder="Enter your tags">
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
