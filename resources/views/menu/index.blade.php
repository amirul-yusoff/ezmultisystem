@extends('dashboard.index')
@section('content')

  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Menu</h1>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    @include('partials.message')
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Type of Menu</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool">
            <a href="{{route('menu.create')}}"><i class="fa-solid fa-circle-plus"></i></a>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
      </div>
      <div class="card-body p-0">
        {{-- <div class="max-w-7xl mx-auto"> --}}
            <div class="px-8 py-16">
                <div class="grid grid-cols-3 gap-8 mb-4">
                    @foreach ($menu as $item)
                        <div class="card card-bordered bg-white shadow">
                            <figure>
                              @if ($item->getOneMenuPicture != NULL)
                                @php
                                  $menuPicture = "/upload/Menu/".$item->getOneMenuPicture->menu_id."/".$item->getOneMenuPicture->hash.".".$item->getOneMenuPicture->extension;
                                @endphp
                                  {{-- <img src="{{asset(".$menuPicture.")}}" alt="menu_pic" style="width:450px;height:313px;"> --}}
                                  <img src="{{asset(".$menuPicture.")}}" alt="menu_pic" style="width:400px;height:263px;">
                                @else
                                  <img src="{{asset("/assets/dist/img/no_image.jpg")}}" style="width:400px;height:263px;">
                              @endif
                            </figure>
                            <div class="card-body">
                                <h2 class="card-title"><b>{{$item->name}}</b>
                                @if ($item->availability == '0')
                                <div class="badge mx-2 badge-primary">
                                  Available
                                </div>
                                @else
                                <div class="badge mx-2 badge-danger">
                                  Not Available
                                </div>
                                @endif
                                </h2><br>
                                <p>{{$item->description}}</p>
                                <p>{{$item->category}}</p>
                                <p>RM {{$item->price}}</p>
                                <a class="btn btn-warning btn-sm" href="{{ route('menu.approved',['id'=>$item->id])}}">
                                <i class="fa-regular fa-thumbs-up"> </i>
                                Approve
                                </a>  
                                <a class="btn btn-warning btn-sm" href="{{ route('menu.rejected',['id'=>$item->id])}}">
                                <i class="fa-regular fa-thumbs-down"> </i>
                                Reject
                                </a>  
                                <a class="btn btn-primary btn-sm" href="{{ route('menu.show',$item->id)}}">
                                  <i class="fa-regular fa-eye"> </i>
                                  View
                                </a>
                                <a class="btn btn-info btn-sm" href="{{ route('menu.edit',$item->id)}}">
                                <i class="fas fa-pencil-alt"> </i>
                                Edit
                                </a>
                                <a class="btn btn-danger btn-sm" href="{{ route('menu.destroy',['id'=>$item->id])}}">
                                <i class="fa-regular fa-trash-can"> </i>
                                Delete
                                </a>  
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        {{-- </div> --}}
      </div>
    </div>
  </section>
@endsection