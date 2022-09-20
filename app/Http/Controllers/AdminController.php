<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\PesananDetail;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pesanan = Pesanan::all();
        $user = User::all();
        $produk = Produk::all();
        return view('admin.dashboard', compact('produk', 'user', 'pesanan'));
    }

    public function user()
    {
        $user = User::all();
        return view('admin.user.user', compact('user'));
    }

    public function destroyUser($user_id)
    {
        $user = User::find($user_id);
        $user->delete();

        return back()->with('status', "Data User {$user->name} Berhasil Di Hapus");
    }

    public function produk()
    {
        $produk = Produk::all();
        return view('admin.produk.produk', compact('produk'));
    }

    public function pesanan()
    {
        $pesanan = Pesanan::all();
        return view('admin.pesanan.pesanan', compact('pesanan'));
    }

    public function pesananEdit($pesanan_id)
    {
        $pesanan = Pesanan::find($pesanan_id);
        return view('admin.pesanan.edit', compact('pesanan'));
    }

    public function pesananUpdate(Request $request, $pesanan_id) 
    {
        $request->validate([
            'status' => 'required',
            'nama_kurir' => 'required',
            'ongkir' => 'required|integer',
        ], [
            'status.required' => 'Status tidak boleh kosong',
            'nama_kurir.required' => 'Nama kurir tidak boleh kosong',
            'ongkir.required' => 'Ongkir tidak boleh kosong',
            'ongkir.integer' => 'Ongkir harus berbentuk angka',
        ]);

        $pesanan = Pesanan::find($pesanan_id);
        $pesanan->update([
            'status' => $request->status,
            'nama_kurir' => $request->nama_kurir,
            'ongkir' => $request->ongkir,
        ]);
        $pesanan->save();

        return redirect()->route('pesanan.index')->with('status', "Data Pesanan Berhasil Di Ubah");
    }

    public function pesananDetail()
    {
        $pesananDetail = PesananDetail::all();
        return view('admin.pesanan_detail', compact('pesananDetail'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.produk.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|max:32',
            'harga_produk' => 'required|integer',
            'kategori' => 'required',
            'keterangan' => 'required|max:150',
            'status_produk' => 'required',
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'nama_produk.required' => 'Nama produk tidak boleh kosong',
            'nama_produk.max' => 'Nama produk tidak boleh lebih dari 32 karakter',
            'harga_produk.required' => 'Harga produk tidak boleh kosong',
            'harga_produk.integer' => 'Harga produk harus berbentuk angka',
            'kategori.required' => 'Jenis produk tidak boleh kosong',
            'keterangan.required' => 'Keterangan produk tidak boleh kosong',
            'keterangan.max' => 'Keterangan produk tidak boleh lebih dari 150 karakter',
            'status_produk.required' => 'Status produk tidak boleh kosong',
            'gambar.required' => 'Foto produk tidak boleh kosong',
            'gambar.image' => 'Foto produk harus image',
            'gambar.mimes' => 'Foto produk harus berbentuk JPG, JPEG, PNG',
            'gambar.max' => 'Foto produk harus berukuran kurang dari 2mb',
        ]);

        $produk = new Produk([
            'nama_produk' => $request->nama_produk,
            'harga_produk' => $request->harga_produk,
            'kategori' => $request->kategori,
            'keterangan' => $request->keterangan,
            'status_produk' => $request->status_produk,
            'gambar' => $request->gambar,
        ]);

        if ($request->hasFile('gambar')) {
            $request->file('gambar')->move('images/produk', $request->file('gambar')->getClientOriginalName());
            $produk->gambar = $request->file('gambar')->getClientOriginalName();
            $produk->save();
        } 

        return redirect()->route('produk.index')->with('status', 'Data Produk Berhasil Di Tambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($produk_id)
    {
        $produk = Produk::find($produk_id);
        return view('admin.produk.edit', compact('produk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $produk_id)
    {
        $request->validate([
            'nama_produk' => 'required|max:32',
            'harga_produk' => 'required|integer',
            'kategori' => 'required',
            'keterangan' => 'required|max:150',
            'status_produk' => 'required',
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'nama_produk.required' => 'Nama produk tidak boleh kosong',
            'nama_produk.max' => 'Nama produk tidak boleh lebih dari 32 karakter',
            'harga_produk.required' => 'Harga produk tidak boleh kosong',
            'harga_produk.integer' => 'Harga produk harus berbentuk angka',
            'kategori.required' => 'Jenis produk tidak boleh kosong',
            'keterangan.required' => 'Keterangan produk tidak boleh kosong',
            'keterangan.max' => 'Keterangan produk tidak boleh lebih dari 150 karakter',
            'status_produk.required' => 'Status produk tidak boleh kosong',
            'gambar.required' => 'Foto produk tidak boleh kosong',
            'gambar.image' => 'Foto produk harus image',
            'gambar.mimes' => 'Foto produk harus berbentuk JPG, JPEG, PNG',
            'gambar.max' => 'Foto produk harus berukuran kurang dari 2mb',
        ]);

        $produk = Produk::find($produk_id);
        $produk->update([
            'nama_produk' => $request->nama_produk,
            'harga_produk' => $request->harga_produk,
            'kategori' => $request->kategori,
            'keterangan' => $request->keterangan,
            'status_produk' => $request->status_produk,
            'gambar' => $request->gambar,
        ]);

        if ($request->hasFile('gambar')) {
            $request->file('gambar')->move('images/produk', $request->file('gambar')->getClientOriginalName());
            $produk->gambar = $request->file('gambar')->getClientOriginalName();
            $produk->save();
        } 

        return redirect()->route('produk.index')->with('status', "Data Produk {$produk->nama_produk} Berhasil Di Ubah");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($produk_id)
    {
        $produk = Produk::find($produk_id);
        $produk->delete();

        return back()->with('status', "Data Produk {$produk->nama_produk} Berhasil Di Ubah");
    }
}
