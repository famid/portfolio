@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Experience
                <button type="button" class="btn btn-outline-primary float-right">
                    <a href="{{route('createExperience')}}"> <i class="fa fa-plus"></i></a>

                </button>

            </div>
        </div>

        @foreach($data['experiences']->chunk(3) as $chunkData)
            <div class="row">
                @foreach($chunkData as $experience)
                    <div class="col-md-4 col-sm-12 col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                {{$experience->title}}

                            </div>
                            <div class="card-body">
                                <h5 class="card-title">
                                    <p>Company Name: {{$experience->company}}</p>
                                    Description : {{$experience->company_description}}
                                </h5>
                                <p class="card-text">
                                    <span  style="color: #1d643b;">Started_at </span>: {{$experience->started_at}} <br>
                                    <span  style="color: #1d643b;">Ended_at </span>: {{$experience->ended_at}} <br>
                                    <span  style="color: #1d643b;">City </span>: {{$experience->city}} <br>
                                    <span  style="color: #1d643b;">Country </span>: {{$experience->country}} <br>
                                    <span  style="color: #1d643b;">Achievement </span>: {{$experience->achievement}} <br>
                                    <span  style="color: #1d643b;">Working_Status </span>: {{$experience->still_working}}
                                </p>
                                <a href="{{route('editExperience', ['id' => encrypt($experience->id)])}}">
                                    <i class="fa fa-minus"></i>EDIT
                                </a>
                                <a href="{{route('deleteExperience', ['id' =>$experience->id])}}" class="btn btn-danger"><i class="fa fa-minus">Delete</i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
@endsection
