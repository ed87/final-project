@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white pl-0">
            <li class="breadcrumb-item"><a href="{{ route('company.home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Jobs</li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="row mt-4">
        <div class="col-md-12 d-flex justify-content-between">

            <h3>Company Jobs List</h3>
            <div class="card-tools">
                <a href="{{route('company.job.create')}}" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    Add New Job
                </a>
            </div>
        </div>
    </div>
    <div class="row mt-4"><br>
        <div class="col-md-12">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Applications</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jobs as $job)
                    <tr>
                        <th scope="row">{{$job->id}}</th>
                        <th scope="row">{{$job->title}}</th>
                        <td class="text-wrap">{{$job->description}}</td>
                        <td>{{$job->applicants->count()}}</td>
                        <td class="project-actions">
                            <a class="btn btn-primary btn-sm" href="{{ route('company.job.show', $job->id) }}" role="button">
                                <i class="fas fa-folder"></i>
                            </a>
                            <a class="btn btn-info btn-sm" href="{{ route('company.job.edit', $job->id) }}" role="button">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-job-{{$job->id}}">
                                <i class="fas fa-trash"></i>
                            </button>

                            <!-- A model window to delete a single permission -->
                            <div class="modal fade" id="delete-job-{{$job->id}}" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form role="form" method="POST" action="{{ route('company.job.destroy', ['job' => $job->id]) }}">
                                            @method('DELETE')
                                            @csrf
                                            <div class="modal-body">

                                                <div class="alert alert-danger alert-dismissible text-wrap">
                                                    <h5><i class="icon fas fa-ban"></i> Warning!</h5>
                                                    <small class="text-danger">This action is irreversible!</small><br>

                                                    <p>Are you sure you want to delete the job <br><strong>{{$job->title}}</strong>?</p>
                                                </div>

                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-primary" data-dismiss="modal">No Cancel</button>
                                                <button type="submit" class="btn btn-danger">Yes Delete</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                            </div>
                            <!-- /.modal-dialog -->

                        </td>
                    </tr>
                    @empty
                    <tr>
                        <div class="alert alert-warning">
                            <h5><i class="icon fas fa-exclamation-triangle"></i> There are no jobs posted yet by your company.</h5>
                        </div>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="row pt-2">
        <div class="col-md-12">
            <ul class="pagination pagination-sm m-0 float-right">
                {{$jobs->appends(request()->input())->links()}}
            </ul>
        </div>
    </div>
</div>
@endsection