@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white pl-0">
            <li class="breadcrumb-item"><a href="{{ route('applicant.home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('applicant.home') }}">Jobs</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$job->title}}</li>
        </ol>
    </nav>
</div>

<section class="jumbotron text-center">
    <div class="container">
        <h1 class="jumbotron-heading">{{$job->title}}</h1>
        <h3>{{$job->company->name}}</h3>
        <p class="lead text-muted">{{$job->description}}</p>

        <p>

            @if($has_applied == false)
            <a href="{{ route('applicant.job.apply', $job->id) }}" class="btn btn-primary">Apply To Job</a>
            @else

        <div>
            <form method="POST" action="{{ route('applicant.job-application.destroy', $job->id) }}">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-danger">
                    Delete Application
                </button>
            </form>
            <br>
            <button type="submit" class="btn btn-sm btn-success">
                <span class="fas fa-check"></span> You Applied
            </button>
        </div>
        @endif

        </p>
    </div>
</section>
@endsection