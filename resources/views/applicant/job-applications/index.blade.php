@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row pt-4">
        <div class="col-md-12">
            <h3>List of Jobs You Applied To</h3>
        </div>
    </div>
    <div class="row mt-4">
        @forelse($job_applications as $job)
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-0">{{$job->title}}</h5><br>
                    <p class="mb-2 text-muted card-text"><small>{{$job->company->name}}</small></p>
                    <p class="card-text">{!! mb_substr($job->description, 0,100) !!}</p>

                    <div class="d-flex justify-content-between">
                        @if($job_applications->contains($job->id))
                        <button type="submit" class="btn btn-sm btn-outline-success">
                            <span class="fas fa-check"></span> You Applied
                        </button>
                        @else
                        <form method="POST" action="{{ route('applicant.job-application.store', $job->id) }}">
                            @csrf

                            <input type="hidden" name="job_id" value="{{$job->id}}">
                            <button type="submit" class="btn btn-sm btn-outline-primary">
                                Apply
                            </button>
                        </form>
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
                <h5><i class="icon fas fa-info"></i>You have not applied to any jobs yet!</h5>
            </div>
        </div>
        @endforelse
    </div>

    <div class="row pt-2">
        <div class="col-md-12">
            <ul class="pagination pagination-sm m-0 float-right">
                {{ $job_applications->appends(request()->input())->links()}}
            </ul>
        </div>
    </div>
</div>
@endsection