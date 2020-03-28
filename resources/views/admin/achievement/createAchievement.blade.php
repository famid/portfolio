@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Create Achievement
                    </div>

                    <div class="card-body">
                        <form action="{{route('createAchievement')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="inputTitle">Title</label>
                                <input name="title" type="text" class="form-control" id="inputTitle"  placeholder="Enter title">
                            </div>
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input name="date" type="date" class="form-control" id="date"  placeholder="select your date">
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" type="text" class="form-control" id="description"  placeholder="write shortly"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="file">Upload file</label>
                                <input name="file" type="file" class="form-control" id="file"  placeholder="choose file">
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

