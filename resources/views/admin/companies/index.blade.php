@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white pl-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Companies</li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="row mt-4">
        <div class="col-md-12 d-flex justify-content-between">

            <h3>Companies List</h3>
            <div class="card-tools">
                <!-- <a href="#" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    Add New Company
                </a> -->
            </div>
        </div>
    </div>
    <!-- name, address, phone, email, description, status -->
    <div class="row mt-4"><br>
        <div class="col-md-12">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">name</th>
                        <th scope="col">address</th>
                        <th scope="col">Contact</th>
                        <th scope="col">status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($companies as $company)
                    <tr>
                        <th scope="row">{{$company->id}}</th>
                        <th scope="row">{{$company->name}}</th>
                        <td class="text-wrap">{{$company->address}}</td>
                        <td>
                            {{$company->phone}}<br>
                            {{$company->email}}
                        </td>
                        <td>
                            @if($company->status == \App\Models\Company::STATUS_ACCEPTED)
                            <span class="badge badge-success">{{$company->status}}</span>
                            @elseif($company->status == \App\Models\Company::STATUS_PENDING)
                            <span class="badge badge-secondary">{{$company->status}}</span>
                            @elseif($company->status == \App\Models\Company::STATUS_REJECTED)
                            <span class="badge badge-danger">{{$company->status}}</span>
                            @endif
                        </td>
                        <td class="project-actions">
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.company.show', $company->id) }}" role="button">
                                <i class="fas fa-folder"></i>
                            </a>
                            <a class="btn btn-info btn-sm" href="{{ route('admin.company.edit', $company->id) }}" role="button">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-company-{{$company->id}}">
                                <i class="fas fa-trash"></i>
                            </button>

                            <!-- A model window to delete a single permission -->
                            <div class="modal fade" id="delete-company-{{$company->id}}" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form role="form" method="POST" action="{{ route('admin.company.destroy', ['company' => $company->id]) }}">
                                            @method('DELETE')
                                            @csrf
                                            <div class="modal-body">

                                                <div class="alert alert-danger alert-dismissible text-wrap">
                                                    <h5><i class="icon fas fa-ban"></i> Warning!</h5>
                                                    <small class="text-danger">This action is irreversible!</small><br>

                                                    <p>Are you sure you want to delete the company <br><strong>{{$company->title}}</strong>?</p>
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
                            <h5><i class="icon fas fa-exclamation-triangle"></i> There are no companies that signed up yet.</h5>
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
                {{$companies->appends(request()->input())->links()}}
            </ul>
        </div>
    </div>
</div>
@endsection