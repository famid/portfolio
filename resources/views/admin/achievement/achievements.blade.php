@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
               Create Achievement
                <button type="button" class="btn btn-outline-primary float-right">
                    <a href="{{route('createAchievement')}}"> <i class="fa fa-plus"></i></a>

                </button>

            </div>
        </div>
        @foreach($data['achievements']->chunk(3) as $chunkData)
            <div class="row">
                @foreach($chunkData as $achievement)
                    <div class="col-md-4 col-sm-12 col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                {{$achievement->title}}

                            </div>
                            <div class="card-body">

                                <p class="card-text">
                                    <span  style="color: #1d643b;">Date </span>: {{$achievement->date}} <br>
                                    <span  style="color: #1d643b;">Description </span>: {{$achievement->description}} <br>
                                    <a href="{{route('downloadAchievementFile', ['id' => $achievement->id])}}">
                                        <i class="fa fa-download"></i>
                                        Download File
                                    </a>
                                </p>
                                <a href="{{route('editAchievement', ['id' =>$achievement->id])}}">
                                    <i class="fa fa-minus"></i>EDIT
                                </a>
                                <a href="{{route('deleteAchievement', ['id' =>$achievement->id])}}" class="btn btn-danger"><i class="fa fa-minus">Delete</i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
@endsection

