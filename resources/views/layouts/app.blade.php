<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Test Laroche Henri') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

<!-- Navbar Component -->
@include('components.navbar')
<main class="container mx-auto px-4 py-6 p-6">
    @include('components.logout-form')
    @yield('content')
</main>

<!-- Footer Component -->
@include('components.footer')

</body>
</html>
