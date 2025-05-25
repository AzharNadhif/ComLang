@extends('layouts.main')

@section('content')
<div class="categories_area pt-85 pb-150">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="section-wrapper text-center mb-50">
                    <h2 class="section-title">Payment</h2>
                    <p>Complete your payment to proceed with the order</p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="payment-card bg-white rounded shadow-sm p-4">
                    <div class="order-summary mb-4">
                        <h4 class="mb-3">Order Summary</h4>
                        <div class="row">
                            <div class="col-sm-6">
                                <strong>Order ID:</strong> #{{ $pesanan->id_pesanan }}
                            </div>
                            <div class="col-sm-6">
                                <strong>Total Amount:</strong> <span class="text-danger">Rp {{ number_format($pesanan->total, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-6">
                                <strong>Recipient:</strong> {{ $pesanan->nama_penerima }}
                            </div>
                            <div class="col-sm-6">
                                <strong>Phone:</strong> {{ $pesanan->whatsapp }}
                            </div>
                        </div>
                    </div>

                    <div class="payment-section text-center">
                        <button id="pay-button" class="btn btn-danger btn-lg px-5">
                            <i class="fas fa-credit-card me-2"></i>
                            Pay Now - Rp {{ number_format($pesanan->total, 0, ',', '.') }}
                        </button>
                        
                        <div class="mt-3">
                            <small class="text-muted">Powered by Midtrans - Secure Payment Gateway</small>
                        </div>
                        
                        <div class="mt-3">
                            <a href="{{ route('user.orders') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>
                                Back to Orders
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Loading Modal -->
<div class="modal fade" id="loadingModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center py-4">
                <div class="spinner-border text-danger mb-3" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <h5>Processing Payment...</h5>
                <p class="text-muted">Please wait while we process your payment.</p>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<!-- Midtrans Snap JS -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>

<script>
document.getElementById('pay-button').addEventListener('click', function () {
    // Show loading modal
    var loadingModal = new bootstrap.Modal(document.getElementById('loadingModal'));
    loadingModal.show();
    
    // Trigger snap popup
    snap.pay('{{ $snapToken }}', {
        // Optional
        onSuccess: function(result) {
            loadingModal.hide();
            
            // Show success message
            Swal.fire({
                icon: 'success',
                title: 'Payment Successful!',
                text: 'Your payment has been processed successfully.',
                confirmButtonColor: '#dc3545',
                confirmButtonText: 'View Order'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '{{ route("user.orders") }}';
                }
            });
        },
        // Optional
        onPending: function(result) {
            loadingModal.hide();
            
            Swal.fire({
                icon: 'info',
                title: 'Payment Pending',
                text: 'Your payment is being processed. Please check your order status.',
                confirmButtonColor: '#dc3545',
                confirmButtonText: 'Check Order Status'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '{{ route("user.orders") }}';
                }
            });
        },
        // Optional
        onError: function(result) {
            loadingModal.hide();
            
            Swal.fire({
                icon: 'error',
                title: 'Payment Failed',
                text: 'There was an error processing your payment. Please try again.',
                confirmButtonColor: '#dc3545',
                confirmButtonText: 'Try Again'
            });
        },
        onClose: function() {
            loadingModal.hide();
            
            Swal.fire({
                icon: 'warning',
                title: 'Payment Cancelled',
                text: 'You closed the payment popup. Your order is still pending.',
                confirmButtonColor: '#dc3545',
                confirmButtonText: 'Continue Shopping'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '{{ route("home") }}';
                }
            });
        }
    });
});
</script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush