@extends('layouts.auth')

@section('title', __('main.login'))

@section('content')
    <form method="POST" action="{{ route('login') }}" class="space-y-6 w-full sm:w-2/3 md:w-full xl:w-2/3 text-slate-800" id="loginForm">
        @csrf

        <!-- Header -->
        <div class="text-center mb-8">
            <h2 class="text-2xl font-light text-slate-900 mb-2 tracking-wide">@lang('main.welcome-back')</h2>
            <p class="text-slate-500 text-sm font-light">@lang('main.login-to-account')</p>
        </div>

        <!-- Identifier Field (Email or Mobile) -->
        <div class="space-y-1">
            <label for="identifier" class="block text-sm font-medium text-slate-700">
                @lang('main.email-or-mobile') <span class="text-blue-500">*</span>
            </label>
            <input
                type="text"
                id="identifier"
                name="identifier"
                value="{{ old('identifier') }}"
                required
                autofocus
                class="w-full px-0 py-2 text-base border-0 border-b border-slate-200 focus:border-blue-600 outline-none transition-colors duration-300 bg-transparent placeholder:text-slate-400 placeholder:text-sm"
                placeholder="{{__('main.enter-email-or-mobile')}}"
            >
            @error('identifier')
            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password Field -->
        <div class="space-y-1">
            <label for="password" class="block text-sm font-medium text-slate-700">
                @lang('main.password') <span class="text-blue-500">*</span>
            </label>
            <input
                type="password"
                id="password"
                name="password"
                required
                class="w-full px-0 py-2 text-base border-0 border-b border-slate-200 focus:border-blue-600 outline-none transition-colors duration-300 bg-transparent placeholder:text-slate-400 placeholder:text-sm"
                placeholder="••••••••"
            >
            @error('password')
            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between pt-2">
            <div class="flex items-center space-x-2">
                <input
                    type="checkbox"
                    id="remember"
                    name="remember"
                    class="h-4 w-4 text-blue-600 border-slate-300 rounded-none focus:ring-0 focus:ring-offset-0"
                >
                <label for="remember" class="text-sm text-slate-600">
                    @lang('main.remember-me')
                </label>
            </div>
            <a href="{{ '#' }}" class="text-sm text-blue-600 hover:underline">
                @lang('main.forgot-password')
            </a>
        </div>

        <button
            type="submit"
            id="submitButton"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-8 transition-colors duration-200 focus:outline-none focus:ring-1 focus:ring-blue-600 focus:ring-offset-2"
        >
            @lang('main.sign-in')
        </button>

        <!-- OTP Login Link -->
        <div class="pt-2">
            <a
                href="{{ route('otp.login') }}"
                class="w-full flex text-sm items-center justify-center text-blue-600 hover:bg-blue-50 py-3 px-8 transition-colors duration-200 focus:outline-none focus:ring-1 focus:ring-blue-600 focus:ring-offset-2"
            >
                @lang('main.login-with-otp')
            </a>
        </div>


        <!-- Divider -->
        <div class="relative my-8">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-slate-200"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-6 bg-white text-slate-500 font-light">@lang('main.continue-with')</span>
            </div>
        </div>

        <!-- OAuth Providers -->
        <div class="grid grid-cols-2 gap-4">
            <!-- Google OAuth -->
            <a
                href="{{ '#' }}"
                class="flex items-center justify-center px-4 py-3 text-sm border border-slate-200 hover:border-slate-300 hover:bg-slate-50 transition-all duration-200 focus:outline-none focus:ring-1 focus:ring-blue-600 focus:ring-offset-2"
            >
                <svg class="w-5 h-5 ml-3" viewBox="0 0 24 24">
                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                </svg>
                <span class="text-slate-700 font-medium">@lang('main.google-continue')</span>
            </a>

            <!-- GitHub OAuth -->
            <a
                href="{{ '#' }}"
                class="flex items-center justify-center px-4 py-3 text-sm border border-slate-200 hover:border-slate-300 hover:bg-slate-50 transition-all duration-200 focus:outline-none focus:ring-1 focus:ring-blue-600 focus:ring-offset-2"
            >
                <svg class="w-5 h-5 ml-3" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 0C5.374 0 0 5.373 0 12 0 17.302 3.438 21.8 8.207 23.387c.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0112 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.30.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z"/>
                </svg>
                <span class="text-slate-700 font-medium">@lang('main.github-continue')</span>
            </a>
        </div>

        <!-- Sign Up Link -->
        <div class="text-center mt-12 pt-8 border-t border-neutral-200">
            <p class="text-sm text-neutral-500 font-light">
                @lang('main.no-account')
                <a href="{{ route('register') }}" class="text-neutral-900 font-medium hover:underline ml-1">
                    @lang('main.create-account-link')
                </a>
            </p>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        const loginForm = document.getElementById('loginForm');
        const submitButton = document.getElementById('submitButton');

        loginForm.addEventListener('submit', function() {
            submitButton.disabled = true;
            submitButton.textContent = 'در حال ورود...'; // Or your preferred language key
            submitButton.classList.add('opacity-50', 'cursor-not-allowed');
        });
    </script>
@endpush
