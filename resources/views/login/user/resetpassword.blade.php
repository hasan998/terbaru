
<!doctype html>
<html lang="en">
  <head>
  	<title>User</title>
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
				<div class="col-md-12 col-lg-7">
						<div class="p-4" style="background-color: #fff; width: 100%">
							<div class="d-flex text-center">
								<div class="w-100">
									<h3 class="mb-4">Atur Ulang Kata Sandi</h3>
								</div>
							</div>
							<form method="POST" action="{{ route('password.update') }}"class="signin-form">
								@csrf
								<input type="hidden" name="token" value="{{ $token }}">
								<div class="form-group mb-3">
									<input type="hidden" name="email" class="form-control" placeholder="Email" value="{{ $email }}" required>
								</div>
                                <div class="form-group mb-3">
									<label class="label" for="name">Password</label>
									<input type="password" name="password" class="form-control" placeholder="Password" required>
								</div>
                                <div class="form-group mb-3">
									<label class="label" for="name">Confirmasi Password</label>
									<input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password" required>
								</div>
								<div class="form-group">
									<button type="submit" class="mt-4 form-control btn btn-primary submit px-3">Kirim Alamat Kata Sandi</button>
								</div>
							</form>
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

