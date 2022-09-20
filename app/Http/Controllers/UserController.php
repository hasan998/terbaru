<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\PesananDetail;
use App\Models\Produk;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

use function PHPUnit\Framework\returnSelf;

class UserController extends Controller
{
    public function index()
    {
        if (Auth::user()) {
            $pesanan = Pesanan::where('user_id', Auth::user()->user_id)->where('status', 'Check Out')->first();
            ($pesanan == null) ? $pesananTotal = 0 : $pesananTotal = PesananDetail::where('pesanan_id', $pesanan->pesanan_id)->count();

            $produk = Produk::paginate(4);
            return view('user.beranda', compact('produk', 'pesananTotal'));
        } 

        $produk = Produk::paginate(4);
        return view('user.beranda', compact('produk'));
    }

    public function menu()
    {
        if (Auth::user()) {
            $pesanan = Pesanan::where('user_id', Auth::user()->user_id)->where('status', 'Check Out')->first();
            ($pesanan == null) ? $pesananTotal = 0 : $pesananTotal = PesananDetail::where('pesanan_id', $pesanan->pesanan_id)->count();

            $produk = Produk::all();
            return view('user.menu', compact('produk', 'pesananTotal'));
        } 

        $produk = Produk::all();
        return view('user.menu', compact('produk'));
    }

    public function menuDetail($produk_id)
    {
        if (Auth::user()) {
            $pesanan = Pesanan::where('user_id', Auth::user()->user_id)->where('status', 'Check Out')->first();
            ($pesanan == null) ? $pesananTotal = 0 : $pesananTotal = PesananDetail::where('pesanan_id', $pesanan->pesanan_id)->count();

            $produk = Produk::find($produk_id);
            return view('user.produk_detail', compact('produk', 'pesananTotal'));
        } 

        $produk = Produk::find($produk_id);
        return view('user.produk_detail', compact('produk', 'pesananTotal'));
    }

    public function about()
    {
        if (Auth::user()) {
            $pesanan = Pesanan::where('user_id', Auth::user()->user_id)->where('status', 'Check Out')->first();
            ($pesanan == null) ? $pesananTotal = 0 : $pesananTotal = PesananDetail::where('pesanan_id', $pesanan->pesanan_id)->count();

            return view('user.tentangkami', compact('pesananTotal'));
        } 

        return view('user.tentangkami');
    }

    public function cart()
    {
        $pesanan = Pesanan::where('user_id', Auth::user()->user_id)->where('status', 'Check Out')->first();
        ($pesanan == null) ? $pesananTotal = 0 : $pesananTotal = PesananDetail::where('pesanan_id', $pesanan->pesanan_id)->count();

        if(!empty($pesanan)) {
            $pesananDetail = PesananDetail::where('pesanan_id', $pesanan->pesanan_id)->get();
            return view('user.keranjang', compact('pesanan', 'pesananDetail', 'pesananTotal'));
        }
            return redirect()->route('menu.index')->with('status', 'Anda belum memesan, silahkan pesan terlebih dahulu');
    }

    public function cartDelete($pesanandetail_id)
    {
         // Mencari pesanan detail id
         $pesananDetail = PesananDetail::where('pesanandetail_id', $pesanandetail_id)->first();
         // Mencari pesanan dengan id yang sama dengan pesanan detail
         $pesanan = Pesanan::where('pesanan_id', $pesananDetail->pesanan_id)->first();
         $pesananDetail->delete();
 
         // Mencari pesanan detail id yang sama pesanan id
         $pesananId = Pesanan::where('user_id', Auth::user()->user_id)->where('status', 'Check Out')->first();
         $pesananDetailId = PesananDetail::where('pesanan_id', $pesananId->pesanan_id)->first(); 
 
         if(empty($pesananDetailId)) {
             $pesanan->delete();
             return redirect()->route('menu.index')->with('status', 'Keranjang Anda Kosong!, Silahkan Lakukan Pemesanan');
         } else {
             // Mengupdate pesanan jumlah harga
             $total  = $pesanan->total_harga - $pesananDetail->total_harga;
             $pesanan->update([
                 'total_harga' => $total,
             ]);
             $pesanan->save();
 
             return redirect()->back()->with('status', 'Pesanan Berhasil Dihapus!');
         }
    }

    public function checkOut()
    {
        $user = User::where('user_id', Auth::user()->user_id)->first();
        if(empty($user->alamat) || empty($user->no_telpon)){
            return redirect()->route('profil.index')->with('status', 'Lengkapi Profile Anda Terlebih Dahulu!');
        } 

        $pesananUpdate = Pesanan::where('user_id', Auth::user()->user_id)->where('status', 'Check Out')->first();
        $pesananUpdate->update([
            'status' => 'Belum Bayar',
        ]);
        $pesananUpdate->save();

        return redirect()->route('menu.index')->with('status', 'Pesanan Berhasil Di Check Out');
    }

    public function riwayat()
    {
        $pesanan = Pesanan::where('user_id', Auth::user()->user_id)->where('status', 'Check Out')->first();
        $pesananAll = Pesanan::all()->where('status', '!=', 'Check Out');
        ($pesanan == null) ? $pesananTotal = 0 : $pesananTotal = PesananDetail::where('pesanan_id', $pesanan->pesanan_id)->count();

        return view('user.riwayat_pembelian', compact('pesananTotal', 'pesananAll'));
    }

