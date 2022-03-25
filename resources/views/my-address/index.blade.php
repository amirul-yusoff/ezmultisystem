@extends('dashboard.index')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>My Address</h1>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    @include('partials.message')
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">My Address</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool">
            {{-- <a href="{{route('zone-menagement.create')}}"><i class="fa-solid fa-circle-plus"></i></a> --}}
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
        <table id="my-address"  class="table table-striped projects"data-page-length="25" max-width =  "10px">
            <thead>
              <tr>
                <th>Address 1</th>
                <th>Address 2</th>
                <th>City</th>
                <th>State</th>
                <th>Postcode</th>
                <th>Country</th>
                <th>latitude</th>
                <th>logitude</th>
                <th>Default</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                  <td>{{$item->address_1}}</td>  
                  <td>{{$item->address_2}}</td>  
                  <td>{{$item->city}}</td>  
                  <td>{{$item->state}}</td>  
                  <td>{{$item->postcode}}</td>  
                  <td>{{$item->country}}</td>  
                  <td>{{$item->latitude}}</td>  
                  <td>{{$item->longitude}}</td> 
                  <td>
                    {{ Form::radio('is_default',1,$item->is_default, array('class'=>'is_default')) }}
                    {{Form::hidden('id',$item->id)}}
                    {{Form::hidden('user_id',$item->user_id)}}
                  </td> 
                </tr> 
                @endforeach
            </tbody>
          </table>
      </div>
    </div>

    
  </section>
<script type="text/javascript">

    $(".is_default").on("change", function () {
      var val = $(this).val();
			var id = $(this).siblings('input[name=id]').val();
			var user_id = $(this).siblings('input[name=user_id]').val();
			var url = "<?php echo url('my-address/update-default'); ?>";
      // alert(user_id);
      // alert(url);
      $.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({type: "GET",
				url:"<?php echo url('my-address/update-default'); ?>",
				data: {'id':id,'user_id':user_id},
				success: function(data){
					setTimeout(function() {
					toastr.options = {
						showMethod: 'slideDown',
						timeOut: 1500
					};
					toastr.success('Default Display Updated');
				}, 300);
				},
				error: function(xhr, ajaxOptions, thrownError){
					setTimeout(function() {
					toastr.options = {
						showMethod: 'slideDown',
						timeOut: 4500
					};
					toastr.warning(thrownError);
				}, 300);
				}
				
			});
		});
</script>
@endsection

