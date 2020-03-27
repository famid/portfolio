@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">PORTFOLIO-website</div>

                <div class="card-body">
                    <ul>
                        <li><a href="{{route('skillList')}}">Skills</a></li>
                        <hr>
                        <li><a href="{{route('experienceList')}}">Experience</a></li>
                        <hr>
                        <li><a href="{{route('blogList')}}">Blog</a></li>
                        <hr>
                        <li><a href="{{route('myStoryList')}}">My Story</a></li>
                        <hr>
                        <li><a href="{{route('achievementList')}}">Achievement</a></li>
                        <hr>
                        <li><a href="{{route('resumeList')}}">Upload Resume</a></li>
                        <hr>
                        <li><a href="{{route('educationList')}}">Education</a></li>
                        <hr>
                        <li><a href="{{route('projectList')}}">Project</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
