@extends('layouts.main')

@section('content')
<div class="categories_area pt-85 pb-150">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="section-wrapper text-center mb-50">
                    <h2 class="section-title">Payment</h2>
                    <p>Please complete the payment and upload your proof of transfer</p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="payment-box bg-white rounded shadow-sm p-4">
                    <div class="mb-4">
                        <h4 class="fw-bold">Total Payment: <span class="text-danger">Rp {{ number_format($subtotal, 0, ',', '.') }}</span></h4>
                    </div>

                    <div class="row align-items-center g-4 mb-4">
                        <div class="col-md-5 text-center">
                            <img src="{{ asset('images/qris.jpeg') }}" alt="QR Code" class="img-fluid border rounded" style="max-width: 100%;">
                        </div>
                        <div class="col-md-7">
                            <ul class="list-unstyled">
                                <li><strong>1.</strong> Transfer the amount to the QR code account (BCA, DANA, ShopeePay, etc.)</li>
                                <li><strong>2.</strong> Ensure the transferred amount matches the total payment</li>
                                <li><strong>3.</strong> Upload your payment proof below</li>
                            </ul>
                        </div>
                    </div>

                    <form action="{{ route('checkout.cart.process') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="bukti_pembayaran" class="form-label fw-semibold">Upload Payment Proof</label>
                            <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" accept="image/*" class="form-control" required>
                            @error('bukti_pembayaran')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-danger">Upload Proof</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection