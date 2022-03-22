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
                <th>Menu</th>
                <th>Restorant</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($myOrder as $menu)
                <tr>
                    <td>{{$menu->menu->name}}</td>
                    <td>{{$menu->menu->getOwner->name}}</td>
                    <td>{{$menu->quantity}}</td>
                    <td>{{$menu->price}}</td>
                    <td>{{$menu->status}}</td>
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
          <table id="adminMembers"  class="table table-striped projects"data-page-length="25" max-width =  "10px">
              <thead>
                <tr>
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


</script>
@endsection

