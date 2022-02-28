@extends('dashboard.index')
@section('content')

  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Roles Management</h1>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    @include('partials.message')
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Roles</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool">
            <a href="{{route('roles.create')}}"><i class="fa-solid fa-circle-plus"></i></a>
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
              <th>Member</th>
              <th>Permissions</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($roles as  $key => $item)
              <tr>
                <td>{{$key+1}}</td>
                <td>{{$item->name}}</td>
                <td>
                  @foreach ($item->getPermissions as $itemPermissions)
									<a class="btn btn-xs btn-warning" href="">{{$itemPermissions->getPermissionsName->name}}</i></a>
                  @endforeach
                </td>
                <td class="text-center">
                  <a class="btn btn-primary btn-sm" href="{{ route('roles.show',$item->id)}}">
                    <i class="fa-regular fa-eye"> </i>
                    View
                  </a>
                  <a class="btn btn-info btn-sm" href="{{ route('roles.edit',$item->id)}}">
                  <i class="fas fa-pencil-alt"> </i>
                  Edit
                  </a>
                  <a class="btn btn-danger btn-sm" href="{{ route('roles.destroy',$item->id)}}">
                  <i class="fa-regular fa-trash-can"> </i>
                  Delete
                  </a>  
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </section>
@endsection