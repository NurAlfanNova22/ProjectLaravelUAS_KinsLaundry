@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3 class="mb-4">Tambah Pesanan</h3>
    <form action="{{ route('pesanan.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
            <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" required>
        </div>
        <div class="mb-3">
            <label for="jenis_laundry" class="form-label">Jenis Laundry</label>
            <select class="form-select" id="jenis_laundry" name="jenis_laundry" required>
                <option value="cuci_basah">Cuci Basah - 10.000/kg</option>
                <option value="cuci_kering">Cuci Kering - 8.000/kg</option>
                <option value="setrika">Setrika - 5.000/kg</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="berat" class="form-label">Berat (kg)</label>
            <input type="number" class="form-control" id="berat" name="berat" min="1" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambah Pesanan</button>
    </form>
</div>
@endsection
