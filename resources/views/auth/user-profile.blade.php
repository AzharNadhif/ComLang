@extends('layouts.app') <!-- sesuaikan dengan layout-mu -->

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Profil Saya</h1>

    <div class="card mb-4">
        <div class="card-body">
            <h5>Nama: {{ $user->nama }}</h5>
            <h5>Email: {{ $user->email }}</h5>
            <h5>No. Telepon: {{ $user->notelp }}</h5>
        </div>
    </div>

    <div class="d-flex flex-column gap-3">
        <a href="{{ route('user.edit.form') }}" class="btn btn-primary">Edit Profile</a>
        <a href="{{ route('user.orders') }}" class="btn btn-secondary">Riwayat Pemesanan</a>

        <form method="POST" action="{{ route('user.logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>
</div>
@endsection
