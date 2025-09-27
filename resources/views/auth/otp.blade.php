@extends('layouts.auth')

@section('title', __('main.login-with-otp'))

@section('content')
    <div class="w-full sm:w-2/3 md:w-full xl:w-2/3 text-slate-800">
        <form method="POST" action="{{ session('otp_identifier') ? route('otp.verify') : route('otp.request') }}" id="otpForm">
            @csrf

            {{-- Main form content wrapper --}}
            <div class="space-y-6">

                @if (session('otp_identifier'))

                    {{-- STATE 2: VERIFY OTP --}}
                    <!-- Header -->
                    <div class="text-center mb-8">
                        <h2 class="text-2xl font-light text-slate-900 mb-2 tracking-wide">@lang('main.verify-your-device')</h2>
                        <p class="text-slate-500 text-sm font-light">
                            @lang('main.otp-sent-to', ['identifier' => session('otp_identifier')])
                        </p>
                    </div>

                    <input type="hidden" name="identifier" value="{{ session('otp_identifier') }}">

                    <!-- Verification Code Field with Better Structure -->
                    <div class="space-y-4">
                        <div class="space-y-2">
                            <label for="otp_code" class="block text-sm font-medium text-slate-700 text-center">
                                @lang('main.verification-code') <span class="text-blue-500">*</span>
                            </label>
                            <div class="flex justify-center">
                                <div class="w-48"> <!-- Fixed width container for the input -->
                                    <input
                                        type="text"
                                        id="otp_code"
                                        name="otp_code"
                                        required
                                        autofocus
                                        inputmode="numeric"
                                        pattern="[0-9]{6}"
                                        maxlength="6"
                                        class="w-full px-4 py-3 text-2xl text-center tracking-[0.25em] border border-slate-200 rounded-lg focus:border-blue-600 focus:ring-1 focus:ring-blue-600 outline-none transition-all duration-300 bg-white placeholder:text-slate-400 placeholder:text-lg placeholder:tracking-normal"
                                        placeholder="123456"
                                        autocomplete="one-time-code"
                                    >
                                </div>
                            </div>
                            @error('otp_code')
                            <p class="text-sm text-red-500 text-center mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Verify Button -->
                        <div class="pt-2">
                            <button
                                type="submit"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-8 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2"
                            >
                                @lang('main.verify-code')
                            </button>
                        </div>
                    </div>

                    <!-- Resend Timer/Link with Better Spacing -->
                    <div class="text-center pt-6 border-t border-slate-100">
                        <div id="resend-timer" class="text-slate-500 text-sm font-light">
                            @lang('main.resend-code-in') <span id="timer-countdown" class="font-medium text-slate-700">120</span> @lang('main.seconds')
                        </div>
                        <div id="resend-form-container" class="hidden">
                            <form action="{{ route('otp.request') }}" method="POST" class="inline">
                                @csrf
                                <input type="hidden" name="identifier" value="{{ session('otp_identifier') }}">
                                <button type="submit" class="text-blue-600 hover:text-blue-700 hover:underline font-medium transition-colors duration-200">
                                    @lang('main.resend-code')
                                </button>
                            </form>
                        </div>
                    </div>

                @else

                    {{-- STATE 1: REQUEST OTP --}}
                    <!-- Header -->
                    <div class="text-center mb-8">
                        <h2 class="text-2xl font-light text-slate-900 mb-2 tracking-wide">@lang('main.login-with-otp')</h2>
                        <p class="text-slate-500 text-sm font-light">@lang('main.otp-request-intro')</p>
                    </div>

                    @if ($errors->any())
                        <div class="p-4 text-sm text-red-700 bg-red-50 border border-red-200 rounded-lg" role="alert">
                            <ul class="list-disc list-inside space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Identifier Field -->
                    <div class="space-y-2">
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
                            class="w-full px-4 py-3 text-base border border-slate-200 rounded-lg focus:border-blue-600 focus:ring-1 focus:ring-blue-600 outline-none transition-all duration-300 bg-white placeholder:text-slate-400"
                            placeholder="{{__('main.enter-email-or-mobile')}}"
                            autocomplete="username"
                        >
                    </div>

                    <!-- Request Button -->
                    <div class="pt-2">
                        <button
                            type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-8 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2"
                        >
                            @lang('main.request-code')
                        </button>
                    </div>

                @endif
            </div>
        </form>

        <!-- Back to Login Link - Now outside the form -->
        <div class="text-center mt-12 pt-8 border-t border-slate-200">
            <p class="text-sm text-slate-500 font-light">
                @lang('main.remembered-password')
                <a href="{{ route('login') }}" class="text-slate-900 font-medium hover:text-blue-600 hover:underline ml-1 transition-colors duration-200">
                    @lang('main.back-to-login')
                </a>
            </p>
        </div>
    </div>
@endsection

@push('scripts')
    @if (session('otp_identifier'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const countdownElement = document.getElementById('timer-countdown');
                const timerContainer = document.getElementById('resend-timer');
                const resendContainer = document.getElementById('resend-form-container');

                if (!countdownElement || !timerContainer || !resendContainer) {
                    return;
                }

                let timeLeft = 120; // 2 minutes in seconds

                const timer = setInterval(() => {
                    timeLeft--;
                    countdownElement.textContent = timeLeft;

                    if (timeLeft <= 0) {
                        clearInterval(timer);
                        timerContainer.classList.add('hidden');
                        resendContainer.classList.remove('hidden');
                    }
                }, 1000);

                // Auto-submit when 6 digits are entered
                const otpInput = document.getElementById('otp_code');
                if (otpInput) {
                    otpInput.addEventListener('input', function(e) {
                        // Remove any non-numeric characters
                        this.value = this.value.replace(/[^0-9]/g, '');

                        // Auto-submit when 6 digits are entered
                        if (this.value.length === 6) {
                            // Small delay to show the complete code before submitting
                            setTimeout(() => {
                                document.getElementById('otpForm').submit();
                            }, 300);
                        }
                    });

                    // Handle paste events
                    otpInput.addEventListener('paste', function(e) {
                        e.preventDefault();
                        const paste = (e.clipboardData || window.clipboardData).getData('text');
                        const numericPaste = paste.replace(/[^0-9]/g, '').slice(0, 6);
                        this.value = numericPaste;

                        if (numericPaste.length === 6) {
                            setTimeout(() => {
                                document.getElementById('otpForm').submit();
                            }, 300);
                        }
                    });
                }
            });
        </script>
    @endif
@endpush
