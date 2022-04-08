@extends('dashboard.index')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>My Invoice</h1>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    @include('partials.message')
   

    <div class="card">
        <div class="card-header">
          <h3 class="card-title">My Invoice</h3>
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
                  <th>Action</th>
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
                      <td><button type="button" class="btn btn-tool">
                        <a href="{{route('my-report.generatePDF')}}"><i class="fa-solid fa-circle-plus"></i></a>
                      </button></td>
                      
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

