<!doctype html>
<html lang="en">
  <head>
  	<title>admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="{{ asset('assets/masuk/css/style.css') }}">

	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
					<div class="wrap d-md-flex">
						<div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last">
							<div class="text w-100">
								<h2>Admin Wardise</h2>
								<p>Selamat Datang Kembali Admin Wardise</p>
							</div>
			      </div>
						<div class="login-wrap p-4 p-lg-5">
			      	<div class="d-flex text-center">
			      		<div class="w-100">
			      			<h3 class="mb-4">Masuk</h3>
							@if (session('status'))
								<p style="color: red">{{ session('status') }}</p>
							@endif
			      		</div>
			      	</div>
							<form action="{{route('adminlogin.login')}}" method="post" class="signin-form">
								@csrf
			      		<div class="form-group mb-3">
			      			<label class="label" for="name">Username</label>
			      			<input type="email" name="email" class="form-control" placeholder="Username" required>
			      		</div>
		            <div class="form-group mb-3">
		            	<label class="label" for="password">Password</label>
		              <input type="password" name="password"class="form-control" placeholder="Password" required>
		            </div>
		            <div class="form-group">
		            	<button type="submit" class="mt-3 form-control btn btn-primary submit px-3">Masuk</button>
						<a href="{{ route('beranda.index') }}" class="mt-3 form-control btn btn-primary submit px-3">Kembali</a>
		            </div>
		          </form>
		        </div>
		      </div>
				</div>
			</div>
		</div>
	</section>

	<script src="{{ asset('assets/masuk/js/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/masuk/js/popper.js') }}"></script>
  <script src="{{ asset('assets/masuk/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/masuk/js/main.js') }}"></script>

	</body>
</html>