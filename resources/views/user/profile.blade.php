@extends('layouts.main') <!-- Extend from your main layout -->

@section('content')
<div class="container">
    <h2 class="text-center mb-5 font-bold text-3xl">My Profile</h2>

    <!-- Card for User Profile -->
     <div class="min-h-screen flex items-center justify-center bg-gray-100" style="min-height: 100vh; display: flex; align-items: center; justify-content: center;">
    <div class="bg-white p-8 rounded-lg shadow-md max-w-md mx-auto text-center" style="margin-top: -200px; background-color: #fff; padding: 80px; border-radius: 12px; box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);">
        <!-- Profile Picture and Name -->
        <div class="flex justify-center mb-4">
            <img src="{{ asset('images/ava.png') }}" alt="Profil" class="w-24 h-24 rounded-full border-4 border-gray-300" style="width: 6rem; height: 6rem; border-radius: 9999px; border-width: 4px; border-color: #e5e7eb;">
        </div>
        <h3 class="text-xl font-semibold text-gray-800 mb-2" style="font-size: 1.25rem; font-weight: 600; color: #1f2937; margin-bottom: 0.5rem;">{{ $user->nama }}</h3>
        <p class="text-gray-600 text-sm mb-6" style="font-size: 0.875rem; color: #4b5563; margin-bottom: 1.5rem;">{{ $user->email }}</p>

        <!-- Profile Links -->
        <div class="space-y-4">
                        <div class="w-full space-y-2">
                <a href="{{ route('user.profile.edit') }}"
                    class="flex items-center justify-between px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg">
                    <span class="flex items-center gap-2">
                        <i class="fa-solid fa-user text-blue-500"></i> Profile
                    </span>
                    <i class="fa-solid fa-pen-to-square text-gray-400"></i>
                </a>

                <a href="{{ route('user.orders') }}"
                    class="flex items-center justify-between px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg">
                    <span class="flex items-center gap-2">
                        <i class="fa-solid fa-clock-rotate-left text-blue-500"></i> Order History
                    </span>
                    <i class="fa-solid fa-chevron-right text-gray-400"></i>
                </a>
            </div>
            <br>
            <br>

            <form method="POST" action="{{ route('user.logout') }}">
                @csrf
                <button type="submit" class="w-full py-2 rounded-md text-white bg-red-500 hover:bg-red-600" style="width: auto; padding: 0.5rem; border-radius: 6px; color: white; background-color: #e81c24; transition: background-color 0.2s ease-in-out;">
                    Log Out
                </button>
            </form>
        </div>
    </div>
</div>
</div>
@endsection
