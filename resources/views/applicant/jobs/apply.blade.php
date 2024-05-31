@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white pl-0">
            <li class="breadcrumb-item"><a href="{{ route('applicant.home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('applicant.home') }}">Jobs</a></li>
            <li class="breadcrumb-item"><a href="{{ route('applicant.home') }}">{{$job->title}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Apply</li>
        </ol>
    </nav>
</div>


<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-md-5">
            <div class="card card-default mt-4 shadow">
                <div class="card-header">
                    <h5><b>{{ __('Apply to') }} {{$job->title}} Job</b></h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('applicant.job-application.store', $job->id) }}" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="job_id" value="{{$job->id}}">
                        <div class="form-group">
                            <label for="cv_file">Upload Your CV</label>
                            <input type="file" name="cv_file" class="form-control @error('cv_file') is-invalid @enderror" id="cv_file" required>

                            @error('cv_file')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <hr>
                        <div class="form-group row mb-0">
                            <div class="col-md-12 d-flex justify-content-between">
                                <button type="submit" class="btn btn-block btn-primary">
                                    {{ __('Apply To Job') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection