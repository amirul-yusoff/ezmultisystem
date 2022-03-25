@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="text-align:center;">Contact Us</div>
                <div class="card-body">
                    <form action="{{ route('send.email') }}" class="contact100-form validate-form" method="post">
                        @csrf
                        @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                        @endif
                        <div class="row mb-3">
                            <label for="Name" class="col-md-4 col-form-label text-md-end">Name :</label>

                            <div class="col-md-6">
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
                        <div class="row mb-3">
                            <label for="Email" class="col-md-4 col-form-label text-md-end">Email :</label>
                            <div class="col-md-6">
                                <input class="form-control" type="text" name="email" placeholder="Email">
				            	<span class="focus-input100"></span>
				            	<span class="symbol-input100">
				            		<i class="fa fa-envelope" aria-hidden="true"></i>
				            	</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="Subject" class="col-md-4 col-form-label text-md-end">Subject :</label>
                            <div class="col-md-6">
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
                        <div class="row mb-3">
                            <label for="Message" class="col-md-4 col-form-label text-md-end">Message :</label>
				            <div class="col-md-6">
				                <textarea class="form-control" name="content" placeholder="Message"></textarea>
				                <span class="focus-input100"></span>
                                @error('content')
                                <span class="text-danger"> {{ $message }} </span>
                                @enderror
				            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Send
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
