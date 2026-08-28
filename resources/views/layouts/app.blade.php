<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'POS Milan')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #FAF8F5;
        }
    </style>
</head>
<body class="min-h-screen text-slate-800 flex flex-col">

    {{-- Sembunyikan navbar di halaman POS (create/pos) dan halaman auth (login/register) --}}
    {{-- Sembunyikan navbar di halaman POS (create/pos), Tambah/Edit User, dan halaman auth (login/register) --}}
@if (!Request::is('penjualan/create*') 
    && !Request::is('penjualan/pos*') 
    && !Request::is('admin/users/create*') 
    && !Request::is('admin/users/*/edit*') 
    && !Request::is('login*') 
    && !Request::is('register*'))
    @include('layouts.navbar')
@endif

    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if(session('success'))
            <div class="mb-6 p-4 text-sm text-[#3C6430] bg-[#EAF5E5] border border-[#C5E3B8] rounded-2xl shadow-sm flex items-center justify-between">
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 text-sm text-[#8C3A3A] bg-[#F7EBEB] border border-[#E5C3C3] rounded-2xl shadow-sm flex items-center justify-between">
                <span>{{ session('error') }}</span>
            </div>
        @endif

        @yield('content')
    </main>

</body>
</html>