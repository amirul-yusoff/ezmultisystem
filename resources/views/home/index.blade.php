@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <div class="input-group">
                    <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                    <button type="button" class="btn btn-outline-primary">Search</button>
                </div>  
                  <br>
                <div class="input-group">
                    <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                    <option selected>Sort</option>
                    <option value="1">Price</option>
                    <option value="2">Popular</option>
                    <option value="3">Radius</option>
                  </select>
                  <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                    <option selected>Search by</option>
                    <option value="1">Merchant Name</option>
                    <option value="2">Merchant Type</option>
                    <option value="3">Merchant Distance</option>
                  </select>
                  <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                    <option selected>Filter</option>
                    <option value="1">COD</option>
                    <option value="2">Card</option>
                    <option value="3">E-Wallet</option>
                  </select> 
                </div>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <div>
          <h1 style="text-align:center;">Sugested Menu</h1>
        </div>
        <div class="container text-center">
            
        </div>
        <br>
        <table class="table table-dark">
          @include('partials.message')
          <tbody>
              @foreach ($menu as $item)
                <tr class="table-active">
                  <div class="card card-bordered bg-white shadow" style="width: 20rem;">
                      <figure>
                        @if ($item->getOneMenuPicture != NULL)
                          @php
                            $menuPicture = "/upload/Menu/".$item->getOneMenuPicture->menu_id."/".$item->getOneMenuPicture->hash.".".$item->getOneMenuPicture->extension;
                          @endphp
                            <img class="card-img-top" src="{{asset(".$menuPicture.")}}" alt="menu_pic" style="width:300px;height:232.5px;">
                          @else
                            <img class="card-img-top" src="{{asset("/assets/dist/img/no_image.jpg")}}" style="width:300px;height:232.5px;">
                        @endif
                      </figure>
                      <div class="card-body">
                      <h5 class="card-title">{{$item->name}}
                        @if ($item->availability == '0')
                        <div class="badge mx-2 badge-primary">
                          Available
                        </div>
                        @else
                        <div class="badge mx-2 badge-danger">
                          Not Available
                        </div>
                        @endif</h5>
                      <p>{{$item->description}}</p>
                      <p>{{$item->category}}</p>
                      <p>RM {{$item->price}}</p>
                      @if ($item->availability == '0')
                      <a class="btn btn-warning btn-sm" href="{{ route('add.to.cart', $item->id) }}">
                        <i class="fa-solid fa-cart-plus"> </i>
                        Add To Cart
                      </a> 
                      @else
                      @endif
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
                </tr>
              @endforeach
              {{-- <tr>
                <div class="card" style="width: 15rem;">
                    <img class="card-img-top" src="..." alt="Card image cap">
                    <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
              </tr>
              <tr>
                <div class="card" style="width: 15rem;">
                    <img class="card-img-top" src="..." alt="Card image cap">
                    <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
              </tr>
              <tr>
                <div class="card" style="width: 15rem;">
                    <img class="card-img-top" src="..." alt="Card image cap">
                    <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
              </tr> --}}
            </tbody>
          </table>
        
    </div>
    
</div>
@endsection
