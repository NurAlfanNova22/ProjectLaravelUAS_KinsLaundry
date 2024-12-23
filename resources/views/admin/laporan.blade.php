@extends('layouts.app')

@section('title', 'Laporan Keuangan')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4 text-primary">Laporan Keuangan Bulan Ini</h3>
    <div class="d-flex justify-content-between mb-3">
        <h5>Total Pendapatan: <span class="text-success">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</span></h5>
        <a href="{{ route('admin.laporan.print') }}" class="btn btn-primary">Print Laporan</a>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Jenis Laundry</th>
                <th>Berat (kg)</th>
                <th>Total Harga</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pesanans as $index => $pesanan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ ucfirst(str_replace('_', ' ', $pesanan->jenis_laundry)) }}</td>
                    <td>{{ $pesanan->berat }}</td>
                    <td>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                    <td>{{ $pesanan->created_at->format('d M Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data untuk bulan ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
