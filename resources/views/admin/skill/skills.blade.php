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
                        <form action="{{route('createSkill')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" value="">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-success">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        Skills
                    </div>

                    <div class="card-body">
                        <ol>
                            @foreach($skills as $skill)
                                <li>
                                    <div class="row">
                                        <div class="col-md-10">
                                            {{$skill->name}}
                                        </div>
                                        <div class="col-md-2">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <button type="button" class="btn btn-outline-primary float-right">
                                                        <a href="{{route('editSkill', ['id' => encrypt($skill->id)])}}">
                                                            <i class="fa fa-minus"></i>
                                                        </a>
                                                    </button>
                                                </div>
                                                <div class="col-md-6">
                                                    <button type="button" class="btn btn-outline-danger float-right">
                                                        <a href="{{route('deleteSkill', ['id' => $skill->id])}}">
                                                            <i class="fa fa-minus"></i>
                                                        </a>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
