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
                /* Fix large icons and logos */
                svg { max-width: 100%; height: auto; }
                .h-9 { height: 2.25rem !important; }
                .w-auto { width: auto !important; }
                /* Ensure proper sizing for all SVG elements */
                svg[viewBox] { max-width: 100%; height: auto; }
                /* Fix navigation icons */
                .h-4 { height: 1rem !important; }
                .w-4 { width: 1rem !important; }
                .h-6 { height: 1.5rem !important; }
                .w-6 { width: 1.5rem !important; }
            </style>
        @else
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            <!-- Top Navigation -->
            @include('layouts.navigation')

            <!-- Main Layout with Sidebar -->
            <div class="flex h-[calc(100vh-4rem)]"> <!-- 4rem = approx nav height -->
                <!-- Sidebar - Always visible -->
                <aside class="w-72 bg-white border-r border-gray-200 flex flex-col">
                    @include('components.sidebar')
                </aside>

                <!-- Main Content Area -->
                <div class="flex-1 flex flex-col overflow-hidden">
                    <!-- Page Heading -->
                    @isset($header)
                        <header class="bg-white shadow-sm border-b border-gray-200">
                            <div class="px-6 py-4">
                                {{ $header }}
                            </div>
                        </header>
                    @endisset

                    <!-- Page Content -->
                    <main class="flex-1 overflow-y-auto bg-gray-50">
                        {{ $slot }}
                    </main>
                </div>
            </div>
        </div>
    </body>
</html>
