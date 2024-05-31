@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white pl-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.company.index') }}">Companies</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.company.show', ['company' => $company]) }}">{{$company->name}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit {{$company->name}}</li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-md-5">
            <div class="card card-default mt-4 shadow">
                <div class="card-header">
                    <h5><b>{{ __('Update Company Status') }}</b></h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.company.update', $company->id) }}">
                        @method('PUT')
                        @csrf

                        <div class="form-group">
                            <label for="status">Company Status</label>

                            <select class="custom-select form-control @error('status') is-invalid @enderror" id="status" name="status">

                                <option value="{{App\Models\Company::STATUS_ACCEPTED}}" {{ old('status')== App\Models\Company::STATUS_ACCEPTED || ($company->status == App\Models\Company::STATUS_ACCEPTED) ? 'selected' : '' }}>
                                    {{App\Models\Company::STATUS_ACCEPTED}}
                                </option>
                                <option value="{{App\Models\Company::STATUS_PENDING}}" {{ old('status')== App\Models\Company::STATUS_PENDING || ($company->status == App\Models\Company::STATUS_PENDING) ? 'selected' : '' }}>
                                    {{App\Models\Company::STATUS_PENDING}}
                                </option>
                                <option value="{{App\Models\Company::STATUS_REJECTED}}" {{ old('status')== App\Models\Company::STATUS_REJECTED || ($company->status == App\Models\Company::STATUS_REJECTED) ? 'selected' : '' }}>
                                    {{App\Models\Company::STATUS_REJECTED}}
                                </option>
                            </select>

                            @error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <hr>
                        <div class="form-group row mb-0">
                            <div class="col-md-12 d-flex justify-content-between">
                                <button type="submit" class="btn btn-block btn-primary">
                                    {{ __('Update Company Status') }}
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