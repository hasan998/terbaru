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
    <!-- Keranjang -->
      <section class="ftco-section ftco-cart">
        <div class="container">
          <div class="row justify-content-center mb-3 pb-3">
            <div class="col-md-12 mb-5 heading-section text-center ftco-animate">
              <span class="subheading">Keranjang</span>
              <h2 class="mb-4">Pesanan Kamu</h2>
              @if (session('status'))
                <p style="color: green">{{ session('status') }}</p>
              @endif
            </div>
          </div>   		
        </div>
        <div class="container">
          <div class="row">
            <div class="col-md-12 ftco-animate">
              <div class="cart-list">
                <table class="table">
                  <thead class="thead-primary">
                    <tr class="text-center">
                      <th>&nbsp;</th>
                      <th>Product name</th>
                      <th>Price</th>
                      <th>Quantity</th>
                      <th>Total</th>
                      <th>&nbsp;</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($pesananDetail as $item)
                      <tr class="text-center">
                        <td class="image-prod"><div class="img" style="background-image:url({{ asset('images/produk/'.$item->produk->gambar)}});"></div></td>
                        <td class="product-name">
                          <h3>{{ $item->produk->nama_produk }}</h3>
                          <p>{{ $item->produk->keterangan }}</p>
                        </td>
                        <td class="price">Rp. {{ number_format($item->produk->harga_produk, 0, ',','.') }}</td>
                        <td class="quantity">
                          <div class="input-group mb-3">
                            <input type="text" name="quantity" class="quantity form-control input-number" value="{{ $item->jumlah_pesanan }}" disabled>
                          </div>
                        </td>
                        <td class="total">Rp. {{ number_format($item->total_harga, 0, ',','.') }}</td>
                        <td class="total">&nbsp;</td>
                        <td class="product-remove">
                          <form action="{{ route('cart.destroy', $item->pesanandetail_id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus data ini ?')">
                            @method('delete')
                            @csrf
                            <button style="background-color: red; width: 20px; color: black;" class="ion-ios-close"></button>
                          </form>
                        </td>
                      </tr>
                    @empty
                        
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          
          <div class="row justify-content-end">
            <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
              <div class="cart-total mb-3">
                <h3>Cart Totals</h3>
                <p class="d-flex">
                  <span>Subtotal</span>
                  <span>{{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
                </p>
                <hr>
                <p class="d-flex total-price">
                  <span>Total</span>
                  <span>{{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
                </p>
              </div>
              <form action="{{ route('cart.checkOut') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <button type="submit" class="btn btn-primary py-3 px-4" onsubmit="return confirm('Anda yakin ingin check out ?')">Pesan Sekarang</button>
              </form>
                  </div>
                </div>
            </div>
      </section>
    <!-- Keranjang -->
@endsection