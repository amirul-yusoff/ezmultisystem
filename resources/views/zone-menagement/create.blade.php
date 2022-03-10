@extends('dashboard.index')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Create Zone</h1>
            </div>
        </div>
    </div>
</section>
<div class="container">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
                    <a href="{{url('zone-menagement')}}"><i class="fa-solid fa-arrow-left-long"></i></a>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="zone" class="col-md-4 col-form-label">Zone</label>
				{{ Form::text('zone', NULL, ['class' => 'form-control','autocomplete'=>'off', 'required']) }}
                <label for="state" class="col-md-4 col-form-label">State</label>
				{{ Form::text('state', NULL, ['class' => 'form-control','autocomplete'=>'off', 'required']) }}
                <label for="city" class="col-md-4 col-form-label">City</label>
				{{ Form::text('city', NULL, ['class' => 'form-control','autocomplete'=>'off', 'required']) }}
                <label for="postcode" class="col-md-4 col-form-label">Postcode</label>
				{{ Form::text('postcode', NULL, ['class' => 'form-control','autocomplete'=>'off', 'required']) }}
            </div>
        </div>
        <button class="btn btn-primary" type="submit">
            <i class="fa-regular fa-floppy-disk"></i>
            Create
        </button>
    </div>
    {{ Form::close() }}
</div>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
        $('#permissionsName').select2();
        $('#permission').select2();
        $('#roles').select2();
    });
</script>
@endsection