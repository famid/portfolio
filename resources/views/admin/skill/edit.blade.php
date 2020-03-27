@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Add Skill
                    </div>

                    <div class="card-body">
                        <form action="{{route('updateSkill', ['id' => $skill->id])}}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" value="{{$skill->name}}">
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
