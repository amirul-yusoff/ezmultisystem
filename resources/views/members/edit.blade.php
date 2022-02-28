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
          <h4 class="modal-title">Please Profile Picture </h4>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container-xl px-4 mt-4">
  @include('partials.message')
  {{ Form::open(['url' => route('admin-members.update',$members->id), 'method' => 'PUT', 'files' => true])}}

  {{-- {{ Form::open(['url' => route('admin-members.upload',$members->id), 'method' => 'PUT', 'files' => true])}} --}}
    <div class="row">
      <div class="col-xl-4">
          <!-- Profile picture card-->
          <div class="card mb-4 mb-xl-0">
            <div class="card-header"><b>Profile Picture</b></div>
              <div class="card-body text-center">
                @if ($haspic)
                <img class="img-account-profile rounded-circle mb-2" src="{{asset(".$profilePicture.")}}" alt="profile_pic" style="width:300px;height:300px;">

                @else
                <img class="img-account-profile rounded-circle mb-2" src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="">

                @endif
									{{Form::file('attachment', ['accept'=>'image/*, application/pdf'])}}
                  <!-- Profile picture help block-->
                  <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                  <!-- Profile picture upload button-->
                  <button class="btn btn-primary" type="submit">Upload new image</button>
              </div>
          </div>
      </div>
      <div class="col-xl-8">
          <!-- Account details card-->
          <div class="card mb-4">
              <div class="card-header"><b>Account Details</b></div>
              <div class="card-body">
                  <form>
                  {{-- Test1 --}}
                  <div class="col-md-8"> 
                    <div class="portlet light bordered">
                        <div class="portlet-body">
                            <div>
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs">
                                  <li class="nav-item">
                                    <a class="nav-link active" href="#update" aria-controls="update" role="tab" data-toggle="tab">Update</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="#password" aria-controls="password" role="tab" data-toggle="tab">Change Password</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="#Roles" aria-controls="Roles" role="tab" data-toggle="tab">Roles</a>
                                  </li>
                                </ul>
                                <br>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                  {{-- Tab panes for update --}}
                                    <div role="tabpanel" class="tab-pane active" id="update">
                                        <form>
                                          <div class="mb-3">
                                              <label class="small mb-1" for="username">Username</label>
                                              {{ Form::text('username', $members->username,['class' => 'form-control capitalize','autocomplete'=>'off', 'required']) }}
                                          </div>
                                          <div class="row gx-3 mb-3">
                                              <div class="col-md-6">
                                                  <label class="small mb-1" for="first_name">First Name</label>
                                                  {{ Form::text('first_name', $members->first_name,['class' => 'form-control capitalize','autocomplete'=>'off', 'required']) }}
                                              </div>
                                              <div class="col-md-6">
                                                  <label class="small mb-1" for="last_name">Last Name</label>
                                                  {{ Form::text('last_name', $members->last_name,['class' => 'form-control capitalize','autocomplete'=>'off', 'required']) }}
                                              </div>
                                          </div>
                                          {{-- <div class="row gx-3 mb-3">
                                              <div class="col-md-6">
                                                  <label class="small mb-1" for="Classification">Classification</label>
                                                  <input class="form-control" id="Classification" type="text" placeholder="Enter your Classification">
                                              </div>
                                              <div class="col-md-6">
                                                  <label class="small mb-1" for="Position">Position</label>
                                                  <input class="form-control" id="Position" type="text" placeholder="Enter your Position">
                                              </div>
                                          </div> --}}
                                          <div class="mb-3">
                                              <label class="small mb-1" for="inputEmailAddress">Email Address</label>
                                                  {{ Form::text('email', $members->email,['class' => 'form-control capitalize','autocomplete'=>'off', 'required']) }}
                                          </div>
                                          <div class="row gx-3 mb-3">
                                              <div class="col-md-6">
                                                  <label class="small mb-1" for="inputPhone">Phone Number</label>
                                                  {{ Form::text('phone_number', $members->phone_number,['class' => 'form-control capitalize','autocomplete'=>'off', 'required']) }}
                                              </div>
                                          </div>
                                          <button class="btn btn-primary" type="submit">
                                            <i class="fa fa-plus"> </i>
                                            Update
                                        </button>
                                        </form>
                                    </div>
                                  {{-- /Tab panes for Home --}}
                                  {{-- Tab panes for Profile --}}
                                    <div role="tabpanel" class="tab-pane" id="profile">
                                      <div class="card-body">
                                        <div class="row">
                                          <div class="col-sm-3">
                                            <h6 class="mb-0">Full Name</h6>
                                          </div>
                                          <div class="col-sm-9 text-secondary">
                                            {{$user->name}}
                                          </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                          <div class="col-sm-3">
                                            <h6 class="mb-0">Classification</h6>
                                          </div>
                                          <div class="col-sm-9 text-secondary">
                                            Admin / Restaurant / Rider
                                          </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                          <div class="col-sm-3">
                                            <h6 class="mb-0">Position</h6>
                                          </div>
                                          <div class="col-sm-9 text-secondary">
                                            Position
                                          </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                          <div class="col-sm-3">
                                            <h6 class="mb-0">Email</h6>
                                          </div>
                                          <div class="col-sm-9 text-secondary">
                                            {{$user->email}}
                                          </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                          <div class="col-sm-3">
                                            <h6 class="mb-0">Phone Number</h6>
                                          </div>
                                          <div class="col-sm-9 text-secondary">
                                            {{$user->phone_number}}
                                          </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                          <div class="col-sm-3">
                                            <h6 class="mb-0">Address</h6>
                                          </div>
                                          <div class="col-sm-9 text-secondary">
                                            Address
                                          </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                          <div class="col-sm-3">
                                            <h6 class="mb-0">Status</h6>
                                          </div>
                                          <div class="col-sm-9 text-secondary">
                                            Status
                                          </div>
                                        </div>
                                        <hr>
                                      </div>
                                    </div>
                                  {{-- /Tab panes for Profile --}}
                                  {{-- Tab panes for password --}}
                                    <div role="tabpanel" class="tab-pane" id="password">
                                      <form><div class="mb-3">
                                        <label class="small mb-1" for="password">Current Password</label>
                                        <input class="form-control" id="password" type="password" placeholder="Enter your Current Password">
                                      </div>
                                      <div class="mb-3">
                                        <label class="small mb-1" for="password">New Password</label>
                                        <input class="form-control" id="password" type="password" placeholder="Enter your New Password">
                                      </div>
                                      <div class="mb-3">
                                        <label class="small mb-1" for="password">Confirm Password</label>
                                        <input class="form-control" id="password" type="password" placeholder="Enter your Confirm Password">
                                      </div>
                                      </form>
                                      <button class="btn btn-primary" type="submit">
                                        <i class="fa fa-plus"> </i>
                                        Update
                                    </button>
                                      {{-- <button class="btn btn-primary" type="button">Save changes</button> --}}
                                    </div>
                                  {{-- /Tab panes for password --}}
                                  {{-- Tab panes for Permission --}}
                                  <div role="tabpanel" class="tab-pane" id="Roles">
                                    <div class="mb-3">
                                        <label class="small mb-1" for="roles">Role</label>
                                        {{-- <select name="schedule_report_member[]" id="schedule_report_member" class="form-control chosen-select" multiple="multiple"> --}}
                                        <select name="roles[]" id="roles" class="form-control chosen-select" multiple="multiple">
                                          @foreach($currentRole as $key=>$d)
                                            <option value="{{$d->getRoleName->id}}" selected >{{$d->getRoleName->name}}</option>
                                          @endforeach
                                          @foreach($allroles as $value => $team)
				                                		<option value="{{$team->id}}">{{$team->name}}</option>
                                          @endforeach
				                                </select>
                                    </div>
                                    <button class="btn btn-primary" type="submit">
                                      <i class="fa fa-plus"> </i>
                                      Update
                                    </button>
                                  </div>
                                  {{-- /Tab panes for Permission --}}
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                  {{-- /Test1 --}}
                    
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
@endsection

