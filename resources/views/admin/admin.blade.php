@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- Menampilkan Jumlah Pesanan Hari Ini -->
    <div class="alert alert-info">
        <h5 class="mb-0">Jumlah Pesanan Hari Ini: <strong>{{ session('jumlahPesananHariIni') ?? $jumlahPesananHariIni }}</strong></h5>
    </div>

    <!-- Pesan Sukses -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Form Tambah Pesanan -->
    <h3 class="mb-4 text-primary">Tambah Pesanan</h3>
    <form action="{{ route('pesanan.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
            <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" required>
        </div>
        <div class="mb-3">
            <label for="email_pelanggan" class="form-label">Email Pelanggan</label>
            <input type="email" class="form-control" id="email_pelanggan" name="email_pelanggan" required>
        </div>
        <div class="mb-3">
            <label for="jenis_laundry" class="form-label">Jenis Laundry</label>
            <select class="form-select" id="jenis_laundry" name="jenis_laundry" required>
                <option value="cuci_basah">Cuci Basah - Rp 10.000/kg</option>
                <option value="cuci_kering">Cuci Kering - Rp 8.000/kg</option>
                <option value="setrika">Setrika - Rp 5.000/kg</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="berat" class="form-label">Berat (kg)</label>
            <input type="number" class="form-control" id="berat" name="berat" min="1" required>
        </div>
        <div class="mb-3">
            <label for="tanggal_pesanan" class="form-label">Tanggal Pesanan</label>
            <input type="date" class="form-control" id="tanggal_pesanan" name="tanggal_pesanan" value="{{ date('Y-m-d') }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambah Pesanan</button>
    </form>
    <!-- Menampilkan Data Pesanan Terbaru -->
    @if(session('pesananTerbaru'))
        <div class="mt-4">
            <h4>Data Pesanan Terbaru</h4>
            <ul class="list-group">
                <li class="list-group-item"><strong>Nama Pelanggan:</strong> {{ session('pesananTerbaru')->nama_pelanggan }}</li>
                <li class="list-group-item"><strong>Jenis Laundry:</strong> {{ ucfirst(str_replace('_', ' ', session('pesananTerbaru')->jenis_laundry)) }}</li>
                <li class="list-group-item"><strong>Berat:</strong> {{ session('pesananTerbaru')->berat }} kg</li>
                <li class="list-group-item"><strong>Tanggal Pesanan:</strong> {{ \Carbon\Carbon::parse(session('pesananTerbaru')->tanggal_pesanan)->format('d M Y') }}</li>
                <li class="list-group-item"><strong>Total Harga:</strong> Rp {{ number_format(session('pesananTerbaru')->total_harga, 0, ',', '.') }}</li>
            </ul>
        </div>
    @endif
</div>
@endsection
