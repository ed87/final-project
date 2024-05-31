@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white pl-0">
            <li class="breadcrumb-item"><a href="{{ route('company.home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('company.job.index') }}">Jobs</a></li>
            <li class="breadcrumb-item"><a href="{{ route('company.job.show', $job->id) }}">{{$job->title}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit {{$job->title}}</li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-md-5">
            <div class="card card-default mt-4 shadow">
                <div class="card-header">
                    <h5><b>{{ __('Update Job Information') }}</b></h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('company.job.update', $job->id) }}">
                        @method('PUT')
                        @csrf

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') ? old('title') : $job->title }}" id="title" required>

                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea type="text" rows="3" name="description" id="description" class="form-control @error('description') is-invalid @enderror" required>{{old('description') ? old('description') : $job->description }}
                            </textarea>

                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <hr>
                        <div class="form-group row mb-0">
                            <div class="col-md-12 d-flex justify-content-between">
                                <button type="submit" class="btn btn-block btn-primary">
                                    {{ __('Update Job Details') }}
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