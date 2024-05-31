@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row pt-4">
        <div class="col-md-12">
            <h3>Internships University Applied To</h3>
        </div>
    </div>
    <div class="row mt-4">
        @forelse($internship_applications as $internship)
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-0">{{$internship->title}}</h5><br>
                    <p class="mb-2 text-muted card-text"><small>{{$internship->company->name}}</small></p>
                    <p class="card-text">{!! mb_substr($internship->description, 0,100) !!}</p>

                    <div class="d-flex justify-content-between">
                        @if($internship_applications->contains($internship->id))
                        <button type="submit" class="btn btn-sm btn-outline-success">
                            <span class="fas fa-check"></span> University Applied
                        </button>
                        @else
                        <form method="POST" action="{{ route('admin.internship-application.store', $internship->id) }}">
                            @csrf

                            <input type="hidden" name="job_id" value="{{$internship->id}}">
                            <button type="submit" class="btn btn-sm btn-outline-primary">
                                Apply
                            </button>
                        </form>
                        @endif

                        <a href="{{ route('admin.internship.show', $internship->id) }}" class="card-link">See Details</a>
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
                {{ $internship_applications->appends(request()->input())->links()}}
            </ul>
        </div>
    </div>
</div>
@endsection