@extends('dashboard.index')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Create Permissions</h1>
            </div>
        </div>
    </div>
</section>

<div class="container">
    @include('partials.message')
    {{ Form::open(['url' => $url,'id' => 'create', 'files' => true])}}
    <div class="card bg-secondary shadow">
        <div class="card-header bg-white border-0">
            <div class="row align-items-center">
                <div class="col-8">
                    <h3>Create</h3>
                </div>
            </div>
            <div class="card-tools">
                <button type="button" class="btn btn-tool">
                    <a href="{{url()->previous()}}"><i class="fa-solid fa-arrow-left-long"></i></a>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="attachment" class="col-md-4 col-form-label">Menu Picture</label><br>
				{{Form::file('attachment', ['accept'=>'image/*, application/pdf'])}}<br>
                <label for="availability" class="col-md-4 col-form-label">Availability</label>
                <div class="sm-8">
                    {{ Form::radio('availability','0','checked') }} Available <br>
                    {{ Form::radio('availability','1',null) }} Not Available <br>
                </div>
                <label for="name" class="col-md-4 col-form-label">Name</label>
				{{ Form::text('name', NULL, ['class' => 'form-control','autocomplete'=>'off', 'required']) }}
                <label for="description" class="col-md-4 col-form-label">Description</label>
				{{ Form::text('description', NULL, ['class' => 'form-control','autocomplete'=>'off', 'required']) }}
                <label for="category" class="col-md-4 col-form-label">Category</label>  
				{{ Form::text('category', NULL, ['class' => 'form-control','autocomplete'=>'off', 'required']) }}
                <label for="price" class="col-md-4 col-form-label">Price</label>  
				{{ Form::number('price', NULL,['class' => 'form-control currency','autocomplete'=>'off','step'=>'0.01']) }}
            </div>
        </div>
        <button class="btn btn-primary" type="submit">
            <i class="fa-regular fa-floppy-disk"></i>
            Create
        </button>
    </div>
    {{ Form::close() }}
</div>
<script type="text/javascript">
price = document.getElementsByName('price')[0];

const [anPrice] = AutoNumeric.multiple([price], {
	maximumValue: "99999999999",
    minimumValue: "-99999999999",
	unformatOnSubmit: true
});
</script>
@endsection