@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Create Experience
                    </div>

                    <div class="card-body">
                        <form action="{{route('createExperience')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="inputTitle">Title</label>
                                <input name="title" type="text" class="form-control" id="inputTitle"  placeholder="Enter title">
                            </div>
                            <div class="form-group">
                                <label for="companyName">Company Name</label>
                                <input name="company" type="text" class="form-control" id="companyName"  placeholder="Enter name">
                            </div>
                            <div class="form-group">
                                <label for="startedAt">Started at</label>
                                <input name="started_at" type="date" class="form-control" id="startedAt"  placeholder="select your date">
                            </div>
                            <div class="form-group">
                                <label for="endedAt">Ended at</label>
                                <input name="ended_at" type="date" class="form-control" id="endedAt"  placeholder="select your date">
                            </div>
                            <div class="form-group">
                                <label for="cityName">City</label>
                                <input  name="city" type="text" class="form-control" id="cityName"  placeholder="Enter your city name">
                            </div>
                            <div class="form-group">
                                <label for="countryName">Country</label>
                                <input name="country" type="text" class="form-control" id="countryName"  placeholder="Enter your city name">
                            </div>
                            <div class="form-group">
                                <label for="companyDescription">Company Description</label>
                                <textarea name="company_description" type="text" class="form-control" id="companyDescription"  placeholder="write shortly"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="achievement">Achievement</label>
                                <input name="achievement" type="text" class="form-control" id="achievement"  placeholder="Enter your achievement">
                            </div>
                            <div class="form-group">
                                <label for="workingStatus">Working Status</label>
                                <select name="still_working" class="custom-select" id="workingStatus" >
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
