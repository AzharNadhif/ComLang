@extends('layouts.main')

@section('content')
<!-- pembayaran area start -->
<div class="categories_area pt-85 pb-150">
    <div class="container">
        <div class="row justify-content-center mb-50">
            <div class="col-xl-10">
                <div class="section-wrapper text-center">
                    <h2 class="section-title">Payment</h2>
                    <p>Please transfer according to instructions and upload proof of payment</p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="bg-white rounded shadow p-5">
                    <h4 class="mb-4">Total Pembayaran:
                        <span class="text-danger">Rp {{ number_format($pesanan->total, 0, ',', '.') }}</span>
                    </h4>

                    <div class="row align-items-center g-4 mb-4">
                        <div class="col-md-5 text-center">
                            <img src="{{ asset('images/qris.jpeg') }}" alt="QR Code" class="img-fluid rounded border">
                        </div>
                        <div class="col-md-7">
                            <ul class="list-unstyled lh-lg">
                                <li><strong>1.</strong> Transfer to QRIS (Gopay, Dana, ShopeePay, etc)</li>
                                <li><strong>2.</strong> Make sure the amount matches the total payment</li>
                                <li><strong>3.</strong> Upload proof of payment after transfer</li>
                            </ul>
                        </div>
                    </div>

                    <form action="{{ route('checkout.upload.simpan') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id_pesanan" value="{{ $pesanan->id_pesanan }}">

                        <div class="mb-3">
                            <label for="bukti_bayar" class="form-label fw-semibold">Upload Proof of Payment:</label>
                            <input type="file" name="bukti_bayar" id="bukti_bayar" accept="image/*" required class="form-control">
                            @error('bukti_bayar')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-danger px-4">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- pembayaran area end -->

@endsection
