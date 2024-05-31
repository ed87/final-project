@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white pl-0">
            <li class="breadcrumb-item"><a href="{{ route('applicant.home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.company.index') }}">Companies</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.company.show', $internship->company->id) }}">{{$internship->company->name}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Apply to {{$internship->title}} Internship</li>
        </ol>
    </nav>
</div>


<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-md-5">
            <div class="card card-default mt-4 shadow">
                <div class="card-header">
                    <h5><b>{{ __('Apply to') }} {{$internship->title}} Internship</b></h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.internship-application.store', $internship->id) }}" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="internship_id" value="{{$internship->id}}">
                        <div class="form-group">
                            <label for="internship_letter">Upload Your Internship Request Letter</label>
                            <input type="file" name="internship_letter" class="form-control @error('internship_letter') is-invalid @enderror" id="internship_letter" required>

                            @error('internship_letter')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <hr>
                        <div class="form-group row mb-0">
                            <div class="col-md-12 d-flex justify-content-between">
                                <button type="submit" class="btn btn-block btn-primary">
                                    {{ __('Apply To Intership') }}
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