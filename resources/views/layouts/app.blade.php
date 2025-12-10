<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CELZ5 Citation')</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: @yield('body-bg', 'linear-gradient(to right, #4f46e5, #7c3aed, #ec4899)');
        }

        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        input,
        select,
        textarea {
            background: rgba(255, 255, 255, 0.8);
            color: #111827;
        }
    </style>

    @stack('styles')
</head>

<body class="min-h-screen flex flex-col">

    <!-- Header -->
    <header class="text-center py-8 bg-transparent">
        <h1 class="text-5xl font-bold text-white drop-shadow-lg">@yield('header-title', 'CELZ5 Citation')</h1>
        <p class="text-white/80 mt-2 text-lg">@yield('header-subtitle', 'Explore our Departments & Groups')</p>
    </header>

    <!-- Main Content -->
    <main class="flex-1 w-full flex flex-col items-center py-8 px-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="text-center text-white/70 py-6">
        &copy; 2025 CELZ5 Citation. All rights reserved.
    </footer>

    <!-- Feather Icons -->
    <script>
        feather.replace()
    </script>

    @stack('scripts')
</body>

</html>
