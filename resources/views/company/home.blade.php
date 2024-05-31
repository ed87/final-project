@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-4">
        <div class="col-lg-6 col-6">
            <!-- small card -->
            <div class="small-box">
                <div class="inner">
                    <h3>176</h3>

                    <p>Posted Jobs</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-briefcase"></i>
                </div>

                <a href="{{ route('company.job.index') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-6 col-6">
            <!-- small card -->
            <div class="small-box">
                <div class="inner">
                    <h3>16</h3>

                    <p>Posted Internship</p>
                </div>
                <div class="icon">
                    <i class="fas fa-paper-plane"></i>
                </div>
                <a href="{{route('company.internship.index') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection