@extends('dashboard.index')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Create My Coupons</h1>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    @include('partials.message')
    {{ Form::open(['url' => $url,'id' => 'store', 'files' => true])}}
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">My Coupons</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool">
            {{-- <a href="{{route('zone-menagement.create')}}"><i class="fa-solid fa-circle-plus"></i></a> --}}
          </button>
        </div>
      </div>
      <div class="card-body">
        <div class="form-group">
          <label for="coupon_code" class="col-md-4 col-form-label">coupon_code</label>
          {{ Form::text('coupon_code', NULL, ['class' => 'form-control','autocomplete'=>'off', 'required']) }}
        </div>
        <div class="form-group">
          <label for="amount" class="col-md-4 col-form-label">amount</label>
          {{ Form::text('amount', NULL, ['class' => 'form-control','autocomplete'=>'off', 'required']) }}
        </div>
        <div class="form-group">
          <label for="amount_type" class="col-md-4 col-form-label">amount_type</label>
          {{ Form::text('amount_type', NULL, ['class' => 'form-control','autocomplete'=>'off', 'required']) }}
        </div>
        <div class="form-group">
          <label for="expiry_date" class="col-md-4 col-form-label">expiry_date</label>
          {{ Form::text('expiry_date', NULL, ['class' => 'date form-control','autocomplete'=>'off', 'required']) }}
        </div>
        <div class="form-group">
          <label for="status" class="col-md-4 col-form-label">status</label>
          {{ Form::text('status', NULL, ['class' => 'form-control','autocomplete'=>'off', 'required']) }}
        </div>
        <div class="form-group">
          <label for="was_used" class="col-md-4 col-form-label">was_used</label>
          {{ Form::text('was_used', NULL, ['class' => 'form-control','autocomplete'=>'off', 'required']) }}
        </div>
        <div class="form-group">
          <label for="time_can_used" class="col-md-4 col-form-label">time_can_used</label>
          {{ Form::text('time_can_used', NULL, ['class' => 'form-control','autocomplete'=>'off', 'required']) }}
        </div>
      </div>
    </div>
    <button class="btn btn-primary" type="submit">
      <i class="fa-regular fa-floppy-disk"></i>
      Create
  </button>
  {{ Form::close() }}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
  </section>
  <script type="text/javascript">
    $('.date').datepicker({  
       format: 'mm-dd-yyyy'
     });  
</script> 
@endsection

