<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @if(app()->environment('production'))
            <script src="https://cdn.tailwindcss.com"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
            <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
            <style>
                svg { max-width: 100%; height: auto; }
                .h-9 { height: 2.25rem !important; }
                .w-auto { width: auto !important; }
                svg[viewBox] { max-width: 100%; height: auto; }
                .h-4 { height: 1rem !important; }
                .w-4 { width: 1rem !important; }
                .h-6 { height: 1.5rem !important; }
                .w-6 { width: 1.5rem !important; }
            </style>
        @else
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="font-sans antialiased bg-gray-900 text-gray-100">
        <div class="min-h-screen bg-gray-900">
            <!-- Top Navigation -->
            @include('layouts.navigation')

            <!-- Main Layout with Sidebar -->
            <div class="flex h-[calc(100vh-4rem)]">
                <!-- Sidebar -->
                <aside class="w-72 bg-gray-800 border-r border-gray-700 text-gray-100 flex flex-col">
                    @include('components.sidebar')
                </aside>

                <!-- Main Content Area -->
                <div class="flex-1 flex flex-col overflow-hidden">
                    <!-- Page Heading -->
                    @isset($header)
                        <header class="bg-gray-800 shadow-sm border-b border-gray-700">
                            <div class="px-6 py-4 text-gray-100">
                                {{ $header }}
                            </div>
                        </header>
                    @endisset

                    <!-- Page Content -->
                    <main class="flex-1 overflow-y-auto bg-gray-900 text-gray-100">
                        {{ $slot }}
                    </main>
                </div>
            </div>
        </div>
    </body>
</html>
