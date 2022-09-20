<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/front-end/images/ftwardise/logo.jpg') }}">
        <link rel="icon" type="image/png" href="{{ asset('assets/front-end/images/ftwardise/logo.jpg') }}">
        <title>Cafe Paradise</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('assets/front-end/css/open-iconic-bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/front-end/css/animate.css')}}">
        
        <link rel="stylesheet" href="{{ asset('assets/front-end/css/owl.carousel.min.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/front-end/css/owl.theme.default.min.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/front-end/css/magnific-popup.css')}}">

        <link rel="stylesheet" href="{{ asset('assets/front-end/css/aos.css')}}">

        <link rel="stylesheet" href="{{ asset('assets/front-end/css/ionicons.min.css')}}">

        <link rel="stylesheet" href="{{ asset('assets/front-end/css/bootstrap-datepicker.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/front-end/css/jquery.timepicker.css')}}">

        
        <link rel="stylesheet" href="{{ asset('assets/front-end/css/flaticon.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/front-end/css/icomoon.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/front-end/css/style.css')}}">

        <!-- Icon -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    </head>

    <body class="goto-here">
      @yield('navbar')
      @yield('content')
      
      <footer class="ftco-footer ftco-section">
        <div class="container">
          <div class="row mb-5">
            <div class="col-md">
              <div class="ftco-footer-widget mb-4">
                <h2 class="ftco-heading-2">CafDise</h2>
                <p>Kami menyediakan makanan dan minuman, toko kami terletak di daerah tambun. Silahkan pesan makanan dan minuman di kami gratis ongkir</p>
                <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                  <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                  <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
                </ul>
              </div>
            </div>
            <div class="col-md">
              <div class="ftco-footer-widget mb-4 ml-md-5">
                <h2 class="ftco-heading-2">Menu</h2>
                <ul class="list-unstyled">
                  <li><div class="py-2 d-block">Beranda</div></li>
                  <li><div class="py-2 d-block">Menu</div></li>
                  <li><div class="py-2 d-block">Tentang Kami</div></li>
                  <li><div class="py-2 d-block">Kontak Kami</div></li>
                </ul>
              </div>
            </div>
            <div class="col-md">
              <div class="ftco-footer-widget mb-4">
                <h2 class="ftco-heading-2">Kontak Kami</h2>
                <div class="block-23 mb-3">
                  <ul>
                    <li><span class="icon icon-map-marker"></span><a href="https://goo.gl/maps/vZPXaV5YLmzpkNam9" target="_blank"><span class="text">Jl. Puri Cendana No.194, Sumberjaya, Kec. Tambun Sel., Kabupaten Bekasi, Jawa Barat 17510</span></a></li>
                    <li><div><span class="icon icon-phone"></span><span class="text">+62 859 6625 4648</span></div></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </footer>
      
    

    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


    <script src="{{ asset('assets/front-end/js/jquery.min.js')}}"></script>
    <script src="{{ asset('assets/front-end/js/jquery-migrate-3.0.1.min.js')}}"></script>
    <script src="{{ asset('assets/front-end/js/popper.min.js')}}"></script>
    <script src="{{ asset('assets/front-end/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('assets/front-end/js/jquery.easing.1.3.js')}}"></script>
    <script src="{{ asset('assets/front-end/js/jquery.waypoints.min.js')}}"></script>
    <script src="{{ asset('assets/front-end/js/jquery.stellar.min.js')}}"></script>
    <script src="{{ asset('assets/front-end/js/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('assets/front-end/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{ asset('assets/front-end/js/aos.js')}}"></script>
    <script src="{{ asset('assets/front-end/js/jquery.animateNumber.min.js')}}"></script>
    <script src="{{ asset('assets/front-end/js/bootstrap-datepicker.js')}}"></script>
    <script src="{{ asset('assets/front-end/js/scrollax.min.js')}}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="{{ asset('assets/front-end/js/google-map.js')}}"></script>
    <script src="{{ asset('assets/front-end/js/main.js')}}"></script>
      
    </body>
</html>