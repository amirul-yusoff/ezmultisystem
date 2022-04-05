@extends('dashboard.index')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Zone</h1>
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
                <button type="button" class="btn btn-danger btn-sm pull-right" data-toggle="modal" data-target="#add-new-marker" data-id="{{$zone->id}}">
                    <i class="fa-solid fa-ban"></i>
                    Add marker
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
            @if ($zone->getZoneBermuda != NULL)
                @foreach ($zone->getZoneBermuda as $key => $itemBermuda)
                <div class="form-group">
                    <label for="latitude" class="col-md-4 col-form-label">Marker {{$key+1}}</label>
                    {{ Form::text('value', $itemBermuda->latitude, ['class' => 'form-control','autocomplete'=>'off']) }}
                    {{ Form::text('value', $itemBermuda->logitude, ['class' => 'form-control','autocomplete'=>'off']) }}
                </div>  
                @endforeach
            @endif
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
<div class="">
    <div class="modal fade" id="add-new-marker" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                {{ Form::open(array('url' => route('zone-menagement.addMarker',$zone->id)))  }} 
                {{ method_field('GET') }}
                    
                    <div class="modal-body"> 
                    <div class="form-group row">
                            <label for="project_team" class="col-sm-4 control-label"> Zone ID :</label>
                            <div class="col-sm-8">
                                {{ Form::text('id', null, ['placeholder' => 'Reason', 'class' => 'form-control','readonly'])}}
                                <br>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="project_team" class="col-sm-4 control-label"> Latitude :</label>
                            <div class="col-sm-8">
                                {{ Form::text('latitude', null, ['placeholder' => 'Latitude', 'class' => 'form-control'])}}
                                <br>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="project_team" class="col-sm-4 control-label"> Logitude :</label>
                            <div class="col-sm-8">
                                {{ Form::text('logitude', null, ['placeholder' => 'Logitude', 'class' => 'form-control'])}}
                                <br>
                            </div>
                        </div>
                    </div> 

                    <div class="modal-footer">
                        <div class="btn btn-primary btn-sm">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-btn fa-cloud-upload"></i> Add Marker</button>
                        {{Form::hidden('recreate', 0)}}
                    </div> 
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
        $('#user').select2();
        $('#merchant').select2();
        $('#rider').select2();
        $("#add-new-marker").on("show.bs.modal", function (e) {
			var id = $(event.target).data('id');
			$('input[name=id]').val(id);
		});
    });
</script>
@endsection