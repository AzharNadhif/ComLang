@extends('layouts.main')

@section('content')
    <div class="container">
        <h1 class="fw-bold fs-3">Order History</h1>
        <br>

        <div class="table-responsive">
            <table class="table table-bordered table-hover bg-light rounded">
                <thead class="table-light">
                    <tr>
                        <th>Product</th>
                        <th>Recipients</th>
                        <th>No. Whatsapp</th>
                        <!-- <th>Email</th> -->
                        <th>Address</th>
                        <th>Zip Code</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pesanan as $order)
                        <tr>
                            <td>
                                @if($order->detail && $order->detail->count())
                                    {{ $order->detail->pluck('produk.nama_produk')->join(', ') }}
                                @else
                                    {{ $order->produk->nama_produk ?? '-' }}
                                @endif
                            </td>
                            <td>{{ $order->nama_penerima }}</td>
                            <td>{{ $order->whatsapp }}</td>
                            <!-- <td>{{ $order->user->email ?? '-' }}</td> -->
                            <td>{{ $order->alamat }}</td>
                            <td>{{ $order->kode_pos }}</td>
                            <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge
                                    @if($order->id_status == 1) bg-warning
                                    @elseif($order->id_status == 2) bg-primary
                                    @elseif($order->id_status == 3) bg-success
                                    @endif">
                                    {{ $order->status->nama_status ?? '-' }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No orders yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <br>
            <br>
        </div>
    </div>
@endsection
