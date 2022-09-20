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
    <!-- Riwayat pembelian -->
        <section class="ftco-section ftco-cart my-5">
            <div class="container">
                <div class="row justify-content-center mb-3 pb-3">
                  <div class="col-md-12 mb-5 heading-section text-center ftco-animate">
                    <span class="subheading">Riwayat</span>
                    <h2 class="mb-4">Pembelian Kamu</h2>
                  </div>
                </div>   		
              </div>
            <div class="container my-5">
                <div class="row">
                    <div class="col-md-12 ftco-animate">
                        <div class="cart-list">
                            <table class="table">
                                <thead class="thead-primary">
                                <tr class="text-center">
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th>&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                  @forelse ($pesananAll as $item)
                                    <tr class="text-center">
                                        
                                        <td class="price">Rp. {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                        
                                        <td class="price">
                                          {{ $item->status }}
                                        </td>
                                        
                                        <td class="total">{{ date('d M Y', strtotime($item->tanggal)) }}</td>
                                        <td class="total"><a href="{{ route('riwayatDetail.index', $item->pesanan_id) }}">Lihat detail</a></td>
                                      </tr>  
                                  @empty
                                      
                                  @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!-- Riwayat pembelian -->
@endsection