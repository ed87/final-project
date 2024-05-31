@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white pl-0">
            <li class="breadcrumb-item"><a href="{{ route('company.home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('company.internship.index') }}">Internship</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$internship->title}}</li>
        </ol>
    </nav>
</div>

<section class="jumbotron text-center">
    <div class="container">
        <h1 class="jumbotron-heading">{{$internship->title}}</h1>
        <p class="lead text-muted">{{$internship->description}}</p>
        <p>
            <a href="{{ route('company.internship.destroy', $internship->id) }}" class="btn btn-danger my-2">Delete</a>
            <a href="{{ route('company.internship.edit', $internship->id) }}" class="btn btn-secondary my-2">Edit Internship</a>
        </p>
    </div>
</section>

<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <h2>University Applicants</h2>
        </div>
    </div>
</div>

<div class="album py-5 bg-light">
    <div class="container">

        <div class="row">
            @forelse($internship->universityApplicants as $university)
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">{{$university->name}}</h5>
                            @if($university->pivot->status == \App\Models\Internship::STATUS_ACCEPTED)
                            <h5><small><span class="badge badge-success mb-0"> {{$university->pivot->status}}</span></small></h5>
                            @endif

                            @if($university->pivot->status == \App\Models\Internship::STATUS_PENDING)
                            <h5><small><span class="badge badge-secondary mb-0"> {{$university->pivot->status}}</span></small></h5>
                            @endif

                            @if($university->pivot->status == \App\Models\Internship::STATUS_REJECTED)
                            <h5><small><span class="badge badge-danger mb-0"> {{$university->pivot->status}}</span></small></h5>
                            @endif

                        </div>
                        <p class="card-text text-muted">{{$university->email}}</p>
                        <p class="card-text">{{$university->name}} applied for the internship position {{$internship->title}}.</p>
                        <p>
                            <a href="{{ route('admin.internship.downloadinternshipletter', ['university' => $university, 'file' => $university->pivot->internship_letter])}}" class="btn btn-sm btn-outline-primary">
                                download Internship Letter
                            </a>
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <!-- <button type="button" class="btn btn-sm btn-outline-danger">Reject</button> -->
                            <!-- <button type="button" class="btn btn-sm btn-outline-primary">Accept</button> -->

                            @if($university->pivot->status != \App\Models\Internship::STATUS_REJECTED)
                            <form method="POST" action="{{ route('company.internship-application.update', $university->pivot->id) }}">
                                @method('PUT')
                                @csrf
                                <input type="hidden" name="reject" value="{{\App\Models\Internship::STATUS_REJECTED}}">
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    Reject
                                </button>
                            </form>
                            @endif

                            @if($university->pivot->status == \App\Models\Internship::STATUS_ACCEPTED || $university->pivot->status == \App\Models\Internship::STATUS_REJECTED)
                            <form method="POST" action="{{ route('company.internship-application.update', $university->pivot->id) }}">
                                @method('PUT')
                                @csrf
                                <input type="hidden" name="pending" value="{{\App\Models\Internship::STATUS_PENDING}}">
                                <button type="submit" class="btn btn-sm btn-outline-warning">
                                    Revert
                                </button>
                            </form>
                            @endif

                            @if($university->pivot->status == \App\Models\Internship::STATUS_PENDING)
                            <form method="POST" action="{{ route('company.internship-application.update', $university->pivot->id) }}">
                                @method('PUT')
                                @csrf
                                <input type="hidden" name="accept" value="{{\App\Models\Internship::STATUS_ACCEPTED}}">
                                <button type="submit" class="btn btn-sm btn-success">
                                    Accept
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-md-12">
                <div class="alert alert-warning">
                    <h5><i class="icon fas fa-exclamation-triangle"></i> This job has no Applicants yet!</h5>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection