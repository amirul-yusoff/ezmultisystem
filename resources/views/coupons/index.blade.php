@extends('dashboard.index')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Coupons</h1>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    @include('partials.message')
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Coupons</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool">
            {{-- <a href="{{route('zone-menagement.create')}}"><i class="fa-solid fa-circle-plus"></i></a> --}}
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
        <table id="Coupons"  class="table table-striped projects"data-page-length="25" max-width =  "10px">
            <thead>
              <tr>
                <th>id</th>
                <th>coupon_code</th>
                <th>amount</th>
                <th>amount_type</th>
                <th>expiry_date</th>
                <th>status</th>
                <th>created_at</th>
                <th>was_used</th>
                <th>time_can_used</th>
                <th>created_by</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data as $item)
              <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->coupon_code}}</td>
                <td>{{$item->amount}}</td>
                <td>{{$item->amount_type}}</td>
                <td>{{$item->expiry_date}}</td>
                <td>{{$item->status}}</td>
                <td>{{$item->created_at}}</td>
                <td>{{$item->was_used}}</td>
                <td>{{$item->time_can_used}}</td>
                <td>{{$item->created_by}}</td>
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

