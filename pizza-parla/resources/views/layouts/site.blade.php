<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Pizza&Parla - A Melhor Pizzaria')</title>
    
    {{-- Bootstrap 5 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    {{-- CSS Customizado --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <link rel="icon" href="{{ asset('img/logo.png') }}">
    @stack('styles')
</head>
<body>
    {{-- Header/Navbar Component --}}
    @include('layouts.navbar')

    @if(session('success'))
        <div class="container mt-3">
            <div class="alert alert-success alert-dismissible fade show m-3 text-center">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show m-3 text-center">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    
    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer Component --}}
    @include('layouts.footer')

    {{-- Bootstrap 5 JS Bundle --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    {{-- Script Customizado --}}
    <script src="/js/scripts.js"></script>
    
    @stack('scripts')
    <x-auth-modal />
</body>
</html>