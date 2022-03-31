@extends('dashboard.index')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Order Received</h1>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    @include('partials.message')
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Order Received</h3>
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
                <th>Addres Delivery</th>
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
                    @if ($menu->geDefaultAddress == NULL)
                        <td>No Address Found</td>
                    @else
                      <td>{{$menu->geDefaultAddress->address_1}}<br>
                        {{$menu->geDefaultAddress->address_2}}<br>
                        {{$menu->geDefaultAddress->postcode}}</td>
                    @endif
                    
                    <td>
                      @if ($menu->status == 'Order sent to Merchant')
                      <a class="btn btn-primary btn-sm" href="{{ route('order-received.prepareOrder',$menu->id)}}">
                        <i class="fa-regular fa-eye"> </i>
                        Preparing the Food
                      </a>  
                      @endif
                      @if ($menu->status == 'Preparing order')
                      <a class="btn btn-primary btn-sm" href="{{ route('order-received.pickupReady',$menu->id)}}">
                        <i class="fa-regular fa-eye"> </i>
                        Ready For Pickup
                      </a>  
                      @endif
                      <button type="button" class="btn btn-xs btn-primary pull-right" data-toggle="modal" data-target="#add-new-member" data-id="{{$menu->id}}">
                        <i class="fa fa-plus"></i>
                        reject Job
                      </button>
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
							<h4 class="modal-title">Add Members</h4>
						</div>
						{{ Form::open(array('url' => route('order-received.reject',$menu->id)))  }} 
            {{ method_field('GET') }}
							
							<div class="modal-body"> 
                <div class="form-group row">
									<label for="project_team" class="col-sm-4 control-label"> Order ID :</label>
									<div class="col-sm-8">
										{{ Form::text('id', $menu->id, ['placeholder' => 'Reason', 'class' => 'form-control','readonly'])}}
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
								<div class="col-sm-offset-3 col-sm-3">
									<button type="submit" class="btn btn-primary"><i class="fa fa-btn fa-cloud-upload"></i> Reject Order</button>
								
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
      alert(id);
			$('input[name=id]').val(id);
		});

	});

</script>
@endsection

