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
                        <i class="fa-regular fa-circle-check"></i>
                        Accept the Job
                      </a>  
                      <button type="button" class="btn btn-danger btn-sm pull-right" data-toggle="modal" data-target="#add-new-member" data-id="{{$menu->id}}">
                        <i class="fa-solid fa-ban"></i>
                        Reject Order
                      </button>
                      @endif
                      @if ($menu->status == 'Rider going to pickup location')
                      <a class="btn btn-primary btn-sm" href="{{ route('my-jobs.riderPickup',$menu->id)}}">
                        <i class="fa-regular fa-circle-check"></i>
                        Rider Pickup Item
                      </a>  
                      <button type="button" class="btn btn-danger btn-sm pull-right" data-toggle="modal" data-target="#add-new-member" data-id="{{$menu->id}}">
                        <i class="fa-solid fa-ban"></i>
                        Reject Order
                      </button>
                      @endif
                      @if ($menu->status == 'Rider pickup')
                      <a class="btn btn-primary btn-sm" href="{{ route('my-jobs.itemDelivered',$menu->id)}}">
                        <i class="fa-regular fa-circle-check"></i>
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

    <div class="">
			<div class="modal fade" id="add-new-member" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						</div>
						{{ Form::open(array('url' => route('my-jobs.reject')))  }} 
            {{ method_field('GET') }}
							
							<div class="modal-body"> 
                <div class="form-group row">
									<label for="project_team" class="col-sm-4 control-label"> Order ID :</label>
									<div class="col-sm-8">
										{{ Form::text('id', NULL, ['placeholder' => 'Reason', 'class' => 'form-control','readonly'])}}
										<br>
									</div>
								</div>
								<div class="form-group row">
									<label for="project_team" class="col-sm-4 control-label"> Reason :</label>
									<div class="col-sm-8">
										{{ Form::text('reason', null, ['placeholder' => 'Reason', 'class' => 'form-control'])}}
										<br>
									</div>
								</div>
							</div> 
	
							<div class="modal-footer">
								<div class="btn btn-primary btn-sm">
									<button type="submit" class="btn btn-primary"><i class="fa fa-btn fa-cloud-upload"></i> Reject Job</button>
								{{Form::hidden('recreate', 0)}}
							</div> 
						{{ Form::close() }}
					</div>
				</div>
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
    $(document).ready(function () {
      $("#add-new-member").on("show.bs.modal", function (e) {
        var id = $(event.target).data('id');
        $('input[name=id]').val(id);
      });
  
    });
  
  </script>
@endsection

