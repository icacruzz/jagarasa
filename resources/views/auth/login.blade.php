@extends('layouts.app')

@section('title', 'Login Administrator - JAGARASA Lampung')

@section('content')
<div class="min-h-[75vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white p-8 sm:p-10 rounded-3xl border border-amber-200/80 shadow-xl relative overflow-hidden">
        <!-- Glow Ornament -->
        <div class="absolute -top-12 -right-12 w-32 h-32 bg-amber-400/20 rounded-full blur-2xl pointer-events-none"></div>

        <!-- Header & Logo -->
        <div class="text-center">
            <a href="{{ route('home') }}" class="inline-block">
                <img src="{{ asset('images/logo-jagarasa.png') }}" 
                     alt="Logo Jagarasa" 
                     class="h-20 w-20 mx-auto rounded-full object-cover ring-4 ring-amber-400/80 shadow-md hover:scale-105 transition"
                     onerror="this.src='{{ asset('logo.jpg') }}'">
            </a>
            <h2 class="mt-4 text-2xl font-black text-amber-950 font-heading">
                Login Panel Admin
            </h2>
            <p class="mt-1 text-xs text-amber-800/80">
                Masuk untuk mengelola katalog produk & laporan penjualan Jagarasa
            </p>
        </div>

        <!-- Alert Error -->
        @if ($errors->any())
            <div class="bg-rose-50 border-l-4 border-rose-500 p-3.5 rounded-r-xl text-rose-800 text-xs">
                <div class="flex items-center gap-2 font-bold mb-1">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <span>Akses Ditolak</span>
                </div>
                <ul class="list-disc list-inside space-y-0.5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Login Form -->
        <form class="mt-6 space-y-5" action="{{ route('login.post') }}" method="POST">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="block text-xs font-bold uppercase tracking-wider text-amber-950 mb-1.5">
                    Email Administrator
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-amber-700/60 text-sm">
                        <i class="fa-solid fa-envelope"></i>
                    </span>
                    <input id="email" 
                           name="email" 
                           type="email" 
                           autocomplete="email" 
                           required 
                           value="{{ old('email', 'admin@jagarasa.com') }}"
                           class="w-full pl-10 pr-4 py-3 rounded-xl border border-amber-200 focus:outline-hidden focus:ring-2 focus:ring-amber-500 focus:border-amber-500 text-sm bg-amber-50/20" 
                           placeholder="admin@jagarasa.com">
                </div>
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-xs font-bold uppercase tracking-wider text-amber-950 mb-1.5">
                    Kata Sandi
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-amber-700/60 text-sm">
                        <i class="fa-solid fa-lock"></i>
                    </span>
                    <input id="password" 
                           name="password" 
                           type="password" 
                           autocomplete="current-password" 
                           required 
                           value="admin123"
                           class="w-full pl-10 pr-4 py-3 rounded-xl border border-amber-200 focus:outline-hidden focus:ring-2 focus:ring-amber-500 focus:border-amber-500 text-sm bg-amber-50/20" 
                           placeholder="••••••••">
                </div>
            </div>

            <!-- Remember & Hint -->
            <div class="flex items-center justify-between text-xs">
                <div class="flex items-center">
                    <input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-amber-600 focus:ring-amber-500 border-amber-300 rounded">
                    <label for="remember" class="ml-2 block text-amber-900">
                        Ingat sesi saya
                    </label>
                </div>
                <span class="text-amber-800/70">Akun: <b>admin@jagarasa.com</b></span>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" 
                        class="w-full flex justify-center items-center gap-2 py-3.5 px-4 rounded-xl text-sm font-bold text-white bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 shadow-md hover:shadow-lg transition transform hover:-translate-y-0.5">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    <span>Masuk ke Panel Admin</span>
                </button>
            </div>
        </form>

        <!-- Back to Website -->
        <div class="text-center pt-2 border-t border-amber-100">
            <a href="{{ route('home') }}" class="text-xs font-semibold text-amber-700 hover:text-amber-900 flex items-center justify-center gap-1.5">
                <i class="fa-solid fa-arrow-left text-[10px]"></i>
                <span>Kembali ke Beranda Katalog</span>
            </a>
        </div>
    </div>
</div>
@endsection
