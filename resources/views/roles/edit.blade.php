@extends('dashboard.index')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Role</h1>
            </div>
        </div>
    </div>
</section>
<div class="container">
    @include('partials.message')
    {{ Form::open(['url' => route('roles.update',$roles->id), 'method' => 'PUT']) }}
    {{-- {{ Form::open(['url' => route('roles.edit',$roles->id)])}} --}}
    {{-- {{ method_field('PUT') }} --}}
    <div class="card bg-secondary shadow">
        <div class="card-header bg-white border-0">
            <div class="row align-items-center">
                <div class="col-8">
                    <h3>Name: <b>{{$roles->name}}</b></h3>
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
                {{ Form::text('name', $roles->name, ['class' => 'form-control','autocomplete'=>'off']) }}
            </div>
            <div class="form-group">
                <label for="permission" class="col-md-4 col-form-label">Permission</label>
                <select name="permission[]" id="permission" class="form-control chosen-select" multiple="multiple">
                    @foreach($currentRole as $key=>$d)
                        <option value="{{$d->getPermissionsName->id}}" selected >{{$d->getPermissionsName->name}}</option>
                    @endforeach
                    @foreach($permissions as $value => $team)
                        <option value="{{$team->id}}">{{$team->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <button class="btn btn-primary" type="submit">
            <i class="fa-solid fa-floppy-disk"></i>
            Save
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