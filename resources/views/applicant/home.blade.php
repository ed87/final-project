@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row pt-4">
        <div class="col-md-12">
            <h3>Available Jobs</h3>
        </div>
    </div>
    <div class="row mt-4">
        @forelse($jobs as $job)
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-0">{{$job->title}}</h5><br>
                    <p class="mb-2 text-muted card-text"><small>{{$job->company->name}} 
                    <span class="badge badge-secondary">{{$job->company->status}}</span>
                    </small></p>
                    <p class="card-text">{!! mb_substr($job->description, 0,100) !!}</p>

                    <div class="d-flex justify-content-between">
                        @if($job_applications->contains($job->id))
                        <button type="submit" class="btn btn-sm btn-outline-success">
                            <span class="fas fa-check"></span> You Applied
                        </button>
                        @else
                        <a href="{{ route('applicant.job.apply', $job->id) }}" class="btn btn-sm btn-outline-primary">Apply</a>
                        @endif

                        <a href="{{ route('applicant.job.show', $job->id) }}" class="card-link">See Details</a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-md-12">
            <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-info"></i>There Are No Job Results To Show!</h5>
            </div>
        </div>
        @endforelse
    </div>

    <div class="row pt-2">
        <div class="col-md-12">
            <ul class="pagination pagination-sm m-0 float-right">
                {{ $jobs->appends(request()->input())->links()}}
            </ul>
        </div>
    </div>
</div>
@endsection