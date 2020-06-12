@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="/admin/videos" class="btn btn-success">
                    <i class="nav-icon fas fa-cloud-upload-alt"></i>
                        Admin panel
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
