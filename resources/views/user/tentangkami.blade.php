@extends('app')
@section('navbar')
  <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
      <div class="container">
        <a class="navbar-brand" href="{{ route('beranda.index') }}">CafDise</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="oi oi-menu"></span>
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active"><a href="{{ route('beranda.index') }}" class="nav-link">Beranda</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('menu.index') }}">Menu</a></li>
            <li class="nav-item"><a href="{{ route('tentangKami.index') }}" class="nav-link">Tentang Kami</a></li>
            @auth
              <li class="nav-item"><a href="{{ route('riwayat.index') }}" class="nav-link">Riwayat Pembelian</a></li>
              <li class="nav-item"><a href="{{ route('profil.index') }}" class="nav-link">{{ Auth::user()->name }}</a></li>
              @if ($pesananTotal == 0)
                <li class="nav-item cta cta-colored"><a href="{{ route('keranjang.index') }}" class="nav-link"><span class="icon-shopping_cart"></span>[0]</a></li>
              @else  
                <li class="nav-item cta cta-colored"><a href="{{ route('keranjang.index') }}" class="nav-link"><span class="icon-shopping_cart"></span>[{{ $pesananTotal }}]</a></li>
              @endif
            @else
              <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Masuk</a></li>
            @endauth
          </ul>
        </div>
      </div>
    </nav>
  <!-- Navbar -->
@endsection
@section('content')
  <!-- Tentang kami -->
    <section class="ftco-section my-5">
      <div class="container">
        <div class="row justify-content-center mb-3 pb-3">
          <div class="col-md-12 mb-5 heading-section text-center ftco-animate">
            <span class="subheading">Tentang Kami</span>
            <h2 class="mb-4">Cafe Paradise</h2>
          </div>
        </div>   		
      </div>
      <div class="container">
        <div class="row">
          <div class="col-md-5 p-md-5 img img-2 d-flex justify-content-center align-items-center" style="background-image: url({{ asset('assets/front-end/images/ftwardise/toko.jpeg')}});">
          </div>
          <div class="col-md-7 py-5 wrap-about pb-md-5 ftco-animate">
            <div class="heading-section-bold mb-4 mt-md-5">
              <div class="ml-md-0">
                <h2 class="mb-4">Selamat datang di Cafe Paeadise</h2>
              </div>
            </div>
            <div class="pb-md-5">
              <p>Cafe Paradise adalah sebuah bisnis yang berjalan pada bidang kuliner yang menyediakan berbagai makanan dan minuman serta tempat yang myaman untuk berkumpul dan menghabiskan waktu bersama kawan atau keluarga, selain itu Cafe Paradise juga menyediakan fasilitas seperti wife, terminal listrik, dan mainan untuk membuat para customer makin betah, alamag Cafe paradise yaitu Jl. Puri Cendana No.194, Sumberjaya, Kec. Tambun Sel., Kabupaten Bekasi, Jawa Barat 17510</p>
              <p><a href="{{ route('menu.index') }}" class="btn btn-primary">Belanja Sekarang</a></p>
            </div>
          </div>
        </div>
      </div>
    </section>
  <!-- Tentang kami -->
@endsection