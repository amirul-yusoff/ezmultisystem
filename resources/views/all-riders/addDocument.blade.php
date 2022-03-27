@extends('dashboard.index')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Add Document</h1>
            </div>
        </div>
    </div>
</section>

<div class="container">
    @include('partials.message')
    {{ Form::open(array('route' => ['all-riders.storeDocument', $itemId], 'files' => true))}}
    {{ method_field('GET') }}
    <div class="card bg-secondary shadow">
        <div class="card-header bg-white border-0">
            <div class="row align-items-center">
                <div class="col-8">
                    <h3>Document</h3>
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
                <label for="description" class="col-md-4 col-form-label">File Name</label>
				{{ Form::text('description', NULL, ['class' => 'form-control','autocomplete'=>'off']) }}
            </div>
            <div class="form-group">
                <label for="username" class="col-md-4 col-form-label">File</label><br>
                {{Form::file('document', ['accept'=>'image/*, application/pdf'])}}
                <div class="small font-italic text-muted mb-4 text-white">JPG or PNG no larger than 5 MB</div>
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