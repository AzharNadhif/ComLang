@extends('layouts.main')

@section('content')
<div class="categories_area pt-85 pb-150">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="section-wrapper text-center mb-50">
                    <h2 class="section-title">Order Details</h2>
                    <p>Fill in your shipping information correctly</p>
                </div>
            </div>
        </div>

        <div class="row g-5 align-items-stretch justify-content-center">
            <!-- Form Checkout -->
            <div class="col-lg-6 d-flex">
                <div class="checkout-form bg-white rounded shadow-sm p-4 w-100 d-flex flex-column">
                    <h4 class="mb-4">Shipping Information</h4>

                    <form action="{{ route('checkout.cart.upload') }}" method="POST" enctype="multipart/form-data" class="mt-auto">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Your Name</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Whatsapp Number</label>
                            <input type="text" name="whatsapp" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Zip Code</label>
                            <input type="text" name="kode_pos" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <textarea name="alamat" rows="3" class="form-control" required></textarea>
                        </div>

                        <div class="d-flex gap-3 pt-3">
                            <button type="submit" class="btn btn-danger">Continue</button>
                            <a href="{{ route('home') }}" class="btn btn-outline-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection