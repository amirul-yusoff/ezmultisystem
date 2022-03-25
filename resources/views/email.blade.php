<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('contact-us', 'Contact Us') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script> 
    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    {{-- <!-- jQuery and JS bundle w/ Popper.js --> --}}
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></scrip>
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    {{--<!-- Styles -->--}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script type="text/javascript" src="{{ URL::asset('/assets/js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('/assets/js/bootstrap.min.js') }}"></script>
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <!-- {{ config('app.name', 'iDeliver Home') }} -->
                    iDeliver Home
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    {{--<!-- Left Side Of Navbar -->--}}
                    <ul class="navbar-nav me-auto">

                    </ul>

                    {{--<!-- Right Side Of Navbar -->--}}
                    
                    <ul class="nav navbar-top-links navbar-right">
                        {{--<!-- Authentication Links -->--}}
                            
                        {{--<li class="nav-item">
                            <a class="nav-link" href="{{ url('/contact-us') }}">Contact Us</a>
                        </li>--}}
                    </ul>
                </div>
            </div>
        </nav>

        <div class="bg-contact100">
		<div class="container-contact100">
			<div class="wrap-contact100">
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

					<div class="wrap-input100 validate-input" data-validate = "Name is required">
						<input class="input100" type="text" name="name" placeholder="Name">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
                                            </span>
                                            @error('name')
                                                <span class="text-danger"> {{ $message }} </span>
                                            @enderror
                                        </div>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
                                            </div>
                                            <div class="wrap-input100 validate-input" data-validate = "Subject is required">
		        			<input class="input100" type="text" name="subject" placeholder="subject">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
                                                </span>
                                                @error('subject')
                                                    <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
    

					<div class="wrap-input100 validate-input" data-validate = "Message is required">
						<textarea class="input100" name="content" placeholder="Message"></textarea>
                                        <span class="focus-input100"></span>
                                        @error('content')
                                           <span class="text-danger"> {{ $message }} </span>
                                         @enderror
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

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
