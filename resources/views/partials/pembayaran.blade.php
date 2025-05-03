@extends('layouts.main')

@section('content')
<!-- pembayaran area start -->
<div class="categories_area pt-85 mb-150">
    <div class="container">
        <div class="col-xl-12">
            <div class="section-wrapper text-center mb-35">
                <h2 class="section-title">Pembayaran</h2>
                <p>Silakan scan QRIS dan upload bukti pembayaran untuk menyelesaikan transaksi.</p>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="product wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
                    <div class="bg-white rounded-lg shadow p-4">
                        <h3 class="text-lg font-semibold mb-3">
                            Total Pembayaran: 
                            <span class="text-red-600">Rp {{ number_format($pesanan->total, 0, ',', '.') }}</span>
                        </h3>

                        <div class="row">
                            <!-- Gambar QRIS -->
                            <div class="col-md-6 mb-4 mb-md-0">
                                <img src="{{ asset('assets/qris.jpg') }}" alt="QRIS" class="w-100 rounded">
                            </div>

                            <!-- Form Upload -->
                            <div class="col-md-6">
                                <ul class="text-sm mb-4 ps-3">
                                    <li>Metode pembayaran via QRIS (Gopay, OVO, DANA, ShopeePay, dll)</li>
                                    <li>Pastikan nominal sesuai total</li>
                                    <li>Upload bukti pembayaran setelah transfer</li>
                                </ul>

                                <form action="{{ route('pembayaran.store', $pesanan->id_pesanan) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id_pesanan" value="{{ $pesanan->id_pesanan }}">

                                    <div class="mb-3">
                                        <label class="form-label">Upload Bukti Pembayaran</label>
                                        <input type="file" name="bukti_bayar" accept="image/*" class="form-control" required>
                                    </div>

                                    <button type="submit" class="btn btn-danger w-100">
                                        Upload Bukti Pembayaran
                                    </button>
                                </form>
                            </div>
                        </div> <!-- end row -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- pembayaran area end -->

@endsection
