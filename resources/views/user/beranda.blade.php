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
  <!-- Slider image -->
    <section id="home-section" class="hero">
      <div class="home-slider owl-carousel">
        <div class="slider-item" style="background-image: url({{ asset('assets/front-end/images/ftwardise/toko.jpeg')}});">
          <div class="overlay"></div>
          <div class="container">
            <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">
              <div class="col-md-12 ftco-animate text-center">
                <h1 class="mb-2">Menyediakan makanan dan minuman</h1>
                <h2 class="subheading mb-4">Pesan sekarang</h2>
                <p>
                  <a href="{{ route('menu.index') }}" class="btn btn-primary">Lihat menu</a>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  <!-- Slider image -->

  <!-- Service -->
    <section class="ftco-section">
      <div class="container">
        <div class="row no-gutters ftco-services">
          <div class="col-md-4 text-center d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services mb-md-0 mb-4">
              <div class="icon bg-color-1 active d-flex justify-content-center align-items-center mb-2">
                <span class="flaticon-shipped"></span>
              </div>
              <div class="media-body">
                <h3 class="heading">Gratis Ongkir</h3>
                <span>Gratis ongkir hanya di daerah tambun dan sekitarnya</span>
              </div>
            </div>      
          </div>
          <div class="col-md-4 text-center d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services mb-md-0 mb-4">
              <div class="icon bg-color-2 d-flex justify-content-center align-items-center mb-2">
                <span class="flaticon-diet"></span>
              </div>
              <div class="media-body">
                <h3 class="heading">Terjamin Kualitasnya</h3>
                <span>Kami menjamin kualiatas makanan dan minuman</span>
              </div>
            </div>    
          </div>
          <div class="col-md-4 text-center d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services mb-md-0 mb-4">
              <div class="icon bg-color-4 d-flex justify-content-center align-items-center mb-2">
                <span class="flaticon-customer-service"></span>
              </div>
              <div class="media-body">
                <h3 class="heading">24 Jam</h3>
                <span>Kami akan selalu ada 24 jam</span>
              </div>
            </div>      
          </div>
        </div>
      </div>
    </section>
  <!-- Service -->

  <!-- Feature produk -->
    <section class="ftco-section">
      <div class="container">
        <div class="row justify-content-center mb-3 pb-3">
          <div class="col-md-12 heading-section text-center ftco-animate">
            <span class="subheading">Menu Kami</span>
            <h2 class="mb-4">Paling Terlaris</h2>
            <p>Berikut merupakan menu - menu yang paling terlalis yang ada di Wardise</p>
          </div>
        </div>   		
      </div>
      <div class="container">
        <div class="row">
          @forelse ($produk as $item)
            <div class="col-md-6 col-lg-3 ftco-animate">
              <div class="product">
                <a href="{{ route('menuDetail.index', $item->produk_id) }}" class="img-prod"><img style="width: 255px; height: 200px;" class="img-fluid" src="{{ asset('images/produk/'.$item->gambar)}}" alt="Colorlib Template">
                  <div class="overlay"></div>
                </a>
                <div class="text py-3 pb-4 px-3 text-center">
                  <h3><a href="{{ route('menuDetail.index', $item->produk_id) }}">{{ $item->nama_produk }}</a></h3>
                  <div class="d-flex">
                    <div class="pricing">
                      <p class="price"><span class="price-sale">Rp. {{ number_format($item->harga_produk, 0, ',','.') }}</span></p>
                    </div>
                  </div>
                  <div class="bottom-area d-flex px-3">
                    <div class="m-auto d-flex">
                      <a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                        <span><i class="ion-ios-menu"></i></span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @empty
              
          @endforelse
        </div>
      </div>
    </section>
  <!-- Feature produk -->

  <!-- Testimony -->
    <section class="ftco-section testimony-section">
      <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section ftco-animate text-center">
            <span class="subheading">Testimoni</span>
            <h2 class="mb-4">Dari Pelanggan Kami</h2>
          </div>
        </div>
        <div class="row ftco-animate">
          <div class="col-md-12">
            <div class="carousel-testimony owl-carousel">
              <div class="item">
                <div class="testimony-wrap p-4 pb-5">
                  <div class="user-img mb-5" style="background-image: url({{ asset('assets/front-end/images/person_1.jpg')}})">
                    <span class="quote d-flex align-items-center justify-content-center">
                      <i class="icon-quote-left"></i>
                    </span>
                  </div>
                  <div class="text text-center">
                    <p class="mb-5 pl-4 line">Gratis ongkir emg paling mantep dan menghemat juga, makanan dan minumannya seger bgt</p>
                    <p class="name">Daffa Septian</p>
                    <span class="position">Mahasiswa</span>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap p-4 pb-5">
                  <div class="user-img mb-5" style="background-image: url({{ asset('assets/front-end/images/person_2.jpg')}})">
                    <span class="quote d-flex align-items-center justify-content-center">
                      <i class="icon-quote-left"></i>
                    </span>
                  </div>
                  <div class="text text-center">
                    <p class="mb-5 pl-4 line">Harganya murah - murah bgt dan juga ada gratis ongkirnya di wilayah tambun, keren bgt deh</p>
                    <p class="name">Dimas Akbar Lonardi</p>
                    <span class="position">Mahasiswa</span>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap p-4 pb-5">
                  <div class="user-img mb-5" style="background-image: url({{ asset('assets/front-end/images/person_3.jpg')}})">
                    <span class="quote d-flex align-items-center justify-content-center">
                      <i class="icon-quote-left"></i>
                    </span>
                  </div>
                  <div class="text text-center">
                    <p class="mb-5 pl-4 line">Pelayanannya 24 jam wuh keren bgt emg wardise, gratis ongkirnya juga paling mantep</p>
                    <p class="name">Raffly Ananda Fadila</p>
                    <span class="position">Mahasiswa</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  <!-- Testimony -->
@endsection