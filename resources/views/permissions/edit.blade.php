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
    {{ Form::open(['url' => route('permissions.update',$permissions->id), 'method' => 'PUT'])}}
    <div class="card bg-secondary shadow">
        <div class="card-header bg-white border-0">
            <div class="row align-items-center">
                <div class="col-8">
                    <h3>Name: <b>{{$permissions->name}}</b></h3>
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
                <label for="name" class="col-md-4 col-form-label">Role</label>
				{{ Form::text('name', $permissions->name, ['class' => 'form-control','autocomplete'=>'off']) }}
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