<!DOCTYPE html>
<html lang="ru" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title . ' — ' : '' }}Breathe Parfume</title>
    <meta name="description" content="{{ $description ?? 'Премиальная парфюмерия — ароматы, которые создают воспоминания.' }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-dark-950 text-dark-100 font-body antialiased">

    {{-- Top Banner --}}
    <div class="bg-gold-500/10 border-b border-gold-500/20 py-2 text-center">
        <p class="text-xs font-body text-gold-400 tracking-widest uppercase">
            Бесплатная доставка от 5 000 ₽ &nbsp;·&nbsp; Оригинальные ароматы &nbsp;·&nbsp; Доставка по всей России
        </p>
    </div>

    {{-- Navigation --}}
    <nav class="sticky top-0 z-50 bg-dark-950/95 backdrop-blur-md border-b border-dark-800/80"
         x-data="{ open: false, search: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 md:h-20">

                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="w-8 h-8 rounded-full bg-gold-500/20 border border-gold-500/40 flex items-center justify-center group-hover:bg-gold-500/30 transition-colors">
                        <span class="text-gold-400 text-sm font-sans font-bold" style="font-family: 'Cormorant Garamond', serif;">B</span>
                    </div>
                    <span class="text-xl text-dark-50 tracking-widest uppercase" style="font-family: 'Cormorant Garamond', serif; letter-spacing: 0.2em;">
                        Breathe
                        <span class="gradient-gold">Parfume</span>
                    </span>
                </a>

                {{-- Desktop Menu --}}
                <div class="hidden md:flex items-center gap-8">
                    <a href="{{ route('catalog') }}" class="nav-link">Каталог</a>
                    <a href="{{ route('catalog') }}?gender=male" class="nav-link">Мужские</a>
                    <a href="{{ route('catalog') }}?gender=female" class="nav-link">Женские</a>
                    <a href="{{ route('quiz') }}" class="nav-link text-gold-500 hover:text-gold-300">Подобрать аромат</a>
                </div>

                {{-- Right Icons --}}
                <div class="flex items-center gap-1 md:gap-2">
                    {{-- Search --}}
                    <button @click="search = !search"
                            class="p-2 text-dark-400 hover:text-gold-400 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
                        </svg>
                    </button>

                    @auth
                    {{-- Favorites --}}
                    <a href="{{ route('favorites.index') }}" class="relative p-2 text-dark-400 hover:text-gold-400 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/>
                        </svg>
                    </a>

                    {{-- Cart --}}
                    <a href="{{ route('cart.index') }}" class="relative p-2 text-dark-400 hover:text-gold-400 transition-colors"
                       id="cart-icon">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007z"/>
                        </svg>
                        @php $cartCount = auth()->user()->cartItems()->sum('quantity'); @endphp
                        @if($cartCount > 0)
                        <span class="absolute -top-0.5 -right-0.5 w-4 h-4 rounded-full bg-gold-500 text-dark-950 text-[10px] font-bold flex items-center justify-center"
                              id="cart-count">{{ $cartCount }}</span>
                        @endif
                    </a>

                    {{-- Profile --}}
                    <div class="relative" x-data="{ profileOpen: false }">
                        <button @click="profileOpen = !profileOpen"
                                class="p-2 text-dark-400 hover:text-gold-400 transition-colors flex items-center gap-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                            </svg>
                        </button>
                        <div x-show="profileOpen" @click.away="profileOpen = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             class="absolute right-0 mt-2 w-48 bg-dark-900 border border-dark-700 shadow-2xl shadow-black/50 z-50"
                             style="display: none;">
                            <div class="p-3 border-b border-dark-800">
                                <p class="text-sm text-dark-200 font-body font-medium">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-dark-500">{{ auth()->user()->email }}</p>
                            </div>
                            <div class="py-1">
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-dark-300 hover:text-gold-400 hover:bg-dark-800 transition-colors">Профиль</a>
                                <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-sm text-dark-300 hover:text-gold-400 hover:bg-dark-800 transition-colors">Мои заказы</a>
                                <a href="{{ route('favorites.index') }}" class="block px-4 py-2 text-sm text-dark-300 hover:text-gold-400 hover:bg-dark-800 transition-colors">Избранное</a>
                                @if(auth()->user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gold-400 hover:bg-dark-800 transition-colors">Панель управления</a>
                                @endif
                                <div class="border-t border-dark-800 mt-1 pt-1">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-dark-400 hover:text-red-400 hover:bg-dark-800 transition-colors">
                                            Выйти
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <a href="{{ route('login') }}" class="text-sm text-dark-300 hover:text-gold-400 transition-colors px-3 py-2">Войти</a>
                    <a href="{{ route('register') }}" class="btn-gold text-xs px-4 py-2">Регистрация</a>
                    @endauth

                    {{-- Mobile menu button --}}
                    <button @click="open = !open" class="md:hidden p-2 text-dark-400">
                        <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                        </svg>
                        <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:none;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Search Bar --}}
        <div x-show="search"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             class="border-t border-dark-800 bg-dark-900"
             style="display: none;">
            <div class="max-w-7xl mx-auto px-4 py-4">
                <form action="{{ route('catalog') }}" method="GET" class="flex gap-3">
                    <input type="text" name="q" value="{{ request('q') }}"
                           class="input-dark flex-1"
                           placeholder="Поиск по названию, бренду, нотам..."
                           autofocus>
                    <button type="submit" class="btn-gold px-6">Найти</button>
                </form>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div x-show="open" class="md:hidden border-t border-dark-800 bg-dark-900" style="display:none;">
            <div class="py-4 px-4 space-y-1">
                <a href="{{ route('catalog') }}" class="block py-2 text-dark-300 text-sm uppercase tracking-wider">Каталог</a>
                <a href="{{ route('catalog') }}?gender=male" class="block py-2 text-dark-300 text-sm uppercase tracking-wider">Мужские</a>
                <a href="{{ route('catalog') }}?gender=female" class="block py-2 text-dark-300 text-sm uppercase tracking-wider">Женские</a>
                <a href="{{ route('quiz') }}" class="block py-2 text-gold-400 text-sm uppercase tracking-wider">Подобрать аромат</a>
            </div>
        </div>
    </nav>

    {{-- Flash Messages --}}
    @if(session('success'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
         x-transition:leave="transition ease-in duration-300" x-transition:leave-end="opacity-0 translate-y-2"
         class="fixed bottom-6 right-6 z-50 max-w-sm">
        <div class="flex items-center gap-3 bg-dark-800 border border-emerald-600/40 px-5 py-4 shadow-2xl shadow-black/50">
            <svg class="w-5 h-5 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="text-sm text-dark-100 font-body">{{ session('success') }}</p>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
         x-transition:leave="transition ease-in duration-300" x-transition:leave-end="opacity-0 translate-y-2"
         class="fixed bottom-6 right-6 z-50 max-w-sm">
        <div class="flex items-center gap-3 bg-dark-800 border border-burgundy-600/40 px-5 py-4 shadow-2xl shadow-black/50">
            <svg class="w-5 h-5 text-burgundy-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/>
            </svg>
            <p class="text-sm text-dark-100 font-body">{{ session('error') }}</p>
        </div>
    </div>
    @endif

    {{-- Main Content --}}
    <main>
        {{ $slot }}
    </main>

    {{-- Footer --}}
    <footer class="mt-24 border-t border-dark-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
                {{-- Brand --}}
                <div class="md:col-span-1">
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-3 mb-5">
                        <div class="w-8 h-8 rounded-full bg-gold-500/20 border border-gold-500/40 flex items-center justify-center">
                            <span class="text-gold-400 text-sm font-bold" style="font-family: 'Cormorant Garamond', serif;">B</span>
                        </div>
                        <span class="text-lg text-dark-50 tracking-widest uppercase" style="font-family: 'Cormorant Garamond', serif;">Breathe</span>
                    </a>
                    <p class="text-sm text-dark-400 leading-relaxed">
                        Парфюмерия как язык чувств. Каждый аромат — это история, которую вы рассказываете миру.
                    </p>
                </div>

                {{-- Navigation --}}
                <div>
                    <h4 class="text-xs font-body uppercase tracking-widest text-gold-500 mb-4">Каталог</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('catalog') }}" class="text-sm text-dark-400 hover:text-gold-400 transition-colors">Все ароматы</a></li>
                        <li><a href="{{ route('catalog') }}?gender=male" class="text-sm text-dark-400 hover:text-gold-400 transition-colors">Мужские</a></li>
                        <li><a href="{{ route('catalog') }}?gender=female" class="text-sm text-dark-400 hover:text-gold-400 transition-colors">Женские</a></li>
                        <li><a href="{{ route('catalog') }}?gender=unisex" class="text-sm text-dark-400 hover:text-gold-400 transition-colors">Унисекс</a></li>
                        <li><a href="{{ route('quiz') }}" class="text-sm text-dark-400 hover:text-gold-400 transition-colors">Подобрать аромат</a></li>
                    </ul>
                </div>

                {{-- Info --}}
                <div>
                    <h4 class="text-xs font-body uppercase tracking-widest text-gold-500 mb-4">Информация</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('privacy') }}" class="text-sm text-dark-400 hover:text-gold-400 transition-colors">Политика конфиденциальности</a></li>
                        <li><a href="{{ route('terms') }}" class="text-sm text-dark-400 hover:text-gold-400 transition-colors">Условия использования</a></li>
                    </ul>
                </div>

                {{-- Contact --}}
                <div>
                    <h4 class="text-xs font-body uppercase tracking-widest text-gold-500 mb-4">Контакты</h4>
                    <ul class="space-y-2">
                        <li class="text-sm text-dark-400">hello@breathe-parfume.ru</li>
                        <li class="text-sm text-dark-400">+7 (800) 000-00-00</li>
                        <li class="text-sm text-dark-400">Пн–Пт: 9:00–20:00</li>
                    </ul>
                </div>
            </div>

            <div class="divider-gold mt-12 pt-8 flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-xs text-dark-600">© {{ date('Y') }} Breathe Parfume. Все права защищены.</p>
                <p class="text-xs text-dark-600">Оригинальная парфюмерия. Только настоящие ароматы.</p>
            </div>
        </div>
    </footer>

    <script>
        // Scroll reveal animation
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.scroll-reveal').forEach(el => observer.observe(el));
    </script>
</body>
</html>
