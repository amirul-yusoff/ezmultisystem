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
    {{ Form::open(['url' => route('pending-riders.update',$members->id), 'method' => 'PUT'])}}
    <div class="card bg-secondary shadow">
        <div class="card-header bg-white border-0">
            <div class="row align-items-center">
                <div class="col-8">
                    <h3>{{$members->username}}</h3>
                </div>
            </div>
            <div class="card-tools">
                <button type="button" class="btn btn-tool">
                    <a href="{{url()->previous()}}"><i class="fa-solid fa-arrow-left-long"></i></a>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="name" class="col-md-4 col-form-label">Name</label>
				{{ Form::text('name', $members->name, ['class' => 'form-control','autocomplete'=>'off']) }}
            </div>
            <div class="form-group">
                <label for="username" class="col-md-4 col-form-label">Username</label>
				{{ Form::text('username', $members->username, ['class' => 'form-control','autocomplete'=>'off']) }}
            </div>
            <div class="form-group">
                <label for="status" class="col-md-4 col-form-label">Status</label>
				{{ Form::text('status', $members->status, ['class' => 'form-control','autocomplete'=>'off']) }}
            </div>
        </div>
        <button class="btn btn-primary" type="submit">
            <i class="fa-solid fa-floppy-disk"></i>
            Save
        </button>
    </div>
    {{ Form::close() }}
</div>
@endsection