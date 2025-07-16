<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>JoasBook - Booking System</title>
    @if(app()->environment('production'))
        <script src="https://cdn.tailwindcss.com"></script>
    @else
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="bg-gray-50 min-h-screen flex flex-col items-center justify-center">
    <div class="flex flex-col items-center justify-center w-full max-w-md mx-auto p-8 bg-white rounded-lg shadow mt-12">
        <span style="font-size:3rem;">📅</span>
        <h1 class="text-2xl font-bold mt-4 mb-2">Welcome to JoasBook</h1>
        <p class="text-gray-600 mb-6 text-center">Your simple booking system. Please log in or register to get started.</p>
        <div class="flex gap-4 mb-4">
            <a href="{{ route('login') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Login</a>
            <a href="{{ route('register') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition">Register</a>
        </div>
    </div>
</body>
</html>
