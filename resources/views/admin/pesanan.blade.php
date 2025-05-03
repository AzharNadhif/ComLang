@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="fw-bold fs-3">Manajemen Pesanan</h1>
        <br>
        <!-- Daftar Pesanan -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Order ID</th>
                        <th>User ID</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Amount Paid</th>
                        <th>Payment Screenshot</th>
                        <th>Order Date</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pesanan as $order)
                        <tr>
                            <td>{{ $order->id_pesanan }}</td>
                            <td>{{ $order->id_user }}</td>
                            <td>
                                <span class="badge 
                                    @if($order->id_status == 1) bg-danger
                                    @elseif($order->id_status == 2) bg-warning
                                    @elseif($order->id_status == 3) bg-success
                                    @endif">
                                    {{ $order->status->nama_status }}
                                </span>
                            </td>
                            <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                            <td>
                                @if($order->pembayaran)
                                    Rp {{ number_format($order->pembayaran->jumlah_bayar, 0, ',', '.') }}
                                @else
                                    <span class="text-danger">Belum dibayar</span>
                                @endif
                            </td>
                            <td>
@if($order->pembayaran && $order->pembayaran->bukti_bayar)
    <div class="d-flex gap-1">
        {{-- Tombol Lihat --}}
        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#buktiModal{{ $order->id_pesanan }}">
            <i class="bi bi-image"></i> Lihat Bukti
        </button>

        {{-- Tombol Download --}}
        <a href="{{ asset($order->pembayaran->bukti_bayar) }}" download class="btn btn-success btn-sm">
            <i class="bi bi-download"></i> Download
        </a>
    </div>

    {{-- Modal untuk lihat bukti --}}
    <div class="modal fade" id="buktiModal{{ $order->id_pesanan }}" tabindex="-1" aria-labelledby="buktiModalLabel{{ $order->id_pesanan }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img src="{{ asset($order->pembayaran->bukti_bayar) }}" class="img-fluid rounded" alt="Bukti Pembayaran">
                </div>
            </div>
        </div>
    </div>
@else
    <span class="text-danger">Tidak ada</span>
@endif


                            </td>
                            <td>{{ date('d-m-Y', strtotime($order->tanggal_pesanan)) }}</td>
                            <td>{{ $order->alamat }}</td>
                            <td>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editPesananModal{{ $order->id_pesanan }}">
                                    <i class="bi bi-pencil-square"></i> Update Status
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal untuk melihat bukti pembayaran -->
    @foreach ($pesanan as $order)
        @if($order->pembayaran && $order->pembayaran->bukti_bayar)
            <div class="modal fade" id="buktiModal{{ $order->id_pesanan }}" tabindex="-1" aria-labelledby="buktiModalLabel{{ $order->id_pesanan }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="buktiModalLabel{{ $order->id_pesanan }}">Payment Proof Screenshot #{{ $order->id_pesanan }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <img src="{{ asset('images/bukti_bayar/' . $order->pembayaran->bukti_bayar) }}" class="img-fluid" alt="Bukti Pembayaran">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach

    <!-- Modal Edit Status Pesanan -->
    @foreach ($pesanan as $order)
        <div class="modal fade" id="editPesananModal{{ $order->id_pesanan }}" tabindex="-1" aria-labelledby="editPesananModalLabel{{ $order->id_pesanan }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editPesananModalLabel">Update Status Pesanan #{{ $order->id_pesanan }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.pesanan.update', $order->id_pesanan) }}" method="POST" id="edit-form-{{ $order->id_pesanan }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="id_status">Order Status</label>
                                <select name="id_status" id="id_status" class="form-select" required>
                                    @foreach($status as $stat)
                                        <option value="{{ $stat->id_status }}" {{ $order->id_status == $stat->id_status ? 'selected' : '' }}>
                                            {{ $stat->nama_status }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Update Status</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- SweetAlert2 Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Alert untuk success message
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    timer: 3000,
                    timerProgressBar: true
                });
            @endif

            // Alert untuk error message
            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '{{ session('error') }}',
                    timer: 3000,
                    timerProgressBar: true
                });
            @endif

            // Alert untuk validation errors
            @if($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Validasi Error',
                    html: `@foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach`,
                });
            @endif
        });
        
        // Form edit confirmation - for all edit forms
        document.querySelectorAll('[id^="editPesananModal"] form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const form = this;
                
                Swal.fire({
                    title: 'Konfirmasi Update',
                    text: 'Apakah Anda yakin ingin memperbarui status pesanan ini?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Perbarui Status',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection