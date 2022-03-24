@extends('dashboard.index')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Riders</h1>
      </div>
    </div>
  </div>
</section>

<section class="content">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Restaurants</h3>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
          <i class="fas fa-minus"></i>
        </button>
      </div>
    </div>
    <div class="card-body p-0">
      <table class="table table-striped projects">
        <thead>
          <tr>
            <th style="width: 1%">#</th>
            <th style="width: 20%">Name</th>
            <th style="width: 30%">Departmental Classification</th>
            <th>Position</th>
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
              <td>
                <a class="btn btn-primary btn-sm" href="{{ route('admin-members.view',$item->id)}}">
                  <i class="fa-regular fa-eye"> </i>
                  View
                </a>
                <a class="btn btn-info btn-sm" href="{{ route('admin-members.edit',$item->id)}}">
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