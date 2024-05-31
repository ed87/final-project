@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-4">
        <div class="col-lg-6 col-6">
            <!-- small card -->
            <div class="small-box">
                <div class="inner">
                    <h3>{{$companies_count}}</h3>

                    <p>Companies</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-briefcase"></i>
                </div>

                <a href="{{ route('admin.company.index') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-6 col-6">
            <!-- small card -->
            <div class="small-box">
                <div class="inner">
                    <h3>{{$internship_applications_count}}</h3>

                    <p>Internships Applied To</p>
                </div>
                <div class="icon">
                    <i class="fas fa-paper-plane"></i>
                </div>
                <a href="{{ route('admin.internship-application.index') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection