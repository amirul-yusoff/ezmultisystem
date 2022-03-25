@extends('dashboard.index')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Create My Address</h1>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    @include('partials.message')
    {{ Form::open(['url' => $url,'id' => 'store', 'files' => true])}}
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">My Address</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool">
            {{-- <a href="{{route('zone-menagement.create')}}"><i class="fa-solid fa-circle-plus"></i></a> --}}
          </button>
        </div>
      </div>
      <div class="card-body">
        <div class="form-group">
          <label for="address_1" class="col-md-4 col-form-label">Address 1</label>
          {{ Form::text('address_1', NULL, ['class' => 'form-control','autocomplete'=>'off', 'required']) }}
        </div>
        <div class="form-group">
          <label for="address_2" class="col-md-4 col-form-label">Address 2</label>
          {{ Form::text('address_2', NULL, ['class' => 'form-control','autocomplete'=>'off', 'required']) }}
        </div>
        <div class="form-group">
          <label for="city" class="col-md-4 col-form-label">City</label>
          {{ Form::text('city', NULL, ['class' => 'form-control','autocomplete'=>'off', 'required']) }}
        </div>
        <div class="form-group">
          <label for="state" class="col-md-4 col-form-label">State</label>
          {{ Form::text('state', NULL, ['class' => 'form-control','autocomplete'=>'off', 'required']) }}
        </div>
        <div class="form-group">
          <label for="postcode" class="col-md-4 col-form-label">Postcode</label>
          {{ Form::text('postcode', NULL, ['class' => 'form-control','autocomplete'=>'off', 'required']) }}
        </div>
        <div class="form-group">
          <label for="country" class="col-md-4 col-form-label">Country</label>
          {{ Form::text('country', NULL, ['class' => 'form-control','autocomplete'=>'off', 'required']) }}
        </div>
      </div>
    </div>
    <button class="btn btn-primary" type="submit">
      <i class="fa-regular fa-floppy-disk"></i>
      Create
  </button>
  {{ Form::close() }}
    
  </section>
<script type="text/javascript">


</script>
@endsection

