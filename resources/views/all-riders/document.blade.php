@extends('dashboard.index')
@section('content')

  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>My Document</h1>
        </div>
      </div>
    </div>
  </section>
  
  <section class="content">
    @include('partials.message')
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Document</h3>
        <div class="card-tools">
          {{-- <button type="button" class="btn btn-tool">
            <a href="{{route('coupons.create')}}"><i class="fa-solid fa-circle-plus"></i></a>
          </button> --}}
          <button type="button" class="btn btn-tool">
            <a href="{{url('all-riders')}}"><i class="fa-solid fa-arrow-left-long"></i></a>
          </button>
          <button type="button" class="btn btn-tool">
            <a href="{{route('all-riders.addDocument',$itemId)}}"><i class="fa-solid fa-file"></i></a>
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
              <th>Name</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            @if ($members->getDocument != NULL)
                  @foreach ($members->getDocument as $key=>$itemDocument)
              <tr>
                <td>{{$key+1}}</td>
                  <td>{{$itemDocument->description}} </td> 
                <td class="text-center">
                  <a class="btn btn-primary btn-sm"  href="{{ route('all-riders.downloadDocument',['id'=>$members->id,'download'=>'rider_document','user_id'=>$itemDocument->user_id,'documet_id'=>$itemDocument->id],) }}">
                    <i class="fa-solid fa-download"> </i>
                    Download
                  </a>
                  <a class="btn btn-danger btn-sm" href="{{ route('all-riders.deleteDocument',['id'=>$members->id,'download'=>'rider_document','user_id'=>$itemDocument->user_id,'documet_id'=>$itemDocument->id],) }}">
                  <i class="fa-regular fa-trash-can"> </i>
                    Delete
                  </a>  
                </td>
              </tr>
              @endforeach
                      
                      
              @endif
          </tbody>
        </table>
      </div>
    </div>
  </section>
@endsection