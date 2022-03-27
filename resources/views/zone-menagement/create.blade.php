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
                <label for="city" class="col-md-4 col-form-label">City</label>
				{{ Form::text('city', NULL, ['class' => 'form-control','autocomplete'=>'off', 'required']) }}
                <label for="state" class="col-md-4 col-form-label">State</label>
				{{ Form::text('state', NULL, ['class' => 'form-control','autocomplete'=>'off', 'required']) }}
                <label for="postcode" class="col-md-4 col-form-label">Postcode</label>
				{{ Form::text('postcode', NULL, ['class' => 'form-control','autocomplete'=>'off', 'required']) }}
                <label for="latitude" class="col-md-4 col-form-label">Latitude</label>
				{{ Form::text('latitude', NULL, ['class' => 'form-control','autocomplete'=>'off', 'required']) }}
                <label for="logitude" class="col-md-4 col-form-label">Logitude</label>
				{{ Form::text('logitude', NULL, ['class' => 'form-control','autocomplete'=>'off', 'required']) }}
                <label for="User" class="col-md-4 col-form-label">User</label>
                <select name="user[]" id="user" class="form-control chosen-select" multiple="multiple">
                    @foreach($member as $value => $team)
                        <option value="{{$team->id}}">{{$team->name}}</option>
                    @endforeach
                </select>
                <label for="merchant" class="col-md-4 col-form-label">Merchant</label>
                <select name="merchant[]" id="merchant" class="form-control chosen-select" multiple="multiple">
                    @foreach($merchant as $value => $team)
                        <option value="{{$team->id}}">{{$team->name}}</option>
                    @endforeach
                </select>
                <label for="rider" class="col-md-4 col-form-label">Rider</label>
                <select name="rider[]" id="rider" class="form-control chosen-select" multiple="multiple">
                    @foreach($rider as $value => $team)
                        <option value="{{$team->id}}">{{$team->name}}</option>
                    @endforeach
                </select>
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
        $('#user').select2();
        $('#merchant').select2();
        $('#rider').select2();
    });
</script>
@endsection