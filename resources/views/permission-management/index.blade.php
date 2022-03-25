@extends('dashboard.index')
@section('content')

  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Permission Management</h1>
        </div>
      </div>
    </div>
  </section>
  
  <section class="content">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Permission</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool">
            <i class="fa-solid fa-circle-plus"></i>
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
              <th>Email</th>
              <th>Role</th>
              <th>Permission</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($members as  $key => $item)
              <tr>
                <td>{{$key+1}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->email}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->name}}</td>
                <td>
                  <a class="btn btn-primary btn-sm" href="{{ route('permission-management.show',$item->id)}}">
                    <i class="fa-regular fa-eye"> </i>
                    View
                  </a>
                  <a class="btn btn-info btn-sm" href="{{ route('permission-management.edit',$item->id)}}">
                  <i class="fas fa-pencil-alt"> </i>
                  Edit
                  </a>
                  <a class="btn btn-danger btn-sm" href="#">
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

  <section class="content">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Roles</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool">
            <i class="fa-solid fa-circle-plus"></i>
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
              <th>Title</th>
              <th>Permissions</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($members as  $key => $item)
              <tr>
                <td>{{$key+1}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->email}}</td>
                <td>
                  <a class="btn btn-primary btn-sm" href="{{ route('permission-management.show',$item->id)}}">
                    <i class="fa-regular fa-eye"> </i>
                    View
                  </a>
                  <a class="btn btn-info btn-sm" href="{{ route('permission-management.edit',$item->id)}}">
                  <i class="fas fa-pencil-alt"> </i>
                  Edit
                  </a>
                  <a class="btn btn-danger btn-sm" href="#">
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

  <section class="content">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Permissions</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool">
            <i class="fa-solid fa-circle-plus"></i>
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
              <th>Title</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($members as  $key => $item)
              <tr>
                <td>{{$key+1}}</td>
                <td>{{$item->name}}</td>
                <td>
                  <a class="btn btn-primary btn-sm" href="{{ route('permission-management.show',$item->id)}}">
                    <i class="fa-regular fa-eye"> </i>
                    View
                  </a>
                  <a class="btn btn-info btn-sm" href="{{ route('permission-management.edit',$item->id)}}">
                  <i class="fas fa-pencil-alt"> </i>
                  Edit
                  </a>
                  <a class="btn btn-danger btn-sm" href="#">
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