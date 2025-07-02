<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Chat App')</title>
    
    <!-- Tailwind CSS (CDN) or your compiled CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    @stack('styles')
</head>
<body class="bg-gray-100 text-gray-800 py-10">
    <!-- Main content -->
    <main class="container mx-auto px-4">
        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="mt-10 py-6 text-center text-gray-500">
        &copy; {{ date('Y') }} Chat App. All rights reserved.
    </footer>

    @stack('scripts')
</body>
</html>
