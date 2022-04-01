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

                    @if ($zone->getZoneBermuda != NULL)
                    @foreach ($zone->getZoneBermuda as $key => $itemBermuda)
                    <div class="form-group">
                        <label for="latitude" class="col-md-4 col-form-label">Marker {{$key+1}}</label>
                        {{ Form::text('value', $itemBermuda->latitude, ['class' => 'form-control','autocomplete'=>'off']) }}
                        {{ Form::text('value', $itemBermuda->logitude, ['class' => 'form-control','autocomplete'=>'off']) }}
                    </div>  
                    @endforeach
                @endif
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
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<div id="googleMap" style="width:100%;height:400px;"></div>

    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCl39KmrnE2AaRWMXJIrKUcESBHHeG7y1c&callback=myMap&v=weekly"
      async
    ></script>
<script>
function myMap() {
    var id = '{{$zone->id}}'; 
    // $.ajax({ 
    //     type: "GET", 
    //     dataType: "json", 
    //     url: '/zone-menagement/find-marker-bermuda', 
    //     data: {'id': id}, 
    //     success: function(data){ 
    //     alert(data);
    //     const mydata = data
        
        
    // }}); 

    var triangleCoordsLS12 = []
    var lat = parseFloat('{{$zone->latitude}}');
    var lng = parseFloat('{{$zone->logitude}}');
    const myLatLng = { lat: lat, lng: lng };
    var lat = 'lat';
    var lng = 'lng';
   
    

    // Define the LatLng coordinates for the polygon's path.
    const triangleCoordsold = [
        { lat: 3.1174127, lng: 101.6758658 },
        { lat: 3.0423649, lng: 101.7531577 },
        { lat: 3.0520698, lng: 101.7875419 },
        { lat: 3.1174127, lng: 101.6758658 },
    ];
    const passedArray = [<?php echo implode(",",$bermuda) ?>];

    // Construct the polygon.
    const bermudaTriangle = new google.maps.Polygon({
        paths: passedArray,
        strokeColor: "#FF0000",
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: "#FF0000",
        fillOpacity: 0.35,
    });
    const map = new google.maps.Map(document.getElementById("googleMap"), {
        zoom: 13,
        center: myLatLng,
        // center: { lat: 24.886, lng: -70.268 },
    });
    bermudaTriangle.setMap(map);
}
</script>

@endsection