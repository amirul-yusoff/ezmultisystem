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
                <dt>Users</dt>
                    <dd>
                        @foreach ($zone->getUser as $item)
                        {{$item->getUserZone->name}},
                        @endforeach
                    </dd>
                <dt>Merchant</dt>
                    <dd>
                        @foreach ($zone->getMerchant as $item)
                        {{$item->getMerchantZone->name}},
                        @endforeach
                    </dd>
                </dl>
                <dt>Rider</dt>
                    <dd>
                        @foreach ($zone->getRider as $item)
                        {{$item->getRiderZone->name}},
                        @endforeach
                    </dd>
                </dl>
            </form>
        </div>
    </div>
</div>
<div id="googleMap" style="width:100%;height:400px;"></div>

<script>
function myMap() {
  const myLatLng = { lat: 3.0927, lng: 101.7395 };
  const map = new google.maps.Map(document.getElementById("googleMap"), {
    zoom: 15,
    center: myLatLng,
  });

  new google.maps.Marker({
    position: myLatLng,
    map,
    title: "Hello World!",
  });
}
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCl39KmrnE2AaRWMXJIrKUcESBHHeG7y1c&callback=myMap"></script>
    
  
  <script type="text/javascript">
		
  </script>
@endsection