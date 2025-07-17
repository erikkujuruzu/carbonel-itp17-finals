<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booking System</title>
    @if(app()->environment('production'))
        <script src="https://cdn.tailwindcss.com"></script>
    @else
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="bg-gray-900 text-gray-100 min-h-screen flex flex-col items-center justify-center">
    <div class="flex flex-col items-center justify-center w-full max-w-md mx-auto p-8 bg-gray-800 rounded-lg shadow mt-12">
        <h1 class="text-2xl font-bold mt-4 mb-2">Welcome to your Booking</h1>
        <p class="text-gray-400 mb-6 text-center">Please log in or register to get started.</p>
        <div class="flex gap-4 mb-4">
            <a href="{{ route('login') }}" 
               class="px-5 py-2.5 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-500 transition duration-200 shadow">
                Login
            </a>
            <a href="{{ route('register') }}" 
               class="px-5 py-2.5 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-500 transition duration-200 shadow">
                Register
            </a>
        </div>
    </div>
</body>
</html>