    public function riwayatDetail($pesanan_id)
    {
        $pesanan = Pesanan::where('user_id', Auth::user()->user_id)->where('status', 'Check Out')->first();
        ($pesanan == null) ? $pesananTotal = 0 : $pesananTotal = PesananDetail::where('pesanan_id', $pesanan->pesanan_id)->count();
        $pesananKonfirmasi = Pesanan::where('pesanan_id', $pesanan_id)->where('ongkir', null)->where('nama_kurir', null)->first();
        $pesananUser = Pesanan::where('pesanan_id', $pesanan_id)->first();
        $pesananDetailAll = PesananDetail::where('pesanan_id', $pesananUser->pesanan_id)->get();
        if (!$pesananKonfirmasi == null) {
            return view('user.konfirmasi', compact('pesananTotal'));
        } 
        return view('user.riwayat_pembelian_detail', compact('pesananDetailAll', 'pesananTotal', 'pesananUser'));
    }

    public function profil()
    {
        if (Auth::user()) {
            $pesanan = Pesanan::where('user_id', Auth::user()->user_id)->where('status', 'Check Out')->first();
            ($pesanan == null) ? $pesananTotal = 0 : $pesananTotal = PesananDetail::where('pesanan_id', $pesanan->pesanan_id)->count();

            return view('user.profile', compact('pesananTotal'));
        } 
        
        return view('user.profile');
    }

    public function profilUpdate(Request $request, $user_id)
    {
        $request->validate([
            'no_telpon' => 'required|max:13',
            'alamat' => 'required|max:150'
        ], [
            'no_telpon.required' => 'No Handphone tidak boleh kosong',
            'no_telpon.max' => 'No Handphone tidak boleh lebih dari 13 angka',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'alamat.max' => 'Alamat tidak boleh lebih dari 150 karakter',
        ]);

        $user = User::find($user_id);
        $user->update([
            'no_telpon' => $request->no_telpon,
            'alamat' => $request->alamat,
        ]);
        $user->save();

        return back()->with('status', 'Profile Berhasil Di perbaharui');
    }

    public function pesan(Request $request, $produk_id)
    {
        // Validasi
        $request->validate([
            'jumlah_pesanan' => 'required',
        ],[
            'jumlah_pesanan.required' => 'Masukkan jumlah pesanan',
        ]);

        $produk = Produk::find($produk_id);
        $tanggal = Carbon::now()->format('Y-m-d');
        $total = $produk->harga_produk * $request->jumlah_pesanan;

        // User menambah pesanan
        $pesananTambah = Pesanan::where('user_id', Auth::user()->user_id)->where('status', 'Check Out')->first();

        // Simpan pesanan ke database pesanan
        if(!($request->jumlah_pesanan) == 0) {
            if(empty($pesananTambah)){
                $pesanan = new Pesanan([
                    'user_id' => Auth::user()->user_id,
                    'tanggal' => $tanggal,
                    'status' => 'Check Out',
                    'total_harga' => $total,
                ]);
                $pesanan->save();
            } else {
                $pesananUpdate = Pesanan::where('user_id', Auth::user()->user_id)->where('status', 'Check Out')->first();
                $pesananUpdate->update([
                    'total_harga' => $pesananUpdate->total_harga + $total,
                ]);
                $pesananUpdate->save();
            }
        } else {
            return back()->with('status', 'Masukkan jumlah pesanan');
        }

        $newPesananId = Pesanan::where('user_id', Auth::user()->user_id)->where('status', 'Check Out')->first();
        $total = $produk->harga_produk * $request->jumlah_pesanan;
       
        $pesananDetailTambah = PesananDetail::where('produk_id', $produk->produk_id)->where('pesanan_id', $newPesananId->pesanan_id)->first();

        if(!($request->jumlah_pesanan) == 0) {
            if(empty($pesananDetailTambah)) {
                // Menambah baru pesanan 
                $pesananDetail = new PesananDetail([
                    'produk_id' => $produk->produk_id,
                    'pesanan_id' => $newPesananId->pesanan_id,
                    'jumlah_pesanan' => $request->jumlah_pesanan,
                    'total_harga'  => $total,
                ]);
                $pesananDetail->save();
            } else {
                // Mengupdate pesanan detail
                $pesananDetailUpdate = PesananDetail::where('produk_id', $produk->produk_id)->where('pesanan_id', $newPesananId->pesanan_id)->first();
                $pesananDetailUpdate->update([
                    'jumlah_pesanan' => $pesananDetailUpdate->jumlah_pesanan + $request->jumlah_pesanan,
                    'total_harga' => $pesananDetailUpdate->total_harga + $total,
                ]);
                $pesananDetailUpdate->save();
            }
        } else {
            return back()->with('status', 'Masukkan jumlah pesanan');
        }

        return redirect()->route('keranjang.index')->with('status', 'Pesanan anda sudah masuk ke keranjang');
    }
}
