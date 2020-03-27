@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Edit Experience
                    </div>

                    <div class="card-body">
                        <form action="{{route('updateExperience', ['id' => $experience->id])}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="inputTitle">Title</label>
                                <input name="title" type="text" class="form-control" id="inputTitle"  value="{{$experience->title}}">
                            </div>
                            <div class="form-group">
                                <label for="companyName">Company Name</label>
                                <input name="company" type="text" class="form-control" id="companyName"  value="{{$experience->company}}">
                            </div>
                            <div class="form-group">
                                <label for="startedAt">Started at</label>
                                <input name="started_at" type="date" class="form-control" id="startedAt" value="{{$experience->started_at}}">
                            </div>
                            <div class="form-group">
                                <label for="endedAt">Ended at</label>
                                <input name="ended_at" type="date" class="form-control" id="endedAt" value="{{$experience->ended_at}}">
                            </div>
                            <div class="form-group">
                                <label for="cityName">City</label>
                                <input  name="city" type="text" class="form-control" id="cityName"  placeholder="{{$experience->city}}">
                            </div>
                            <div class="form-group">
                                <label for="countryName">Country</label>
                                <input name="country" type="text" class="form-control" id="countryName"  value="{{$experience->country}}">
                            </div>
                            <div class="form-group">
                                <label for="companyDescription">Company Description</label>
                                <textarea name="company_description" type="text" class="form-control" id="companyDescription" >{{$experience->company_description}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="achievement">Achievement</label>
                                <input name="achievement" type="text" class="form-control" id="achievement"  value="{{$experience->achievement}}">
                            </div>
                            <div class="form-group">
                                <label for="workingStatus">Working Status</label>
                                <select name="still_working" class="custom-select" id="workingStatus" value="{{$experience->still_working}}" >
                                    <option value="1">Still Working</option>
                                    <option value="0">free</option>
                                </select>
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
