@extends('layouts.app')

@section('content')
    <div id="app">
        <div class="wrapper wrapper-content animated fadeInRight">
		    <div class="row">
		    	<div class="col-lg-6">
                    <div class="ibox">
	    		        <div class="wrap-contact100" style="text-align: center">
				            <form action="{{ route('send.email') }}" class="contact100-form validate-form" method="post">
                                                    @csrf
				            	<span class="contact100-form-title">
				            		Contact Form
                                </span>
                                @if(session()->has('message'))
                                    <div class="alert alert-success">
                                        {{ session()->get('message') }}
                                    </div>
                                @endif
                                <div class="form-group row validate-input" data-validate = "Name is required">
				            		<label for="Name" class="col-md-4 col-form-label"> Name :</label>
				            		<div class="col-md-8">
                                        <input class="form-control" type="text" name="name" placeholder="Name">
				            		    <span class="focus-input100"></span>
				            		    <span class="symbol-input100">
				            		    	<i class="fa fa-user" aria-hidden="true"></i>
                                        </span>
                                        @error('name')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
				            		</div>
				            	</div>
                                <div class="form-group row validate-input" data-validate = "Valid email is required: ex@abc.xyz">
				            		<label for="Name" class="col-md-4 col-form-label"> Email :</label>
				            		<div class="col-md-8">
				            		    <input class="form-control" type="text" name="email" placeholder="Email">
				            		    <span class="focus-input100"></span>
				            		    <span class="symbol-input100">
				            		    	<i class="fa fa-envelope" aria-hidden="true"></i>
				            		    </span>
				            		</div>
				            	</div>
                                <div class="form-group row validate-input" data-validate = "Subject is required">
				            		<label for="Name" class="col-md-4 col-form-label"> Subject :</label>
				            		<div class="col-md-8">
				            		    <input class="form-control" type="text" name="subject" placeholder="Subject">
				            		    <span class="focus-input100"></span>
				            		    <span class="symbol-input100">
				            		    	<i class="fa fa-envelope" aria-hidden="true"></i>
                                        </span>
                                        @error('subject')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
				            		</div>
				            	</div>
                                <div class="form-group row validate-input" data-validate = "Subject is required">
				            		<label for="Name" class="col-md-4 col-form-label"> Subject :</label>
				            		<div class="col-md-8">
				            		    <input class="form-control" type="text" name="subject" placeholder="Subject">
				            		    <span class="focus-input100"></span>
				            		    <span class="symbol-input100">
				            		    	<i class="fa fa-envelope" aria-hidden="true"></i>
                                        </span>
                                        @error('subject')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
				            		</div>
				            	</div>
                                <div class="form-group row validate-input" data-validate = "Message is required">
				            		<label for="Name" class="col-md-4 col-form-label"> Message :</label>
				            		<div class="col-md-8">
				            		    <textarea class="form-control" name="content" placeholder="Message"></textarea>
				            		    <span class="focus-input100"></span>
                                        @error('content')
                                        <span class="text-danger"> {{ $message }} </span>
                                        @enderror
				            		</div>
				            	</div>
                            
				            	<div class="container-contact100-form-btn">
				            		<button type="submit" class="contact100-form-btn">
				            			Send
				            		</button>
				            	</div>
				            </form>
	    		        </div>
	    	    	</div>
	    	    </div>
	        </div>
	    </div>
    </div>
@endsection
