@extends('dashboard.index')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- Content Header (Page header) -->
<section class="content-header">
  {{-- <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Admin</h1>
      </div>
    </div>
  </div> --}}
</section>
<div class="">
  <div class="modal fade" id="uploadProfilePic" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Menu Picture </h4>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container-xl px-4 mt-4">
  @include('partials.message')
  {{ Form::open(['url' => route('menu.update',$menu->id), 'method' => 'PUT', 'files' => true])}}
    <div class="row">
      <div class="col-xl-4">
          <div class="card mb-4 mb-xl-0">
            <div class="card-header"><b>Menu Picture</b></div>
              <div class="card-body text-center">
                @if ($haspic)
                <img class="img-account-profile rounded-circle mb-2" src="{{asset("/upload/Menu/".$menu->getOneMenuPicture->menu_id."/".$menu->getOneMenuPicture->hash.".".$menu->getOneMenuPicture->extension."")}}" alt="profile_pic" style="width:300px;height:300px;">
            {{-- <img src="{{asset(".$menuPicture.")}}" alt="menu_pic"> --}}
                @else
                <img class="img-account-profile rounded-circle mb-2" src="{{asset("/assets/dist/img/no_image.jpg")}}" style="width:300px;height:300px;">
                @endif
									{{Form::file('attachment', ['accept'=>'image/*, application/pdf'])}}
                  <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
              </div>
          </div>
      </div>
      <div class="col-xl-8">
          <div class="card mb-4">
              <div class="card-header"><b>Menu Details</b>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool">
                        <a href="{{url('menu')}}"><i class="fa-solid fa-arrow-left-long"></i></a>
                    </button>
                </div>
              </div>
              <div class="card-body">
                  <form>
                  <div class="col-md-8"> 
                    <div class="portlet light bordered">
                        <div class="portlet-body">
                            <div>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="update">
                                        <form>
                                          <div class="form-group">
                                              <div class="sm-8">
                                                  {{ Form::radio('availability','0',($menu->availability == '0') ? 'checked' : '')}} Available <br>
                                                  {{ Form::radio('availability','1',($menu->availability == '1') ? 'checked' : '') }} Not Available <br>
                                              </div>
                                          </div>
                                          <div class="mb-3">
                                              <label class="small mb-1" for="name">Menu Name</label>
                                              {{ Form::text('name', $menu->name,['class' => 'form-control capitalize','autocomplete'=>'off', 'required']) }}
                                          </div>
                                          <div class="mb-3">
                                              <label class="small mb-1" for="description">Menu Description</label>
                                              {{ Form::text('description', $menu->description,['class' => 'form-control capitalize','autocomplete'=>'off', 'required']) }}
                                          </div>
                                          <div class="mb-3">
                                            <label class="small mb-1" for="description">Address</label>
                                            {{ Form::text('Address', $menu->geDefaultAddress->address_1.$menu->geDefaultAddress->address_2.$menu->geDefaultAddress->postcode,['class' => 'form-control capitalize','autocomplete'=>'off', 'readonly']) }}
                                        </div>
                                          <div class="row gx-3 mb-3">
                                              <div class="col-md-6">
                                                  <label class="small mb-1" for="category">Category</label>
                                                  {{ Form::text('category', $menu->category,['class' => 'form-control capitalize','autocomplete'=>'off', 'required']) }}
                                              </div>
                                              <div class="col-md-6">
                                                  <label class="small mb-1" for="price">Price</label>
				                                          {{ Form::number('price', $menu->price,['class' => 'form-control currency','autocomplete'=>'off','step'=>'0.01']) }}
                                                  {{-- {{ Form::text('price', $menu->price,['class' => 'form-control currency','autocomplete'=>'off','step'=>'0.01']) }} --}}
                                              </div>
                                          </div>
                                          <button class="btn btn-primary" type="submit">
                                            <i class="fa fa-plus"> </i>
                                            Update
                                        </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                  </form>
              </div>
          </div>
          {{ Form::close() }}
      </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
  $(document).ready(function()
  {
    $('#roles').select2();
  });
</script>
<script type="text/javascript">
price = document.getElementsByName('price')[0];

const [anPrice] = AutoNumeric.multiple([price], {
	maximumValue: "99999999999",
    minimumValue: "-99999999999",
	unformatOnSubmit: true
});
</script>
@endsection

