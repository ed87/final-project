@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white pl-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.company.index') }}">Companies</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.company.show', $internship->company->id) }}">{{$internship->company->name}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$internship->title}}</li>
        </ol>
    </nav>
</div>

<section class="jumbotron text-center">
    <div class="container">
        <h1 class="jumbotron-heading">{{$internship->title}}</h1>
        <h3>{{$internship->company->name}}</h3>
        <p class="lead text-muted">{{$internship->description}}</p>

        <p>

            @if($has_applied == false)
            <a href="{{ route('admin.internship.apply', $internship->id) }}" class="btn btn-primary">Apply To Internship</a>
            @else

        <div>
            <form method="POST" action="{{ route('admin.internship-application.destroy', $internship->id) }}">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-danger">
                    Delete Application
                </button>
            </form>
            <br>
            <button type="submit" class="btn btn-sm btn-success">
                <span class="fas fa-check"></span> University Applied
            </button>
        </div>
        @endif

        </p>
    </div>
</section>
@endsection