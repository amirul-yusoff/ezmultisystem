@extends('dashboard')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Admin</h1>
      </div>
    </div>
  </div>
</section>

<section class="content">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Members</h3>
      <div class="card-tools">
        <button type="button" class="btn btn-tool">
          <i class="fa-solid fa-user-plus"></i>
        </button>
        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
          <i class="fas fa-minus"></i>
        </button>
        {{-- <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
          <i class="fas fa-times"></i>
        </button> --}}
      </div>
    </div>
    <div class="card-body p-0">
      <table id="adminMembers"  class="table table-striped projects"data-page-length="25" max-width =  "10px">
        <thead>
          <tr>
            <th style="width: 1%">#</th>
            <th style="width: 20%">Name</th>
            <th style="width: 30%">Departmental Classification</th>
            <th>Position</th>
            <th style="width: 8%" class="text-center">Status</th>
            <th style="width: 20%" class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($members as  $key => $item)
            <tr>
              <td>{{$key+1}}</td>
              <td>{{$item->name}}</td>
              <td>{{$item->name}}</td>
              <td>{{$item->name}}</td>
              <td>{{$item->name}}</td>
              <td>
                <a class="btn btn-primary btn-sm" href="#">
                  <i class="fa-regular fa-eye"> </i>
                  View
                </a>
                <a class="btn btn-info btn-sm" href="#">
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
        {{-- <tbody>
          <tr>
            <td>
            1
            </td>
            <td>
              <a>
              AdminLTE v3
              </a>
              <br/>
              <small>
              Created 01.01.2019
              </small>
            </td>
            <td>
              <ul class="list-inline">
                <li class="list-inline-item">
                  <img alt="Avatar" class="table-avatar" src="../../dist/img/avatar.png">
                </li>
              </ul>
            </td>
            <td class="project_progress">
              <div class="progress progress-sm">
                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100" style="width: 57%">
                </div>
              </div>
              <small>
                57% Complete
              </small>
            </td>
            <td class="project-state">
              <span class="badge badge-success">Active</span>
              <span class="badge badge-danger">Unactive</span>
            </td>
            <td class="project-actions text-right">
              <a class="btn btn-primary btn-sm" href="#">
                <i class="fas fa-folder"></i>
                View
              </a>
              <a class="btn btn-info btn-sm" href="#">
              <i class="fas fa-pencil-alt"></i>
              Edit
              </a>
              <a class="btn btn-danger btn-sm" href="#">
              <i class="fas fa-trash"></i>
              Delete
              </a>
            </td>
          </tr>
        </tbody> --}}
      </table>
    </div>
  </div>
</section>
@endsection