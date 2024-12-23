@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4 text-primary">Manajemen Pesanan</h3>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Pelanggan</th>
                <th>Email</th>
                <th>Jenis Laundry</th>
                <th>Berat (kg)</th>
                <th>Total Harga</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pesanans as $pesanan)
                <tr>
                    <td>{{ $pesanan->nama_pelanggan }}</td>
                    <td>{{ $pesanan->email_pelanggan }}</td>
                    <td>{{ ucfirst(str_replace('_', ' ', $pesanan->jenis_laundry)) }}</td>
                    <td>{{ $pesanan->berat }}</td>
                    <td>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                    <td>{{ ucfirst($pesanan->status) }}</td>
                    <td>
                        <!-- Form Update Status -->
                        <form action="{{ route('admin.pesanan.update', $pesanan->id) }}" method="POST">
                            @csrf
                            @method('PUT') <!-- Tambahkan ini untuk mengubah metode menjadi PUT -->
                            <select name="status" class="form-select mb-2">
                                <option value="belum dicuci" {{ $pesanan->status == 'belum dicuci' ? 'selected' : '' }}>Belum Dicuci</option>
                                <option value="masih proses" {{ $pesanan->status == 'masih proses' ? 'selected' : '' }}>Masih Proses</option>
                                <option value="selesai" {{ $pesanan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                            <button type="submit" class="btn btn-sm btn-primary">Update</button>
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('admin.pesanan.edit', $pesanan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <!-- Tombol Hapus -->
                        <form action="{{ route('admin.pesanan.destroy', $pesanan->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus pesanan ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
