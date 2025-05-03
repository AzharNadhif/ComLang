@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Edit Profile</h1>

    <form action="{{ route('user.profile.update') }}" style="margin-bottom: 50px;" method="POST">
        @csrf
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="nama" class="form-control" value="{{ $user->nama }}" required>
        </div>

        <div class="form-group">
            <label>Phone Number</label>
            <input type="text" name="notelp" class="form-control" value="{{ $user->notelp }}" required>
        </div>

        <div class="form-group" >
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
        </div>
        <div class="form-group">
            <label>New Password <span class="text-sm text-gray-500">(leave blank if you don't want to change)</span></label>
            <input type="text" name="password" class="form-control">
        </div>
        <div style="padding-top: 20px;">
            <button type="submit" class="btn btn-danger">Update</button>
            <a href="{{ route('user.profile') }}" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>
@endsection
