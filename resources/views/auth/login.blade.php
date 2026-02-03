@extends('frontend.layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl w-full">
        <div class="bg-white">
            <div class="flex flex-col lg:flex-row">

                {{-- Left Side - Login Form --}}
                <div class="p-8 sm:p-12 lg:p-16 rounded-3xl border border-gray-200 shadow-lg overflow-hidden">
                    <div class="max-w-md mx-auto">
                        <h2 class="text-center text-4xl font-bold text-blue-900 mb-8">Log In</h2>

                        {{-- Session Status --}}
                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        <form method="POST" action="{{ route('login') }}" class="space-y-6">
                            @csrf

                            {{-- Email Address --}}
                            <div>
                                <input
                                    id="email"
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                    autofocus
                                    autocomplete="username"
                                    class="w-full py-3 border-b border-gray-300 outline-0"
                                    placeholder="Enter your email"
                                >
                                @error('email')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Password --}}
                            <div>
                                <input
                                    id="password"
                                    type="password"
                                    name="password"
                                    required
                                    autocomplete="current-password"
                                    class="w-full py-3 border-b border-gray-300 outline-0"
                                    placeholder="Enter your password"
                                >
                                @error('password')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Remember Me --}}
                            <div class="flex items-center">
                                <input
                                    id="remember_me"
                                    type="checkbox"
                                    name="remember"
                                    class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-gray-300 rounded"
                                >
                                <label for="remember_me" class="ml-2 block text-sm text-gray-700">
                                    Remember Me
                                </label>
                            </div>

                            {{-- Login Button --}}
                            <div class="flex justify-center items-center">
                                <button
                                    type="submit"
                                    class="bg-blue-900 text-white py-3 px-12 rounded-lg font-semibold hover:bg-blue-800 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                                >
                                    Login
                                </button>
                            </div>

                            {{-- Sign Up Link --}}
                            <div class="text-center mb-10">
                                <p class="text-sm text-gray-600">
                                    Don't have account?
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="text-orange-600 hover:text-orange-700 font-medium">
                                            Sign up
                                        </a>
                                    @else
                                        <span class="text-orange-600 font-medium">Sign up</span>
                                    @endif
                                </p>
                            </div>

                            {{-- Divider --}}
                            <div class="relative my-6">
                                <div class="absolute inset-0 flex items-center">
                                    <div class="w-full border-t border-gray-300"></div>
                                </div>
                                <div class="relative flex justify-center text-sm">
                                    <span class="px-2 bg-white text-gray-500">Or</span>
                                </div>
                            </div>

                            {{-- Social Login Buttons --}}
                            <div class="space-y-3">
                                {{-- Google --}}
                                <button
                                    type="button"
                                    class="w-full flex items-center justify-center gap-3 px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200"
                                >
                                    <svg class="w-5 h-5" viewBox="0 0 24 24">
                                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                                    </svg>
                                    <span class="text-sm font-medium text-gray-700">Login with Google</span>
                                </button>

                                {{-- Facebook --}}
                                <button
                                    type="button"
                                    class="w-full flex items-center justify-center gap-3 px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200"
                                >
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                    </svg>
                                    <span class="text-sm font-medium">Login with Facebook</span>
                                </button>

                                {{-- Apple --}}
                                <button
                                    type="button"
                                    class="w-full flex items-center justify-center gap-3 px-6 py-3 bg-black text-white rounded-lg hover:bg-gray-900 transition-colors duration-200"
                                >
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17.05 20.28c-.98.95-2.05.8-3.08.35-1.09-.46-2.09-.48-3.24 0-1.44.62-2.2.44-3.06-.35C2.79 15.25 3.51 7.59 9.05 7.31c1.35.07 2.29.74 3.08.8 1.18-.24 2.31-.93 3.57-.84 1.51.12 2.65.72 3.4 1.8-3.12 1.87-2.38 5.98.48 7.13-.57 1.5-1.31 2.99-2.54 4.09l.01-.01zM12.03 7.25c-.15-2.23 1.66-4.07 3.74-4.25.29 2.58-2.34 4.5-3.74 4.25z"/>
                                    </svg>
                                    <span class="text-sm font-medium">Login with Apple</span>
                                </button>
                            </div>

                            {{-- Terms Text --}}
                            <p class="text-xs text-center text-gray-500 mt-8 px-20">
                                By continuing, you agree to the
                                <a href="#" class="text-orange-600 hover:text-orange-700">Terms of Service</a> and
                                <a href="#" class="text-orange-600 hover:text-orange-700">Privacy Policy</a>
                            </p>
                        </form>
                    </div>
                </div>

                {{-- Right Side - Illustration --}}
                <div class="hidden lg:flex items-center justify-center p-12">
                    <div class="max-w-lg">
                        <img
                            src="{{ asset('images/sections/login-image.svg') }}"
                            alt="Login illustration"
                            class="w-full h-auto"
                        >
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
