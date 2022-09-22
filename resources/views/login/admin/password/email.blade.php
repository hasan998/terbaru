
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
				<div class="col-md-12 col-lg-6">
						<div class="p-4" style="background-color: #fff; width: 100%">
							<div class="d-flex text-center">
								<div class="w-100">
									<h3 class="mb-4">Lupa Kata Sandi</h3>
								</div>
							</div>
							<form method="POST" action="{{ route('adminEmail.send') }}" class="signin-form">
								@csrf
								<div class="form-group mb-3">
									<label class="label" for="name">Username</label>
									<input type="email" name="email" class="form-control" placeholder="Username" required>
								</div>
								<div class="form-group d-flex justify-content-center">
									<a href="{{ route('adminlogin.index') }}" class="w-50 mt-4 form-control btn btn-primary submit">Kembali</a>
									<button type="submit" class="mt-4 form-control btn btn-primary submit px-3" style="margin-left: 10px">Kirim Alamat Kata Sandi</button>
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

