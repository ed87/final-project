@if(Session::has('success'))
    <div class="container">
        <div class="row mt-4">
            <div class="col-12">
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Success!</h5>
                    {{Session::get('success')}}
                </div>
            </div>
        </div>
    </div>
@endif

@if(Session::has('error'))
    <div class="container">
        <div class="row mt-4">
            <div class="col-12">
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                    {{Session::get('error')}}
                </div>
            </div>
        </div>
    </div>
@endif

@if(Session::has('warning'))
    <div class="container">
        <div class="row mt-4">
            <div class="col-12">
                <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-exclamation-triangle"></i> Warning!</h5>
                    {{Session::get('warning')}}
                </div>
            </div>
        </div>
    </div>
@endif

@if(Session::has('info'))
    <div class="container">
        <div class="row mt-4">
            <div class="col-12">
                <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-info"></i> info!</h5>
                    {{Session::get('info')}}
                </div>
            </div>
        </div>
    </div>
@endif

