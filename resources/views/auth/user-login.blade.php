@extends('layouts.tampilan')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Login User</h1>
            <p class="text-sm text-gray-500">Please login to continue</p>
        </div>

        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-2 rounded mb-4 text-sm">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-2 rounded mb-4 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('user.login') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" placeholder="Masukkan email"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-400" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" placeholder="Masukkan password"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-400" required>
            </div>

            <button type="submit"
                class="w-full bg-red-500 hover:bg-red-600 text-white py-2 rounded-lg font-semibold transition duration-300">
                Masuk
            </button>
        </form>

        <div class="text-center text-sm text-gray-500 mt-4">
            Don't have an account yet? <a href="{{ route('user.register.form') }}" class="text-red-500 font-medium hover:text-black hover:underline"
>Register here</a>
        </div>
    </div>
</div>
@endsection
