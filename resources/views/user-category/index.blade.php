@extends('dashboard.index')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Rider Category</h1>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    @include('partials.message')
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Rider Category</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#add-new-category" >
            {{-- <button type="button" class="btn btn-danger btn-sm pull-right" data-toggle="modal" data-target="#add-new-member" data-id="{{$menu->id}}"> --}}
              <i class="fa-solid fa-ban"></i>
              Add Category
            {{-- </button> --}}
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
                <th>ID</th>
                <th>Group Name</th>
                <th>Description</th>
                <th>Rate (%)</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
               @foreach ($data as $item)
               <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->category_name}}</td>
                <td>{{$item->description}}</td>
                <td>{{$item->rate_percentages}}</td>
                <td>
                  <button type="button" class="btn btn-danger btn-sm pull-right" data-toggle="modal" data-target="#edit-category" data-id="{{$item->id}}">
                  <i class="fa-solid fa-ban"></i>
                  Edit
                </button>
                </td>
              </tr> 
               @endforeach
            </tbody>
          </table>
        </div>
      </div>

    <div class="">
			<div class="modal fade" id="add-new-category" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						</div>
						{{ Form::open(array('url' => route('user-category.create')))  }} 
            			{{ method_field('GET') }}
							
							<div class="modal-body"> 
								<div class="form-group row">
									<label for="category_name" class="col-sm-4 control-label"> Category :</label>
									<div class="col-sm-8">
										{{ Form::text('category_name', null, ['placeholder' => 'Category', 'class' => 'form-control'])}}
										<br>
									</div>
								</div>
                <div class="form-group row">
									<label for="description" class="col-sm-4 control-label"> Description :</label>
									<div class="col-sm-8">
										{{ Form::text('description', null, ['placeholder' => 'Description', 'class' => 'form-control'])}}
										<br>
									</div>
								</div>
                <div class="form-group row">
									<label for="rate_percentages" class="col-sm-4 control-label"> Rate :</label>
									<div class="col-sm-8">
										{{ Form::text('rate_percentages', null, ['Rate' => 'Reason', 'class' => 'form-control'])}}
										<br>
									</div>
								</div>
							</div> 
	
							<div class="modal-footer">
								<div class="btn btn-primary btn-sm">
									<button type="submit" class="btn btn-primary"><i class="fa fa-btn fa-cloud-upload"></i> Submit</button>
								{{Form::hidden('recreate', 0)}}
							</div> 
						{{ Form::close() }}
					</div>
				</div>
			</div>
		</div>
    <div class="">
			<div class="modal fade" id="edit-category" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						</div>
						{{ Form::open(array('url' => route('user-category.edit')))  }} 
            {{ method_field('GET') }}
							
							<div class="modal-body"> 
                <div class="form-group row">
									<label for="project_team" class="col-sm-4 control-label"> ID :</label>
									<div class="col-sm-8">
										{{ Form::text('id', NULL, ['placeholder' => 'ID', 'class' => 'form-control','readonly'])}}
										<br>
									</div>
								</div>
								<div class="form-group row">
									<label for="category_name" class="col-sm-4 control-label"> Category :</label>
									<div class="col-sm-8">
										{{ Form::text('category_name', null, ['placeholder' => 'Category', 'class' => 'form-control'])}}
										<br>
									</div>
								</div>
                <div class="form-group row">
									<label for="description" class="col-sm-4 control-label"> Description :</label>
									<div class="col-sm-8">
										{{ Form::text('description', null, ['placeholder' => 'Description', 'class' => 'form-control'])}}
										<br>
									</div>
								</div>
                <div class="form-group row">
									<label for="rate_percentages" class="col-sm-4 control-label"> Rate :</label>
									<div class="col-sm-8">
										{{ Form::text('rate_percentages', null, ['Rate' => 'Reason', 'class' => 'form-control'])}}
										<br>
									</div>
								</div>
							</div> 
	
							<div class="modal-footer">
								<div class="btn btn-primary btn-sm">
									<button type="submit" class="btn btn-primary"><i class="fa fa-btn fa-cloud-upload"></i> Update</button>
								{{Form::hidden('recreate', 0)}}
							</div> 
						{{ Form::close() }}
					</div>
				</div>
			</div>
		</div>

    
        
  </section>
  <script type="text/javascript">
    $(document).ready(function () {
      $("#add-new-category").on("show.bs.modal", function (e) {
        var id = $(event.target).data('id');
        $('input[name=id]').val(id);
      });
      $("#edit-category").on("show.bs.modal", function (e) {
        var id = $(event.target).data('id');
        $('input[name=id]').val(id);
      });
  
    });
  
  </script>
@endsection

