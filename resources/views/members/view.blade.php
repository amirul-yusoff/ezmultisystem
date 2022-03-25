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
                  <h3 class="mb-0">{{$members->first_name}} Picture</h3>
                </div>
              </div>
            </div>
            <div class="card-body text-center">
              @if ($haspic)
              <img class="img-account-profile rounded-circle mb-2" src="{{asset(".$profilePicture.")}}" alt="profile_pic" style="width:300px;height:300px;">
              @else
              <img class="img-account-profile rounded-circle mb-2" src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="">
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
                  <h3 class="mb-0">{{$members->first_name}} Info</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form>
                <dl>
                  <dt>Full Name</dt>
                    <dd>{{$members->name}}</dd>
                  <dt>Username</dt>
                    <dd>{{$members->username}}</dd>
                  <dt>Email</dt>
                    <dd>{{$members->email}}</dd>
                  <dt>Phone Number</dt>
                    <dd>{{$members->phone_number}}</dd>
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