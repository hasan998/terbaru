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
    <!-- Profile -->
        <section class="ftco-section my-5">
            <div class="container">
                <div class="row justify-content-center mb-3 pb-3">
                  <div class="col-md-12 mb-5 heading-section text-center ftco-animate">
                    <span class="subheading">Profil</span>
                    <h2 class="mb-4">Biodata Kamu</h2>
                    @if (session('status'))
                        <p style="color: green">{{ session('status') }}</p>
                    @endif
                  </div>
                </div>   		
              </div>
            <div class="container my-5">
                <div class="row justify-content-center">
                    <div class="col-xl-12 ftco-animate">
                        
                        <form action="{{ route('profilUpdate.index', Auth::user()->user_id) }}" method="POST" enctype="multipart/form-data" class="billing-form">
                            @csrf
                            <h3 class="mb-4 billing-heading">Profile</h3>
                            <div class="row align-items-end mt-5">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="firstname">Firt Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="" value="{{ old('name', Auth::user()->name) }}">
                                    </div>
                                    @error('name')      
                                        <label class="text-xs px-1 mt-2 text-danger">
                                            {{ $message }}
                                        </label>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="firstname">Email</label>
                                        <input type="email" name="email" class="form-control" placeholder="" value="{{ old('email', Auth::user()->email) }}" disabled>
                                    </div>
                                    @error('email')      
                                        <label class="text-xs px-1 mt-2 text-danger">
                                            {{ $message }}
                                        </label>
                                    @enderror
                                </div>
                                <div class="w-100"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" name="no_telpon" class="form-control" placeholder="" value="{{ old('no_telpon', Auth::user()->no_telpon) }}">
                                    </div>
                                    @error('no_telpon')      
                                        <label class="text-xs px-1 mt-2 text-danger">
                                            {{ $message }}
                                        </label>
                                    @enderror
                                </div>
                                <div class="w-100"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="phone">Alamat</label>
                                        <textarea name="alamat" class="form-control" id="alamat" cols="20" rows="3">{{ old('alamat', Auth::user()->alamat) }}</textarea>
                                    </div>
                                    @error('alamat')      
                                        <label class="text-xs px-1 mt-2 text-danger">
                                            {{ $message }}
                                        </label>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary py-3 mt-5 px-4 w-100">Simpan</button>
                        </form>
                        <div class="col-md-3 mt-3 mx-auto">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-dark btn-md w-100 mb-3">Keluar</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section> <!-- .section -->
    <!-- Profile -->
@endsection