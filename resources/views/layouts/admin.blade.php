<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — Breathe Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-dark-950 text-dark-100 font-body antialiased">

<div class="flex min-h-screen">
    {{-- Sidebar --}}
    <aside class="w-64 shrink-0 bg-dark-900 border-r border-dark-800 flex flex-col fixed h-full overflow-y-auto">
        <div class="p-6 border-b border-dark-800">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                <div class="w-7 h-7 rounded-full bg-gold-500/20 border border-gold-500/40 flex items-center justify-center">
                    <span class="text-gold-400 text-xs font-bold" style="font-family: 'Cormorant Garamond', serif;">B</span>
                </div>
                <span class="text-sm font-body text-dark-200 uppercase tracking-wider">Breathe Admin</span>
            </a>
        </div>

        <nav class="flex-1 p-4 space-y-1">
            @php
            $navItems = [
                ['route' => 'admin.dashboard',        'label' => 'Дашборд',    'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                ['route' => 'admin.products.index',   'label' => 'Товары',     'icon' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4'],
                ['route' => 'admin.categories.index', 'label' => 'Категории',  'icon' => 'M4 6h16M4 10h16M4 14h16M4 18h16'],
                ['route' => 'admin.notes.index',      'label' => 'Ноты',       'icon' => 'M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01'],
                ['route' => 'admin.orders.index',     'label' => 'Заказы',     'icon' => 'M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z'],
                ['route' => 'admin.reviews.index',    'label' => 'Отзывы',     'icon' => 'M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z'],
            ];
            @endphp

            @foreach($navItems as $item)
            @php $isActive = request()->routeIs(str_replace('.index', '', $item['route']) . '*'); @endphp
            <a href="{{ route($item['route']) }}"
               class="flex items-center gap-3 px-3 py-2.5 text-sm transition-colors {{ $isActive ? 'bg-gold-500/10 text-gold-400 border-l-2 border-gold-500' : 'text-dark-400 hover:text-dark-200 hover:bg-dark-800' }}">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $item['icon'] }}"/>
                </svg>
                {{ $item['label'] }}
            </a>
            @endforeach
        </nav>

        <div class="p-4 border-t border-dark-800">
            <a href="{{ route('home') }}" class="flex items-center gap-2 text-xs text-dark-500 hover:text-dark-300 transition-colors mb-3">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                На сайт
            </a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-xs text-dark-600 hover:text-red-400 transition-colors">Выйти</button>
            </form>
        </div>
    </aside>

    {{-- Main --}}
    <div class="flex-1 ml-64 min-w-0">
        {{-- Top Bar --}}
        <div class="bg-dark-900/50 border-b border-dark-800 px-8 py-4 flex items-center justify-between sticky top-0 z-10">
            <h1 class="text-xl font-sans text-dark-100" style="font-family: 'Cormorant Garamond', serif;">
                @yield('title', 'Панель управления')
            </h1>
            <p class="text-sm text-dark-500 font-body">{{ auth()->user()->name }}</p>
        </div>

        {{-- Flash --}}
        @if(session('success'))
        <div class="mx-8 mt-6 p-4 bg-emerald-600/10 border border-emerald-600/30 text-emerald-400 text-sm font-body flex items-center gap-2"
             x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="mx-8 mt-6 p-4 bg-red-500/10 border border-red-500/30 text-red-400 text-sm font-body">
            {{ session('error') }}
        </div>
        @endif

        <div class="p-8">
            @yield('content')
        </div>
    </div>
</div>
</body>
</html>
