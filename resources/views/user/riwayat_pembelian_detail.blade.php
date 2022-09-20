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
              <span class="subheading">Pembayaran</span>
              <h2 class="mb-4">Pesanan Kamu</h2>
              <p>Silahkan anda transfer di rekening <b>BANK BRI Nomor Rekening : 32113-821312-123 <br> dengan nominal : <b> Rp. {{ number_format($pesananUser->total_harga + $pesananUser->ongkir, 0, ',', '.') }} </b> <br> Kemudian konfirmasi melalui via Whatsapp dengan nomor: <b>0827328328</b> <br> 
                cantumkan nama <b>(Nama harus sesuai dengan akun Cafe Paradise)</b></p>
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
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($pesananDetailAll as $item)
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
                  <span>Rp. {{ number_format($pesananUser->total_harga, 0, ',', '.') }}</span>
                </p>
                <p class="d-flex">
                  <span>Ongkir</span>
                  <span>Rp. {{ number_format($pesananUser->ongkir, 0, ',', '.') }}</span>
                </p>
                <p class="d-flex">
                  <span>Nama Kurir</span>
                  <span>{{ $pesananUser->nama_kurir }}</span>
                </p>
                <hr>
                <p class="d-flex total-price">
                  <span>Total</span>
                  <span>Rp. {{ number_format($pesananUser->total_harga + $pesananUser->ongkir, 0, ',', '.') }}</span>
                </p>
              </div>
                  </div>
                </div>
        </div>
      </section>
    <!-- Keranjang -->
@endsection