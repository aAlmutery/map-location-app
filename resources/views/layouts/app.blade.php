<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50">
    <nav class="bg-white shadow">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-xl font-bold text-blue-600">Cooler Management</a>
            <div class="space-x-4">
                <a href="{{ route('coolers.index') }}" class="text-gray-600 hover:text-gray-900">View Data</a>
                <a href="{{ route('coolers.import-form') }}" class="text-gray-600 hover:text-gray-900">Import</a>
            </div>
        </div>
    </nav>

    @yield('content')
</body>
</html>
