<x-app-layout>
    <x-slot name="title">Ваш аромат</x-slot>

    <div class="min-h-screen py-20"
         style="background: radial-gradient(ellipse at 50% 0%, rgba(212,149,23,0.08) 0%, transparent 60%);">

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="text-center mb-16">
                <div class="text-5xl mb-6 animate-float">✨</div>
                <p class="section-subtitle mb-4">Результат теста</p>
                <h1 class="text-5xl md:text-6xl font-sans text-dark-50 mb-4" style="font-family: 'Cormorant Garamond', serif;">
                    Ваши ароматы
                </h1>
                <p class="text-dark-400 font-body max-w-lg mx-auto">
                    На основе ваших ответов мы подобрали {{ count($products) }} {{ trans_choice('аромат|аромата|ароматов', count($products)) }},
                    которые идеально вам подойдут
                </p>
            </div>

            {{-- Results --}}
            <div class="grid grid-cols-1 md:grid-cols-{{ count($products) === 1 ? '1' : (count($products) === 2 ? '2' : '3') }} gap-6 mb-16">
                @foreach($products as $i => $product)
                <div class="animate-fade-up" style="animation-delay: {{ $i * 0.2 }}s;">
                    <div class="glass-card p-6 text-center group hover:border-gold-500/30 transition-all duration-500 hover:-translate-y-2">
                        @if($i === 0)
                        <div class="mb-4 flex justify-center">
                            <span class="px-3 py-1 bg-gold-500/10 border border-gold-500/30 text-gold-400 text-xs font-body uppercase tracking-wider">
                                ★ Лучшее совпадение
                            </span>
                        </div>
                        @endif

                        <div class="w-full aspect-square mb-5 bg-gradient-to-br from-dark-800 to-dark-900 flex items-center justify-center overflow-hidden">
                            @if($product->main_image && file_exists(storage_path('app/public/' . $product->main_image)))
                            <img src="{{ asset('storage/' . $product->main_image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                            @else
                            <div class="text-6xl animate-float" style="animation-delay: {{ $i * 0.5 }}s;">🌸</div>
                            @endif
                        </div>

                        <p class="text-xs font-body text-dark-500 uppercase tracking-widest mb-1">{{ $product->brand }}</p>
                        <h2 class="text-2xl font-sans text-dark-100 mb-2" style="font-family: 'Cormorant Garamond', serif;">{{ $product->name }}</h2>

                        @if($product->reviews_count > 0)
                        <div class="flex justify-center items-center gap-1.5 mb-3">
                            <div class="star-rating text-sm">
                                @for($s = 1; $s <= 5; $s++)
                                <svg class="w-3.5 h-3.5 {{ $s <= round($product->rating) ? 'fill-current' : 'fill-current text-dark-700' }}" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                @endfor
                            </div>
                            <span class="text-xs text-dark-500 font-body">({{ $product->reviews_count }})</span>
                        </div>
                        @endif

                        <p class="text-dark-400 text-sm font-body mb-5 line-clamp-2">{{ $product->short_description }}</p>

                        <div class="flex items-center justify-between">
                            <span class="text-xl font-sans text-dark-50" style="font-family: 'Cormorant Garamond', serif;">
                                {{ number_format($product->price, 0, '.', ' ') }} ₽
                            </span>
                            <a href="{{ route('product.show', $product->slug) }}" class="btn-gold text-xs px-5 py-2.5">
                                Подробнее
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Actions --}}
            <div class="text-center space-y-4">
                <a href="{{ route('quiz') }}" class="btn-outline text-sm mr-4">Пройти тест заново</a>
                <a href="{{ route('catalog') }}" class="btn-gold text-sm">Смотреть весь каталог</a>
            </div>
        </div>
    </div>
</x-app-layout>
