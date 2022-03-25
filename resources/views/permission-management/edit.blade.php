@extends('dashboard.index')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Permission</h1>
            </div>
        </div>
    </div>
</section>

<div class="container">
    @include('partials.message')
    {{ Form::open(['url' => route('permission-management.edit',$members->id), 'method' => 'POST', 'files' => true])}}
    <div class="card bg-secondary shadow">
        <div class="card-header bg-white border-0">
            <div class="row align-items-center">
                <div class="col-8">
                    <h3>Name: {{$members->name}}</h3>
                </div>
            </div>
            <div class="card-tools">
                <button type="button" class="btn btn-tool">
                    <a href="{{url()->previous()}}"><i class="fa-solid fa-arrow-left-long"></i></a>
                </button>
            </div>
        </div>
        <div class="card-body">
            {{-- <h5 class="card-title">Role</h5>
            <p class="card-text">Role</p> --}}
            <div class="form-group">
                <label for="role" class="col-md-4 col-form-label">Role</label>
				{{ Form::text('role', $members->role, ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                <label for="permission" class="col-md-4 col-form-label">Permission</label>
				{{ Form::text('permission', $members->permission, ['class' => 'form-control']) }}
            </div>
        </div>
    </div>
    {{ Form::close() }}
</div>
@endsection