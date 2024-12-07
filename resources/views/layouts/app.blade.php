<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <div class="min-h-screen flex flex-col">
        <!-- Navbar atau bagian atas (optional) -->
        <header class="bg-blue-600 text-white p-4">
            <h1 class="text-xl font-semibold">Laravel User Dashboard</h1>
        </header>

        <!-- Konten utama -->
        <main class="flex-1">
            @yield('content') <!-- Bagian ini akan diisi oleh konten dari setiap view -->
        </main>

        <!-- Footer (optional) -->
        <footer class="bg-blue-600 text-white p-4 text-center">
            <p>&copy; 2024 My Application</p>
        </footer>
    </div>

</body>
</html>
