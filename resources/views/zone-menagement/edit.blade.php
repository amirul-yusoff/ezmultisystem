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
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@include('partials.message')
    {{ Form::open(['url' => route('zone-menagement.update',$zone->id), 'method' => 'PUT'])}}
    <div class="card bg-secondary shadow">
        <div class="card-header bg-white border-0">
            <div class="row align-items-center">
                <div class="col-8">
                    <h3>{{$zone->zone}}</h3>
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
                <label for="state" class="col-md-4 col-form-label">State</label>
				{{ Form::text('state', $zone->state, ['class' => 'form-control','autocomplete'=>'off']) }}
            </div>
            <div class="form-group">
                <label for="city" class="col-md-4 col-form-label">City</label>
				{{ Form::text('city', $zone->city, ['class' => 'form-control','autocomplete'=>'off']) }}
            </div>
            <div class="form-group">
                <label for="postcode" class="col-md-4 col-form-label">Postcode</label>
				{{ Form::text('postcode', $zone->postcode, ['class' => 'form-control','autocomplete'=>'off']) }}
            </div>
            <div class="form-group">
                <label for="latitude" class="col-md-4 col-form-label">latitude</label>
				{{ Form::text('latitude', $zone->latitude, ['class' => 'form-control','autocomplete'=>'off']) }}
            </div>
            <div class="form-group">
                <label for="logitude" class="col-md-4 col-form-label">logitude</label>
				{{ Form::text('logitude', $zone->logitude, ['class' => 'form-control','autocomplete'=>'off']) }}
            </div>
            <div class="form-group">
                <label for="permission" class="col-md-4 col-form-label">User</label>
                <select name="user[]" id="user" class="form-control chosen-select" multiple="multiple">
                    @foreach($currentUser as $key=>$d)
                        <option value="{{$d->getUserZone->id}}" selected >{{$d->getUserZone->name}}</option>
                    @endforeach
                    @foreach($member as $value => $team)
                        <option value="{{$team->id}}">{{$team->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="merchant" class="col-md-4 col-form-label">Merchant</label>
                <select name="merchant[]" id="merchant" class="form-control chosen-select" multiple="multiple">
                    @foreach($currentMerchant as $key=>$d)
                        <option value="{{$d->getMerchantZone->id}}" selected >{{$d->getMerchantZone->name}}</option>
                    @endforeach
                    @foreach($merchant as $value => $team)
                        <option value="{{$team->id}}">{{$team->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="rider" class="col-md-4 col-form-label">Rider</label>
                <select name="rider[]" id="rider" class="form-control chosen-select" multiple="multiple">
                    @foreach($currentRider as $key=>$d)
                        <option value="{{$d->getRiderZone->id}}" selected >{{$d->getRiderZone->name}}</option>
                    @endforeach
                    @foreach($rider as $value => $team)
                        <option value="{{$team->id}}">{{$team->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <button class="btn btn-primary" type="submit">
            <i class="fa-solid fa-floppy-disk"></i>
            Update
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