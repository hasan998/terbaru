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
            <li class="nav-item"><a href="{{ route('beranda.index') }}" class="nav-link">Beranda</a></li>
            <li class="nav-item active"><a class="nav-link" href="{{ route('menu.index') }}">Menu</a></li>
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
  <!-- Menu -->
    <section class="ftco-section">
      <div class="container">
        <div class="row justify-content-center mb-3 pb-3">
          <div class="col-md-12 heading-section text-center ftco-animate">
            <h2 class="mb-4">Menu Kami</h2>
            @if (session('status'))
                <p style="color: green">{{ session('status') }}</p>
              @endif
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
                  <div class="bottom-area d-flex mt-4 px-3">
                    <div class="m-auto d-flex">
                      <a href="{{ route('menuDetail.index', $item->produk_id) }}" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                        <span><i class="ion-ios-cart"></i></span>
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
  <!-- Menu -->
@endsection