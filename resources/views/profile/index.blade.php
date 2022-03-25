@extends('dashboard.index')
@section('content')
<body>
  <div class="col-xl-4">
    <!-- Profile picture card-->
    <div class="card mb-4 mb-xl-0">
    </div>
</div>
  <div class="container-xl px-4 mt-4">
    <div class="row">
      <div class="col-xl-4">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">{{$user->first_name}} Picture's</h3>
                </div>
              </div>
            </div>
            <div class="card-body text-center">
              @if ($user->getOneProfilePicture == NULL)
                  <img class="img-circle elevation-2" src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="">
              @else
              <img class="img-circle elevation-2" src="{{asset("/upload/Users/".$user->getOneProfilePicture->users_id."/".$user->getOneProfilePicture->hash.".".$user->getOneProfilePicture->extension."")}}" alt="profile_pic" style="width:300px;height:300px;">
              @endif
            </div>
          </div>
      </div>
      <div class="col-xl-8">
        <div class="col-xl-8 order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">{{$user->first_name}} Info's</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form>
                <dl>
                  <dt>Full Name</dt>
                    <dd>{{$user->name}}</dd>
                  <dt>Username</dt>
                    <dd>{{$user->username}}</dd>
                  <dt>Email</dt>
                    <dd>{{$user->email}}</dd>
                  <dt>Phone Number</dt>
                    <dd>{{$user->phone_number}}</dd>
                </dl>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
@endsection