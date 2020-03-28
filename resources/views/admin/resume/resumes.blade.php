@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Upload Resume
                    </div>

                    <div class="card-body">
                        <form action="{{route('createResume')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" id="title" class="form-control" name="title" value="">
                            </div>
                            <div class="form-group">
                                <label for="file"></label>
                                <input type="file" id="file" class="form-control" name="file" value="">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-success">Save</button>
                            </div>
                        </form>
                    </div>
                    @foreach($data['resumes']->chunk(3) as $chunkData)
                        <div class="row">
                            @foreach($chunkData as $resume)
                                <div class="col-md-4 col-sm-12 col-lg-4">
                                    <div class="card">
                                        <div class="card-header">
                                            {{$resume->title}}
                                        </div>
                                        <div class="card-body">

                                            <p class="card-text">
                                                <a href="{{route('downloadResumeFile', ['id' => $resume->id])}}">
                                                    <i class="fa fa-download"></i>
                                                    Download File
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach

                </div>

            </div>
        </div>
    </div>
@endsection


