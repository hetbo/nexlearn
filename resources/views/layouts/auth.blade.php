@extends('layouts.master')

@section('body')

    <div class="min-h-screen flex">
        <!-- Content Side -->
        <div class="w-full md:w-1/2 overflow-y-auto">
            <div class="p-8 flex items-center justify-center dark:bg-neutral-800 dark:text-white min-h-screen">
                @yield('content')
            </div>
        </div>

        <!-- Decorative blue Side -->
        <div class="hidden md:block md:w-1/2 bg-gradient-to-br from-blue-500 via-blue-600 to-violet-700 fixed left-0 top-0 bottom-0">
            <!-- Geometric Pattern -->
            <div class="absolute inset-0 opacity-20">
                <div class="absolute top-10 left-10 w-32 h-32 bg-white rounded-full"></div>
                <div class="absolute top-40 right-20 w-24 h-24 bg-white rounded-lg rotate-45"></div>
                <div class="absolute bottom-32 left-16 w-20 h-20 bg-white rounded-full"></div>
                <div class="absolute bottom-20 right-10 w-16 h-16 bg-white rounded-lg rotate-12"></div>
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-40 h-40 bg-white rounded-full opacity-50"></div>
            </div>

            <!-- Main Content -->
            <div class="relative z-10 h-full flex flex-col justify-center items-center text-white p-12">
                <div class="text-center">
                    <div class="w-24 h-24 bg-white bg-opacity-20 rounded-full flex items-center justify-center mb-8 mx-auto">
                        <div class="w-12 h-12 bg-white bg-opacity-40 rounded-full flex items-center justify-center">
                            <div class="w-6 h-6 bg-white rounded-full"></div>
                        </div>
                    </div>

                    <h2 class="text-3xl font-light mb-4">@lang('main.auth-heading')</h2>
                    <p class="text-blue-100 text-lg leading-relaxed max-w-sm">
                        @lang('main.auth-subheading')
                    </p>
                </div>

                <!-- Bottom Accent -->
                <div class="absolute bottom-12 left-12 right-12">
                    <div class="flex justify-between items-center text-blue-200">
                        <div class="flex space-x-2">
                            <div class="w-2 h-2 bg-white rounded-full"></div>
                            <div class="w-2 h-2 bg-white bg-opacity-60 rounded-full"></div>
                            <div class="w-2 h-2 bg-white bg-opacity-30 rounded-full"></div>
                        </div>
                        <div class="text-sm font-light">@lang('main.auth-bottom')</div>
                    </div>
                </div>
            </div>

            <!-- Subtle Border Effect -->
            <div class="absolute left-0 top-0 bottom-0 w-1 bg-gradient-to-b from-transparent via-white to-transparent opacity-20"></div>
        </div>
    </div>
@endsection
