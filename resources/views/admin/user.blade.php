@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Manajemen User</h1>

        <!-- Daftar Kategori -->
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama User</th>
                    <th>Nomor Telepon</th>
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