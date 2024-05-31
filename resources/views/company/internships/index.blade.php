@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white pl-0">
            <li class="breadcrumb-item"><a href="{{ route('company.home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Internships</li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="row mt-4">
        <div class="col-md-12 d-flex justify-content-between">

            <h3>Company Internships List</h3>
            <div class="card-tools">
                <a href="{{route('company.internship.create')}}" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    Add New Internship
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
                    @forelse($internships as $internship)
                    <tr>
                        <th scope="row">{{$internship->id}}</th>
                        <th scope="row">{{$internship->title}}</th>
                        <td class="text-wrap">{{$internship->description}}</td>
                        <td>{{$internship->universityApplicants->count()}}</td>
                        <td class="project-actions">
                            <a class="btn btn-primary btn-sm" href="{{ route('company.internship.show', $internship->id) }}" role="button">
                                <i class="fas fa-folder"></i>
                            </a>
                            <a class="btn btn-info btn-sm" href="{{ route('company.internship.edit', $internship->id) }}" role="button">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-job-{{$internship->id}}">
                                <i class="fas fa-trash"></i>
                            </button>

                            <!-- A model window to delete a single permission -->
                            <div class="modal fade" id="delete-job-{{$internship->id}}" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form role="form" method="POST" action="{{ route('company.internship.destroy', ['internship' => $internship->id]) }}">
                                            @method('DELETE')
                                            @csrf
                                            <div class="modal-body">

                                                <div class="alert alert-danger alert-dismissible text-wrap">
                                                    <h5><i class="icon fas fa-ban"></i> Warning!</h5>
                                                    <small class="text-danger">This action is irreversible!</small><br>

                                                    <p>Are you sure you want to delete the internship <br><strong>{{$internship->title}}</strong>?</p>
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
                            <h5><i class="icon fas fa-exclamation-triangle"></i> There are no internships posted yet by your Company.</h5>
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
                {{$internships->appends(request()->input())->links()}}
            </ul>
        </div>
    </div>
</div>
@endsection