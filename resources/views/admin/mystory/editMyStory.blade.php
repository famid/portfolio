@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Edit MyStory
                    </div>

                    <div class="card-body">
                        <form action="{{route('updateMyStory', ['id'=>$myStory->id])}}" method="post">
                            @csrf
                            <div class="form-group">
                                    <textarea type="text" class="form-control" name="description" >
                                        {!! $myStory->description !!}
                                    </textarea>
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

