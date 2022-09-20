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
    <!-- Detail produk -->
        <section class="ftco-section my-5">
            <div class="container">
                <div class="row justify-content-center mb-3 pb-3">
                  <div class="col-md-12 heading-section text-center ftco-animate">
                    <span class="subheading">Detail</span>
                    <h2 class="mb-4">Detail Menu</h2>
                    @if (session('status'))
                        <p style="color: red">{{ session('status') }}</p>
                    @endif
                  </div>
                </div>   		
              </div>
            <div class="container my-5">
                <div class="row">
                    <div class="col-lg-6 mb-5 ftco-animate">
                        <a href="images/product-1.jpg" class="image-popup"><img src="{{ asset('images/produk/'.$produk->gambar) }}" class="img-fluid" alt="Colorlib Template"></a>
                    </div>
                    <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                        <h3>{{ $produk->nama_produk }}</h3>
                        <div class="rating d-flex">
                                <p class="text-left mr-4">
                                    <a class="mr-2">5.0</a>
                                    <a><span style="color: yellow" class="ion-ios-star-outline"></span></a>
                                    <a><span style="color: yellow" class="ion-ios-star-outline"></span></a>
                                    <a><span style="color: yellow" class="ion-ios-star-outline"></span></a>
                                    <a><span style="color: yellow" class="ion-ios-star-outline"></span></a>
                                    <a><span style="color: yellow" class="ion-ios-star-outline"></span></a>
                                </p>
                            </div>
                        <p class="price"><span>Rp. {{ number_format($produk->harga_produk, 0, ',','.') }}</span></p>
                        <p>{{ $produk->keterangan }}</p>
                        <form action="{{ route('pesan.store', $produk->produk_id) }}" method="POST" enctype="multipart/form-data">
                            @csrf 
                            <div class="row mt-4">
                                <div class="w-100"></div>
                                <div class="input-group col-md-6 d-flex mb-3">
                                    <input type="number" id="quantity" name="jumlah_pesanan" class="form-control input-number" value="1" min="0">
                                </div>
                                <div class="w-100"></div>
                            </div>
                            <button style="background-color: black; color: black; border-radius: 10px; padding: 10px" type="submit">Tambah Ke Keranjang</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    <!-- Detail produk -->
@endsection