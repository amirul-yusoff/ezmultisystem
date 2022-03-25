@extends('dashboard.index')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Create Permissions</h1>
            </div>
        </div>
    </div>
</section>

<div class="container">
    @include('partials.message')
    {{ Form::open(['url' => $url,'id' => 'create'])}}
    <div class="card bg-secondary shadow">
        <div class="card-header bg-white border-0">
            <div class="row align-items-center">
                <div class="col-8">
                    <h3>Create</h3>
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
                <label for="name" class="col-md-4 col-form-label">Title</label>
				{{ Form::text('name', NULL, ['class' => 'form-control','autocomplete'=>'off', 'required']) }}
            </div>
        </div>
        <button class="btn btn-primary" type="submit">
            <i class="fa-regular fa-floppy-disk"></i>
            Create
        </button>
    </div>
    {{ Form::close() }}
</div>
@endsection