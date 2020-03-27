@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Input Educational Information
                    </div>

                    <div class="card-body">
                        <form action="{{route('createEducation')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="institution">Institution Name</label>
                                <input name="institution" type="text" class="form-control" id="institution"  placeholder="Enter your institution name">
                            </div>
                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <input  name="subject" type="text" class="form-control" id="subject"  placeholder="What subjects do you study?">
                            </div>
                            <div class="form-group">
                                <label for="startedAt">Stared year</label>
                                <input  name="started_at" type="date" class="form-control" id="startedAt"  placeholder="started year">
                            </div>
                            <div class="form-group">
                                <label for="endedAt">Ended year</label>
                                <input  name="ended_at" type="date" class="form-control" id="endedAt"  placeholder="ended year">
                            </div>

                            <div class="form-group">
                                <label for="educationalStatus">educational Status</label>
                                <select name="educational_status" class="custom-select" id="educationalStatus" >
                                    <option value="Hsc Passed">Hsc Passed</option>
                                    <option value="Bsc Passed">Bsc Passed</option>
                                    <option value="Studying">Studying</option>
                                    <option value="Dropped Out">Dropped Out</option>
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

