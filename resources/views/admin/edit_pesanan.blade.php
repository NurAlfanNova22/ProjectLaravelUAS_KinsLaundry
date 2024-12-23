@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4 text-primary">Edit Pesanan</h3>
    <form action="{{ route('admin.pesanan.update', $pesanan->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
            <input type="text" class="form-control" name="nama_pelanggan" value="{{ $pesanan->nama_pelanggan }}" required>
        </div>
        <div class="mb-3">
            <label for="email_pelanggan" class="form-label">Email Pelanggan</label>
            <input type="email" class="form-control" name="email_pelanggan" value="{{ $pesanan->email_pelanggan }}" required>
        </div>
        <div class="mb-3">
            <label for="jenis_laundry" class="form-label">Jenis Laundry</label>
            <select class="form-select" name="jenis_laundry" required>
                <option value="cuci_basah" {{ $pesanan->jenis_laundry == 'cuci_basah' ? 'selected' : '' }}>Cuci Basah</option>
                <option value="cuci_kering" {{ $pesanan->jenis_laundry == 'cuci_kering' ? 'selected' : '' }}>Cuci Kering</option>
                <option value="setrika" {{ $pesanan->jenis_laundry == 'setrika' ? 'selected' : '' }}>Setrika</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="berat" class="form-label">Berat (kg)</label>
            <input type="number" class="form-control" name="berat" value="{{ $pesanan->berat }}" min="1" required>
        </div>
        <div class="mb-3">
            <label for="tanggal_pesanan" class="form-label">Tanggal Pesanan</label>
            <input type="date" class="form-control" name="tanggal_pesanan" value="{{ $pesanan->tanggal_pesanan }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection
