@extends('dashboard.index')
@section('content')
<!-- Content Header (Page header) -->
  <div class="main-content">
    <!-- Header -->
    <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 600px; background-image: url({{asset("/assets/dist/img/profilebackground.jpg")}}); background-size: cover; background-position: center top;">
      <!-- Mask -->
      <span class="mask bg-gradient-default opacity-8"></span>
      <!-- Header container -->
      <div class="container-fluid d-flex align-items-center">
        <div class="row">
          <div class="col-lg-7 col-md-10" >
            <h1 class="display-2" style="color:rgb(0, 0, 0);">Hello {{$user->username}}</h1>
            <p class="mt-0 mb-5" style="color:rgb(0, 0, 0);">This is your personal information page. Here's where you'll find your information.</p>
            <a>Below is where you may make changes to your profile. <i class="fa-regular fa-hand-point-down"></i></a>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
      <div class="row">
        <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
          <div class="card card-profile shadow">
            <div class="row justify-content-center">
                <div class="card-profile-image"><br>
                  <a href="#" size>
                    @if ($user->getOneProfilePicture == NULL)
                        <img class="rounded-circle" src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                    @else
                    <img class="rounded-circle" src="{{asset("/upload/Users/".$user->getOneProfilePicture->users_id."/".$user->getOneProfilePicture->hash.".".$user->getOneProfilePicture->extension."")}}" alt="profile_pic" style="width:150px;height:150px;">
                    @endif
                    {{-- <img src="{{asset("/assets/dist/img/User.png")}}" class="rounded-circle" style="width:100px;height:150px;"> --}}
                  </a>
                </div>
            </div>
            <div class="card-body pt-0 pt-md-4">
              {{-- <div class="row">
                <div class="col">
                  <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                    <div>
                      <span class="heading">22</span>
                      <span class="description">Friends</span>
                    </div>
                    <div>
                      <span class="heading">10</span>
                      <span class="description">Photos</span>
                    </div>
                    <div>
                      <span class="heading">89</span>
                      <span class="description">Comments</span>
                    </div>
                  </div>
                </div>
              </div> --}}
              <div class="text-center">
                <h3>
                  {{$user->last_name}} {{$user->first_name}}<span class="font-weight-light">, 27</span>
                </h3>
                <div class="h5 font-weight-300">
                  <i class="ni location_pin mr-2"></i>{{$user->phone_number}}
                </div>
                <div class="h5 mt-4">
                  <i class="ni business_briefcase-24 mr-2"></i>IT Manager - Creative Officer
                </div>
                <div>
                  <i class="ni education_hat mr-2"></i>University of Computer Science
                </div>
                <hr class="my-4">
                <p>Its contents are only for testing purposes.</p>
              </div>
            </div>
          </div>
        </div>
        {{-- Edit --}}
        <div class="col-xl-8 order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">My account</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form>
                <h6 class="heading-small text-muted mb-4 text-white">User Information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-username">Username</label>
								        {{ Form::text('username', $user->username,['class' => 'form-control form-control-alternative','autocomplete'=>'off','readonly' ]) }}
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Email address</label>
								        {{ Form::text('email', $user->email,['class' => 'form-control form-control-alternative','autocomplete'=>'off','readonly' ]) }}
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-first-name">First name</label>
								        {{ Form::text('first_name', $user->first_name,['class' => 'form-control form-control-alternative','autocomplete'=>'off','readonly' ]) }}
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-last-name">Last name</label>
								        {{ Form::text('last_name', $user->last_name,['class' => 'form-control form-control-alternative','autocomplete'=>'off','readonly' ]) }}
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4">
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4  text-white">Contact information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-address">Address</label>
                        <input id="input-address" class="form-control form-control-alternative" placeholder="Home Address" type="text">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-city">City</label>
                        <input type="text" id="input-city" class="form-control form-control-alternative" placeholder="City">
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-country">Country</label>
                        <input type="text" id="input-country" class="form-control form-control-alternative" placeholder="Country">
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">Postal code</label>
                        <input type="number" id="input-postal-code" class="form-control form-control-alternative" placeholder="Postal code">
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4">
                <!-- Description -->
                <h6 class="heading-small text-muted mb-4  text-white">About me</h6>
                <div class="pl-lg-4">
                  <div class="form-group focused">
                    <label>About Me</label>
                    <textarea rows="4" class="form-control form-control-alternative" placeholder="A few words about you ..."></textarea>
                  </div>
                </div>
                <div class="row mb-0">
                  <div class="col-md-8 offset-md-4">
                      <button type="submit" class="btn btn-primary">
                          Summit
                      </button>
                  </div>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection