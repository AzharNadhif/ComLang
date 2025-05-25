@extends('layouts.main')

@section('content')
<div class="categories_area pt-85 pb-150">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="section-wrapper text-center mb-50">
                    <div class="success-icon mb-4">
                        <i class="fas fa-check-circle text-success" style="font-size: 80px;"></i>
                    </div>
                    <h2 class="section-title text-success">Payment Successful!</h2>
                    <p>Thank you for your purchase. Your order has been confirmed.</p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="success-card bg-white rounded shadow-sm p-4">
                    <div class="order-details">
                        <h4 class="mb-4 text-center">Order Details</h4>
                        
                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <strong>Order ID:</strong>
                            </div>
                            <div class="col-sm-8">
                                #{{ $pesanan->id_pesanan }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <strong>Order Date:</strong>
                            </div>
                            <div class="col-sm-8">
                                {{ $pesanan->tanggal_pesanan->format('d M Y, H:i') }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <strong>Total Amount:</strong>
                            </div>
                            <div class="col-sm-8">
                                <span class="text-success fw-bold">Rp {{ number_format($pesanan->total, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <strong>Payment Status:</strong>
                            </div>
                            <div class="col-sm-8">
                                @if($pesanan->pembayaran && $pesanan->pembayaran->status == 'success')
                                    <span class="badge bg-success">Paid</span>
                                @elseif($pesanan->pembayaran && $pesanan->pembayaran->status == 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @else
                                    <span class="badge bg-secondary">Processing</span>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <strong>Recipient:</strong>
                            </div>
                            <div class="col-sm-8">
                                {{ $pesanan->nama_penerima }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <strong>Phone Number:</strong>
                            </div>
                            <div class="col-sm-8">
                                {{ $pesanan->whatsapp }}
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-sm-4">
                                <strong>Shipping Address:</strong>
                            </div>
                            <div class="col-sm-8">
                                {{ $pesanan->alamat }}<br>
                                {{ $pesanan->kode_pos }}
                            </div>
                        </div>

                        <hr>

                        <div class="next-steps mt-4">
                            <h5 class="mb-3">What's Next?</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <i class="fas fa-envelope text-primary me-2"></i>
                                    You will receive an order confirmation email shortly
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-truck text-info me-2"></i>
                                    Your order will be processed and shipped within 1-2 business days
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-phone text-success me-2"></i>
                                    We will contact you via WhatsApp for shipping updates
                                </li>
                            </ul>
                        </div>

                        <div class="action-buttons text-center mt-4">
                            <a href="{{ route('user.orders') }}" class="btn btn-danger me-3">
                                <i class="fas fa-list me-2"></i>
                                View My Orders
                            </a>
                            <a href="{{ route('home') }}" class="btn btn-outline-danger">
                                <i class="fas fa-home me-2"></i>
                                Continue Shopping
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection