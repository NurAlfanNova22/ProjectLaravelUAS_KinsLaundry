@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4 text-primary">Status Cucian Anda</h3>

    @if(auth()->check())
        @php
            $pesanans = \App\Models\Pesanan::where('email_pelanggan', auth()->user()->email)->get();
        @endphp

        @if($pesanans->count() > 0)
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Jenis Laundry</th>
                        <th>Berat (kg)</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pesanans as $pesanan)
                        <tr>
                            <td>{{ ucfirst(str_replace('_', ' ', $pesanan->jenis_laundry)) }}</td>
                            <td>{{ $pesanan->berat }}</td>
                            <td>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                            <td>{{ ucfirst($pesanan->status) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-muted">Anda belum memiliki pesanan.</p>
        @endif
    @else
        <p class="text-danger">Silakan <a data-bs-toggle="modal" href="#"  data-bs-target="#loginModal">login</a> terlebih dahulu untuk melihat status cucian Anda.</p>
    @endif
</div>
@endsection