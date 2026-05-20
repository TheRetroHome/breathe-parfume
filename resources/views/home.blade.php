<x-app-layout>
    <x-slot name="title">Премиальная парфюмерия</x-slot>

    {{-- Hero Section --}}
    <section class="relative min-h-screen flex items-center overflow-hidden"
             style="background: radial-gradient(ellipse at 50% 0%, rgba(212,149,23,0.15) 0%, transparent 70%), linear-gradient(180deg, #0a0a07 0%, #14140f 100%);">

        {{-- Animated particles --}}
        <div class="absolute inset-0 overflow-hidden pointer-events-none" id="particles-hero">
            @for($i = 0; $i < 20; $i++)
            <div class="particle absolute rounded-full bg-gold-500/20"
                 style="
                     width: {{ rand(2, 6) }}px;
                     height: {{ rand(2, 6) }}px;
                     left: {{ rand(0, 100) }}%;
                     top: {{ rand(0, 100) }}%;
                     animation: float {{ rand(4, 8) }}s ease-in-out {{ rand(0, 4) }}s infinite alternate;
                 "></div>
            @endfor
        </div>

        {{-- Gradient orbs --}}
        <div class="absolute top-1/4 left-1/4 w-96 h-96 rounded-full blur-3xl opacity-10"
             style="background: radial-gradient(circle, #d49517, transparent)"></div>
        <div class="absolute bottom-1/4 right-1/4 w-80 h-80 rounded-full blur-3xl opacity-10"
             style="background: radial-gradient(circle, #836fd9, transparent)"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32">
            <div class="max-w-3xl">
                <div class="mb-6 animate-fade-in" style="animation-delay: 0.1s">
                    <span class="section-subtitle">Коллекция 2026</span>
                </div>

                <h1 class="text-6xl md:text-8xl lg:text-9xl leading-none mb-8 animate-fade-up"
                    style="font-family: 'Cormorant Garamond', serif; animation-delay: 0.2s;">
                    Аромат —<br>
                    это <span class="gradient-gold animate-glow">душа</span>
                </h1>

                <p class="text-lg text-dark-300 leading-relaxed mb-12 max-w-xl font-body animate-fade-up"
                   style="animation-delay: 0.4s;">
                    Откройте мир премиальной парфюмерии. Каждый флакон — это история,
                    каждый аромат — воспоминание, которое останется с вами навсегда.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 animate-fade-up" style="animation-delay: 0.6s;">
                    <a href="{{ route('catalog') }}" class="btn-gold text-base px-10 py-4">
                        Исследовать коллекцию
                    </a>
                    <a href="{{ route('quiz') }}" class="btn-outline text-base px-10 py-4">
                        Найти свой аромат
                    </a>
                </div>

                {{-- Stats --}}
                <div class="mt-20 grid grid-cols-3 gap-8 pt-12 border-t border-dark-800/60 animate-fade-up"
                     style="animation-delay: 0.8s;">
                    <div>
                        <p class="text-3xl font-sans text-dark-50" style="font-family: 'Cormorant Garamond', serif;">15+</p>
                        <p class="text-xs font-body text-dark-500 uppercase tracking-widest mt-1">Уникальных ароматов</p>
                    </div>
                    <div>
                        <p class="text-3xl font-sans text-dark-50" style="font-family: 'Cormorant Garamond', serif;">100%</p>
                        <p class="text-xs font-body text-dark-500 uppercase tracking-widest mt-1">Оригинальные</p>
                    </div>
                    <div>
                        <p class="text-3xl font-sans text-dark-50" style="font-family: 'Cormorant Garamond', serif;">5★</p>
                        <p class="text-xs font-body text-dark-500 uppercase tracking-widest mt-1">Средняя оценка</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Scroll indicator --}}
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 animate-float">
            <p class="text-xs text-dark-600 uppercase tracking-widest font-body">Прокрутите вниз</p>
            <div class="w-px h-12 bg-gradient-to-b from-dark-600 to-transparent"></div>
        </div>
    </section>

    {{-- Bestsellers --}}
    @if($bestsellers->isNotEmpty())
    <section class="py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row items-start sm:items-end justify-between mb-12 scroll-reveal">
            <div>
                <p class="section-subtitle mb-3">Лидеры продаж</p>
                <h2 class="section-title">Бестселлеры</h2>
            </div>
            <a href="{{ route('catalog') }}?bestseller=1" class="btn-ghost mt-4 sm:mt-0 group">
                Все ароматы
                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"/>
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
            @foreach($bestsellers as $i => $product)
            <div class="scroll-reveal" style="transition-delay: {{ $i * 0.1 }}s;">
                @include('components.product-card', ['product' => $product])
            </div>
            @endforeach
        </div>
    </section>
    @endif

    {{-- Quiz Teaser --}}
    <section class="py-24 relative overflow-hidden"
             style="background: linear-gradient(135deg, rgba(212,149,23,0.05) 0%, rgba(131,111,217,0.05) 100%);">
        <div class="absolute inset-0 border-y border-dark-800/40"></div>

        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center scroll-reveal">
            <p class="section-subtitle mb-4">Персонализация</p>
            <h2 class="section-title mb-6">
                Какой аромат<br>
                <span class="gradient-gold">создан для вас?</span>
            </h2>
            <p class="text-dark-400 text-lg leading-relaxed mb-10 max-w-2xl mx-auto font-body">
                Пройдите наш уникальный тест из 5 вопросов, и мы подберём парфюм,
                который станет вашей второй кожей.
            </p>

            <div class="flex flex-wrap justify-center gap-4 mb-10">
                @foreach(['Настроение', 'Сезон', 'Характер', 'Случай', 'Интенсивность'] as $step)
                <div class="flex items-center gap-2 px-4 py-2 bg-dark-900/60 border border-dark-700 text-dark-400 text-sm font-body">
                    <span class="w-5 h-5 rounded-full border border-gold-500/40 text-gold-500 text-xs flex items-center justify-center">{{ $loop->index + 1 }}</span>
                    {{ $step }}
                </div>
                @endforeach
            </div>

            <a href="{{ route('quiz') }}" class="btn-gold text-base px-12 py-4">
                Начать тест
            </a>
        </div>
    </section>

    {{-- New Arrivals --}}
    @if($newArrivals->isNotEmpty())
    <section class="py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row items-start sm:items-end justify-between mb-12 scroll-reveal">
            <div>
                <p class="section-subtitle mb-3">Только что получили</p>
                <h2 class="section-title">Новинки</h2>
            </div>
            <a href="{{ route('catalog') }}?new=1" class="btn-ghost mt-4 sm:mt-0 group">
                Все новинки
                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"/>
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
            @foreach($newArrivals as $i => $product)
            <div class="scroll-reveal" style="transition-delay: {{ $i * 0.1 }}s;">
                @include('components.product-card', ['product' => $product])
            </div>
            @endforeach
        </div>
    </section>
    @endif

    {{-- Top Rated --}}
    @if($topRated->isNotEmpty())
    <section class="py-24 bg-dark-900/30 border-y border-dark-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 scroll-reveal">
                <p class="section-subtitle mb-3">Любимые покупателями</p>
                <h2 class="section-title">Высший рейтинг</h2>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                @foreach($topRated as $i => $product)
                <div class="scroll-reveal" style="transition-delay: {{ $i * 0.08 }}s;">
                    @include('components.product-card', ['product' => $product, 'compact' => true])
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- Reviews --}}
    @if($reviews->isNotEmpty())
    <section class="py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 scroll-reveal">
            <p class="section-subtitle mb-3">Отзывы</p>
            <h2 class="section-title">Что говорят покупатели</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($reviews as $i => $review)
            <div class="glass-card p-6 scroll-reveal" style="transition-delay: {{ $i * 0.1 }}s;">
                <div class="star-rating mb-3">
                    @for($s = 1; $s <= 5; $s++)
                    @if($s <= $review->rating)
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    @else
                    <svg class="w-4 h-4 fill-current text-dark-700" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    @endif
                    @endfor
                </div>

                @if($review->title)
                <h4 class="text-dark-100 font-sans text-lg mb-2" style="font-family: 'Cormorant Garamond', serif;">{{ $review->title }}</h4>
                @endif

                <p class="text-dark-400 text-sm leading-relaxed mb-4 font-body line-clamp-3">{{ $review->body }}</p>

                <div class="flex items-center gap-3 pt-4 border-t border-dark-800">
                    <div class="w-8 h-8 rounded-full bg-gold-500/10 border border-gold-500/20 flex items-center justify-center">
                        <span class="text-gold-500 text-xs font-semibold">{{ mb_strtoupper(mb_substr($review->user->name, 0, 1)) }}</span>
                    </div>
                    <div>
                        <p class="text-sm text-dark-200 font-body">{{ $review->user->name }}</p>
                        <a href="{{ route('product.show', $review->product->slug) }}" class="text-xs text-dark-500 hover:text-gold-500 transition-colors">{{ $review->product->name }}</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    {{-- Newsletter / CTA --}}
    <section class="py-24 relative overflow-hidden">
        <div class="absolute inset-0"
             style="background: linear-gradient(135deg, rgba(10,10,7,1) 0%, rgba(20,20,15,1) 50%, rgba(10,10,7,1) 100%);">
        </div>
        <div class="absolute inset-0 border-y border-dark-800/40"></div>

        <div class="relative max-w-2xl mx-auto px-4 text-center scroll-reveal">
            <p class="section-subtitle mb-4">Будьте первыми</p>
            <h2 class="section-title mb-4">
                Новые ароматы<br>каждый сезон
            </h2>
            <p class="text-dark-400 font-body mb-8">
                Следите за обновлениями коллекций, специальными предложениями и эксклюзивными релизами.
            </p>
            <a href="{{ route('register') }}" class="btn-gold px-10 py-4 text-base">
                Присоединиться
            </a>
        </div>
    </section>

</x-app-layout>
