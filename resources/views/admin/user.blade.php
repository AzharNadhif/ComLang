@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="fw-bold fs-3">User Management</h1>
        <br>
        <!-- Daftar Kategori -->
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Password</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user as $us)
                    <tr>
                        <td>{{ $us->id_user }}</td>
                        <td>{{ $us->nama }}</td>
                        <td>{{ $us->notelp }}</td>
                        <td>{{ $us->email }}</td>
                        <td>{{ $us->password }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    

@endsection