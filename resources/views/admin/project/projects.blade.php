@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Create Project
                        <button type="button" class="btn btn-outline-primary float-right">
                            <a href="{{route('createProject')}}"> <i class="fa fa-plus"></i></a>
                    </div>

                    @foreach($data['projects']->chunk(3) as $chunkData)
                        <div class="row">
                            @foreach($chunkData as $project)
                                <div class="col-md-4 col-sm-12 col-lg-4">
                                    <div class="card">
                                        <div class="card-header">
                                            {{$project->title}}

                                        </div>
                                        <div class="card-body">

                                            <p class="card-text">
                                                <span  style="color: #1d643b;">Project Description </span>: {{$project->description}} <br>
                                                <span  style="color: #1d643b;">Project Link </span>: <a href="{{$project->project_link}}" target="_blank">{{$project->project_link}}</a>  <br>

                                            </p>
                                            <a href="{{route('editProject', ['id' =>$project->id])}}">
                                                <i class="fa fa-minus"></i>EDIT
                                            </a>
                                            <a href="{{route('deleteProject', ['id' =>$project->id])}}" class="btn btn-danger"><i class="fa fa-trash">Delete</i></a>
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



