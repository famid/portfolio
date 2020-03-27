@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Create Project
                    </div>

                    <div class="card-body">
                        <form action="{{route('createProject')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="title">Project Title</label>
                                <input name="title" type="text" class="form-control" id="title"  placeholder="Enter your title">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" type="text" class="form-control" id="description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="projectLink">Project Link</label>
                                <input name="project_link" type="text" class="form-control" id="projectLink"  placeholder="attach your link">
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

