@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white pl-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.company.index') }}">Companies</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$company->name}}</li>
        </ol>
    </nav>
</div>

<section class="jumbotron text-center">
    <div class="container">
        <div class="d-flex justify-content-center">
            <h1 class="jumbotron-heading"> {{$company->name}}</h1>
            @if($company->status == \App\Models\Company::STATUS_ACCEPTED)
            <small><span class="badge badge-success">{{$company->status}}</span></small>
            @elseif($company->status == \App\Models\Company::STATUS_PENDING)
            <small><span class="badge badge-secondary">{{$company->status}}</span></small>
            @elseif($company->status == \App\Models\Company::STATUS_REJECTED)
            <small><span class="badge badge-danger">{{$company->status}}</span></small>
            @endif
        </div>

        <p class="lead text-muted">{{$company->description}}</p>
        <p>
            <!-- <a href="#" class="btn btn-outline-primary my-2">View All Posted Internships</a> -->
        </p>
    </div>
</section>

<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <h3>Available Internships</h3>
            @if($company->status != \App\Models\Company::STATUS_ACCEPTED)
            <div class="alert alert-warning">
                <h5><i class="icon fas fa-exclamation-triangle"></i> You cannot apply to this companies internship since the university has not accepted it yet.</h5>
            </div>
            @endif
        </div>
    </div>
</div>

<div class="album py-5 bg-light">
    <div class="container">
        <div class="row mt-4">
            @forelse($internships as $internship)
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-0">{{$internship->title}}</h5><br>
                        <p class="mb-2 text-muted card-text"><small>{{$company->name}}</small></p>
                        <p class="card-text">{!! mb_substr($internship->description, 0,100) !!}</p>

                        <div class="d-flex justify-content-between">
                            @if($university->internshipApplications->contains($internship->id))
                            <button type="submit" class="btn btn-sm btn-outline-success">
                                <span class="fas fa-check"></span> University Applied
                            </button>
                            @else

                            @if($company->status != \App\Models\Company::STATUS_ACCEPTED)
                            <button class="btn btn-sm btn-outline-secondary" disabled>Apply</button>
                            @else 
                            <a href="{{ route('admin.internship.apply', $internship->id) }}" class="btn btn-sm btn-outline-primary" disabled>Apply</a>
                            @endif

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
                    <h5><i class="icon fas fa-info"></i>There Are No Internships posted by this company yet!</h5>
                </div>
            </div>
            @endforelse
        </div>

        <div class="row pt-2">
            <div class="col-md-12">
                <ul class="pagination pagination-sm m-0 float-right">
                    {{ $internships->appends(request()->input())->links()}}
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection