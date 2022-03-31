@extends('dashboard.index')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>My Jobs</h1>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    @include('partials.message')
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">My Jobs</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool">
            {{-- <a href="{{route('zone-menagement.create')}}"><i class="fa-solid fa-circle-plus"></i></a> --}}
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
      </div>
        <div class="card-body p-0">
          <table id="adminMembers"  class="table table-striped projects"data-page-length="25" max-width =  "10px">
            <thead>
              <tr>
                <th>ID</th>
                <th>Menu</th>
                <th>Restorant</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Status</th>
                <th>Address</th>
                <th>Distance</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($myOrder as $menu)
                <tr>
                    <td>{{$menu->id}}</td>
                    <td>{{$menu->menu->name}}</td>
                    <td>{{$menu->menu->getOwner->name}}</td>
                    <td>{{$menu->quantity}}</td>
                    <td>{{$menu->price}}</td>
                    <td>{{$menu->status}}</td>
                    @if ($menu->geDefaultAddress ==NULL)
                    <td>No info Found</td>  
                    @else
                    <td>{{$menu->geDefaultAddress->address_1}}<br>
                      {{$menu->geDefaultAddress->address_2}}<br>
                      {{$menu->geDefaultAddress->postcode}}</td>
                    @endif
                    <td>
                     @if ($menu->geDefaultAddress != NULL)
                         
                     @if ($menu->geDefaultAddress->latitude != NULL && $menu->geDefaultAddress->longitude != NULL)
                     @php
                     $latitudeFrom    = $menu->geDefaultAddress->latitude;
                     $longitudeFrom    = $menu->geDefaultAddress->longitude;
                     $latitudeTo        = $myCurrentAddress->latitude;
                     $longitudeTo    = $myCurrentAddress->longitude;
                     // dd($latitudeFrom,$longitudeFrom,$latitudeTo,$longitudeTo);
                     // dd($myCurrentAddress);
                     // Calculate distance between latitude and longitude
                     $theta    = $longitudeFrom - $longitudeTo;
                     $dist    = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
                     $dist    = acos($dist);
                     $dist    = rad2deg($dist);
                     $miles    = $dist * 60 * 1.1515;
                     $goToMaps = 'http://maps.google.com?q='.$latitudeTo.','.$longitudeTo;
                      $goToWaze = 'https://www.waze.com/ul?ll='.$latitudeTo.'%2C'.$longitudeTo.'&navigate=yes&zoom=17';
                 
                     // Convert unit and return distance
                     // $unit = strtoupper($unit);
                     $distance =  round($miles * 1.609344, 2).' km';
                     
                  @endphp
                 @endif
                 {{$distance}}<br>
                 <p> <a href="{{$goToMaps}}">Go to Map</a></p>
                 <p> <a href="{{$goToWaze}}">Go to Waze</a></p>
                         
                     @endif
                    </td>  
                    <td>
                      @if ($menu->status == 'Waiting For pickup')
                      <a class="btn btn-primary btn-sm" href="{{ route('my-jobs.acceptJobs',$menu->id)}}">
                        <i class="fa-regular fa-eye"> </i>
                        Accept the Job
                      </a>  
                      @endif
                      @if ($menu->status == 'Rider going to pickup location')
                      <a class="btn btn-primary btn-sm" href="{{ route('my-jobs.riderPickup',$menu->id)}}">
                        <i class="fa-regular fa-eye"> </i>
                        Rider Pickup Item
                      </a>  
                      @endif
                      @if ($menu->status == 'Rider pickup')
                      <a class="btn btn-primary btn-sm" href="{{ route('my-jobs.itemDelivered',$menu->id)}}">
                        <i class="fa-regular fa-eye"> </i>
                        Item Delivered
                      </a>  
                      @endif
                      
                    </td>
                  </tr> 
                @endforeach
            </tbody>
          </table>
        </div>
      </div>

    <div class="card">
        <div class="card-header">
          <h3 class="card-title">My History</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool">
              {{-- <a href="{{route('zone-menagement.create')}}"><i class="fa-solid fa-circle-plus"></i></a> --}}
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body p-0">
        <table id="adminMembers"  class="table table-striped projects"data-page-length="25" max-width =  "10px">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Menu</th>
                  <th>Restorant</th>
                  <th>Qty</th>
                  <th>Price</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($myOrderHistory as $menu)
                  <tr>
                    <td>{{$menu->id}}</td>
                    <td>{{$menu->menu->name}}</td>
                    <td>{{$menu->menu->getOwner->name}}</td>
                    <td>{{$menu->quantity}}</td>
                    <td>{{$menu->price}}</td>
                    <td>{{$menu->status}}</td>
                    </tr> 
                  @endforeach
              </tbody>
            </table>
        </div>
      </div>
  </section>
<script type="text/javascript">
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}

</script>
@endsection

