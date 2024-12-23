@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3 class="mb-4">Detail Pesanan</h3>
    <ul class="list-group">
        <li class="list-group-item"><strong>Nama Pelanggan:</strong> {{ $pesanan->nama_pelanggan }}</li>
        <li class="list-group-item"><strong>Jenis Laundry:</strong> {{ ucfirst(str_replace('_', ' ', $pesanan->jenis_laundry)) }}</li>
        <li class="list-group-item"><strong>Berat:</strong> {{ $pesanan->berat }} kg</li>
        <li class="list-group-item"><strong>Tanggal Pesanan:</strong> {{ \Carbon\Carbon::parse($pesanan->tanggal_pesanan)->format('d M Y') }}</li>
        <li class="list-group-item"><strong>Total Harga:</strong> Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</li>
    </ul>
    <a href="{{ url('/admin') }}" class="btn btn-success mt-3">Kembali ke Admin</a>
</div>
@endsection