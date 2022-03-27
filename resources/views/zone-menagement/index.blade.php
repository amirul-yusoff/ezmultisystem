@extends('dashboard.index')
@section('content')

  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Zone Menagement</h1>
        </div>
      </div>
    </div>
  </section>
  
  <section class="content">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Summarize</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
      </div>
      <div class="card-body p-0">
        <table id="adminMembers"  class="table table-striped projects"data-page-length="25" max-width =  "10px">
          <thead>
            <tr>
              <th>Zone</th>
              <th>User</th>
              <th>Merchant</th>
              <th>Rider</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($zone as $item)
              <tr>
                <td>{{$item->zone}}</td>
                <td>{{count($item->getUser)}}</td>
                <td>{{count($item->getMerchant)}}</td>
                <td>{{count($item->getRider)}}</td>
              </tr>
            @endforeach
            </tbody>
        </table>
      </div>
    </div>
    @include('partials.message')
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Zone</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool">
            <a href="{{route('zone-menagement.create')}}"><i class="fa-solid fa-circle-plus"></i></a>
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
              <th>#</th>
              <th>Zone</th>
              <th>State</th>
              <th>City</th>
              <th>Postcode</th>
              <th>Latitude Logitude</th>
              <th>User</th>
              <th>Merchant</th>
              <th>Rider</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($zone as  $key => $item)
              <tr>
                <td>{{$key+1}}</td>
                <td>{{$item->zone}}</td>
                <td>{{$item->state}}</td>
                <td>{{$item->city}}</td>
                <td>{{$item->postcode}}</td>
                <td>{{$item->latitude}}<br>{{$item->logitude}}</td>
                <td>
                  @foreach ($item->getUser as $itemUsers)
                  @if ($itemUsers->getUserZone != NULL)
									<a class="btn btn-xs btn-warning" href="">{{$itemUsers->getUserZone->name}}</i></a>
                  @endif
                  @endforeach
                </td>
                <td>
                  @foreach ($item->getMerchant as $itemUsers)
                  @if ($itemUsers->getMerchantZone != NULL)
									<a class="btn btn-xs btn-warning" href="">{{$itemUsers->getMerchantZone->name}}</i></a>
                  @endif
                  @endforeach
                </td>
                <td>
                  @foreach ($item->getRider as $itemUsers)
                  @if ($itemUsers->getRiderZone != NULL)
									<a class="btn btn-xs btn-warning" href="">{{$itemUsers->getRiderZone->name}}</i></a>
                  @endif
                  @endforeach
                </td>
                <td class="text-center">
                  {{-- <a class="btn btn-warning btn-sm" href="#">
                  <i class="fa-regular fa-thumbs-up"> </i>
                  Approve
                  </a>  
                  <a class="btn btn-warning btn-sm" href="#">
                    <i class="fa-regular fa-thumbs-down"> </i>
                  Reject
                  </a>  --}}
                  @if ($viewButton)
                  <a class="btn btn-primary btn-sm" href="{{route('zone-menagement.show',$item->id)}}">
                    <i class="fa-regular fa-eye"> </i>
                    View
                  </a>
                  @else
                  @endif
                  @if ($editButton)
                  <a class="btn btn-info btn-sm" href="{{route('zone-menagement.edit',$item->id)}}">
                  <i class="fas fa-pencil-alt"> </i>
                  Edit
                  </a>
                  @else
                  @endif
                  @if ($deleteButton)
                  <a class="btn btn-danger btn-sm" href="{{route('zone-menagement.destroy',['id'=>$item->id])}}">
                  <i class="fa-regular fa-trash-can"> </i>
                  Delete
                  </a>
                  @else
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </section>
@endsection