<!DOCTYPE html>
<html lang="id">
<head>
    <!-- Pengaturan dasar halaman -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Judul halaman mengikuti view yang menggunakan layout ini -->
    <title>@yield('title', 'MyUniv')</title>

    <!-- Token keamanan untuk request Laravel -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Memuat Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Memuat CSS tambahan dari masing-masing halaman -->
    @stack('styles')
</head>

<!--
    Class body mengikuti pengaturan dari view.
    Jika view tidak menentukan body-class, gunakan min-h-screen.
-->
<body class="@yield('body-class', 'min-h-screen')">

    <!-- Tempat konten utama dari masing-masing halaman -->
    @yield('content')

    <!-- Memuat JavaScript tambahan dari masing-masing halaman -->
    @stack('scripts')
</body>
</html>
