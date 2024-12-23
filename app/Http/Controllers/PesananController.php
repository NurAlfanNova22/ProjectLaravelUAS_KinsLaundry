<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class PesananController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_pelanggan' => 'required|string',
            'email_pelanggan' => 'required|email',
            'jenis_laundry' => 'required|string',
            'berat' => 'required|integer|min:1',
            'tanggal_pesanan' => 'required|date',
        ]);
    
        // Harga per jenis layanan
        $harga_per_kg = [
            'cuci_basah' => 10000,
            'cuci_kering' => 8000,
            'setrika' => 5000,
        ];
    
        // Hitung total harga
        $total_harga = $request->berat * $harga_per_kg[$request->jenis_laundry];
    
        // Simpan data pesanan
        Pesanan::create([
            'nama_pelanggan' => $request->nama_pelanggan,
            'email_pelanggan' => $request->email_pelanggan,
            'jenis_laundry' => $request->jenis_laundry,
            'berat' => $request->berat,
            'total_harga' => $total_harga,
            'tanggal_pesanan' => $request->tanggal_pesanan,
        ]);
    
        return back()->with('success', 'Pesanan berhasil ditambahkan!');
    }
         
    public function create()
    {
        // Hitung jumlah pesanan hari ini
        $jumlahPesananHariIni = Pesanan::whereDate('tanggal_pesanan', now()->toDateString())->count();

        // Kirim data jumlah pesanan ke tampilan admin
        return view('admin.admin', ['jumlahPesananHariIni' => $jumlahPesananHariIni]);
    }
    public function index()
    {
        // Ambil semua pesanan
        $pesanans = Pesanan::all();
        return view('admin.manage_pesanan', ['pesanans' => $pesanans]);
    }

    public function updateStatus(Request $request, $id)
    {
        // Validasi input status
        $request->validate([
            'status' => 'required|string|in:belum dicuci,masih proses,selesai',
        ]);
    
        // Ambil data pesanan berdasarkan ID
        $pesanan = Pesanan::findOrFail($id);
    
        // Update status pesanan
        $pesanan->status = $request->status;
        $pesanan->save();
    
        // Redirect kembali dengan pesan sukses
        return back()->with('success', 'Status pesanan berhasil diperbarui!');
    }
    public function show($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        return view('admin.show_pesanan', compact('pesanan'));
    }
    
    public function edit($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        return view('admin.edit_pesanan', compact('pesanan'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string',
            'email_pelanggan' => 'required|email',
            'jenis_laundry' => 'required|string',
            'berat' => 'required|integer|min:1',
            'tanggal_pesanan' => 'required|date',
        ]);
    
        $harga_per_kg = [
            'cuci_basah' => 10000,
            'cuci_kering' => 8000,
            'setrika' => 5000,
        ];
    
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->update([
            'nama_pelanggan' => $request->nama_pelanggan,
            'email_pelanggan' => $request->email_pelanggan,
            'jenis_laundry' => $request->jenis_laundry,
            'berat' => $request->berat,
            'total_harga' => $request->berat * $harga_per_kg[$request->jenis_laundry],
            'tanggal_pesanan' => $request->tanggal_pesanan,
        ]);
    
        return redirect()->route('admin.pesanan')->with('success', 'Pesanan berhasil diperbarui!');
    }
    
    public function destroy($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->delete();
        return back()->with('success', 'Pesanan berhasil dihapus!');
    }    
}