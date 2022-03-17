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
                    <h3>{{$menu->username}}</h3>
                    @if ($haspic)
                    <img src="{{asset("/upload/Menu/".$menu->getOneMenuPicture->menu_id."/".$menu->getOneMenuPicture->hash.".".$menu->getOneMenuPicture->extension."")}}" alt="profile_pic" style="width:300px;height:300px;">
                    @else
                    <img src="{{asset("/assets/dist/img/no_image.jpg")}}" style="width:400px;height:263px;">
                    {{-- <img src="http://bootdey.com/img/Content/avatar/avatar1.png" alt=""> --}}
                    @endif
                </div>
            </div>
            <div class="card-tools">
                <button type="button" class="btn btn-tool">
                    <a href="{{url('my-menu')}}"><i class="fa-solid fa-arrow-left-long"></i></a>
                </button>
            </div>
        </div>
        <div class="card-body">
            <form>
              <dl>
                <dt>Menu Name</dt>
                    <dd>{{$menu->name}}</dd>
                <dt>Description</dt>
                    <dd>{{$menu->description}}</dd>
                <dt>Category</dt>
                    <dd>{{$menu->category}}</dd>
                <dt>Price</dt>
                    <dd>RM {{$menu->price}}</dd>
                <dt>Availability</dt>
                <dd>
                    @if ($menu->availability == '0')
                      Available
                    @else
                      Not Available
                    @endif</dd>
              </dl>
            </form>
        </div>
    </div>
</div>
@endsection