@extends('dashboard.index')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>View</h1>
            </div>
        </div>
    </div>
</section>

<div class="container">
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
            <form>
              <dl>
                <dt>State</dt>
                    <dd>{{$zone->state}}</dd>
                <dt>City</dt>
                    <dd>{{$zone->city}}</dd>
                <dt>Postcode</dt>
                    <dd>{{$zone->postcode}}</dd>
              </dl>
            </form>
        </div>
    </div>
</div>
@endsection