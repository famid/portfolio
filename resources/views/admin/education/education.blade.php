@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Add Educational Information
                        <button type="button" class="btn btn-outline-primary float-right">
                            <a href="{{route('createEducation')}}"> <i class="fa fa-plus"></i></a>
                    </div>

                    @foreach($data['education']->chunk(3) as $chunkData)
                        <div class="row">
                            @foreach($chunkData as $education)
                                <div class="col-md-4 col-sm-12 col-lg-4">
                                    <div class="card">
                                        <div class="card-header">
                                            {{$education->subject}}

                                        </div>
                                        <div class="card-body">

                                            <p class="card-text">
                                                <span  style="color: #1d643b;">Institution Name </span>: {{$education->institution}} <br>
                                                <span  style="color: #1d643b;">Starting year </span>: {{$education->started_at}} <br>
                                                <span  style="color: #1d643b;">Ending year </span>: {{$education->ended_at}} <br>
                                                <span  style="color: #1d643b;">Educational Status </span>: {{$education->educational_status}}

                                            </p>
                                            <a href="{{route('editEducation', ['id' =>$education->id])}}">
                                                <i class="fa fa-minus"></i>EDIT
                                            </a>
                                            <a href="{{route('deleteEducation', ['id' =>$education->id])}}" class="btn btn-danger"><i class="fa fa-trash">Delete</i></a>
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



