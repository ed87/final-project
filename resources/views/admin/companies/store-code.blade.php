@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row pt-4">
        <div class="col-md-12">
            <h3>List of companies</h3>
        </div>
    </div>
    <!-- name, address, phone, email, description -->
    <div class="row mt-4">
        @forelse($companies as $company)
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-0">{{$company->name}}</h5><br>
                    <p class="mb-2 text-muted card-text"><small>{{$company->phone}}, {{$company->email}}</small></p>
                    <p class="card-text">{!! mb_substr($company->description, 0,100) !!}</p>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.company.show', $company->id) }}" class="card-link">View Company</a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-md-12">
            <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-info"></i>There Are No Companies To Show!</h5>
            </div>
        </div>
        @endforelse
    </div>

    <div class="row pt-2">
        <div class="col-md-12">
            <ul class="pagination pagination-sm m-0 float-right">
                {{ $companies->appends(request()->input())->links()}}
            </ul>
        </div>
    </div>
</div>
@endsection