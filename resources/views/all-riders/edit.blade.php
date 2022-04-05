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
    {{ Form::open(['url' => route('all-riders.update',$members->id), 'method' => 'PUT'])}}
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
            <div class="form-group">
                <label for="user_category" class="col-md-4 col-form-label">User Category</label>
                <select name="user_category" id="user_category" class="form-control chosen-select" >
                    @if ($members->getUserCategory != NULL)
                        <option value="{{$members->getUserCategory->getcategoryName->id}}" selected >{{$members->getUserCategory->getcategoryName->category_name}}</option>
                    @endif
                    
                    @foreach($riderCategoryList as $value => $team)
                        <option value="{{$team->id}}">{{$team->category_name}}</option>
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
    $('#user_category').select2();
    });
</script>
@endsection