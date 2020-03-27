@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Add MyStory
                    </div>

                    <div class="card-body">
                        <form action="{{route('createMyStory')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <textarea type="text" class="form-control" name="description" value="">
                                </textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-success">Save</button>
                            </div>
                        </form>
                    </div>
                    @foreach($data['myStories']->chunk(3) as $chunkData)
                        <div class="row">
                            @foreach($chunkData as $myStory)
                                <div class="col-md-4 col-sm-12 col-lg-4">
                                    <div class="card">
                                        <div class="card-header">
                                            My Story :{{$myStory->id}}

                                        </div>
                                        <div class="card-body">
                                            <p class="card-text">
                                                <span  style="color: #1d643b;">{{$myStory->description}} </span>:
                                            </p>
                                            <button class="btn btn-outline-success float-md-right">
                                                <a href="{{route('editMyStory', ['id'=> $myStory->id])}}">
                                                    <i class="fa fa-minus"></i>
                                                </a>
                                            </button>

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

