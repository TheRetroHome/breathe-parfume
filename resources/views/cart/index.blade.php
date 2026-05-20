<x-app-layout>
    <x-slot name="title">Корзина</x-slot>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="mb-10">
            <p class="section-subtitle mb-2">Ваши покупки</p>
            <h1 class="section-title">Корзина</h1>
        </div>

        @if($cartItems->isEmpty())
        <div class="text-center py-24">
            <div class="text-6xl mb-6">🛒</div>
            <h2 class="text-3xl font-sans text-dark-300 mb-3" style="font-family: 'Cormorant Garamond', serif;">Корзина пуста</h2>
            <p class="text-dark-500 font-body mb-8">Добавьте ароматы, которые вас вдохновили</p>
            <a href="{{ route('catalog') }}" class="btn-gold">Перейти в каталог</a>
        </div>
        @else
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            {{-- Cart Items --}}
            <div class="lg:col-span-2 space-y-4">
                @foreach($cartItems as $item)
                <div class="glass-card p-5 flex gap-4">
                    {{-- Image --}}
                    <a href="{{ route('product.show', $item->product->slug) }}"
                       class="w-20 h-24 shrink-0 bg-dark-800 flex items-center justify-center overflow-hidden">
                        @if($item->product->main_image && file_exists(storage_path('app/public/' . $item->product->main_image)))
                        <img src="{{ asset('storage/' . $item->product->main_image) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                        @else
                        <span class="text-3xl">🌸</span>
                        @endif
                    </a>

                    {{-- Info --}}
                    <div class="flex-1 min-w-0">
                        <p class="text-xs text-dark-500 font-body mb-0.5">{{ $item->product->brand }}</p>
                        <a href="{{ route('product.show', $item->product->slug) }}"
                           class="block text-dark-100 font-sans text-lg leading-tight hover:text-gold-400 transition-colors"
                           style="font-family: 'Cormorant Garamond', serif;">{{ $item->product->name }}</a>
                        <p class="text-xs text-dark-500 font-body mt-1">{{ $item->product->volume_ml }} мл · {{ $item->product->concentration }}</p>

                        <div class="flex items-center justify-between mt-3 flex-wrap gap-2">
                            {{-- Quantity --}}
                            <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center gap-2">
                                @csrf
                                @method('PATCH')
                                <div class="flex items-center border border-dark-700">
                                    <button type="button" onclick="this.nextElementSibling.stepDown(); this.closest('form').submit();"
                                            class="w-8 h-8 text-dark-400 hover:text-gold-400 transition-colors flex items-center justify-center">−</button>
                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="99"
                                           class="w-12 text-center bg-transparent text-dark-200 text-sm font-body border-0 focus:outline-none"
                                           onchange="this.closest('form').submit()">
                                    <button type="button" onclick="this.previousElementSibling.stepUp(); this.closest('form').submit();"
                                            class="w-8 h-8 text-dark-400 hover:text-gold-400 transition-colors flex items-center justify-center">+</button>
                                </div>
                            </form>

                            <div class="flex items-center gap-4">
                                <p class="font-body font-semibold text-dark-50">
                                    {{ number_format($item->product->price * $item->quantity, 0, '.', ' ') }} ₽
                                </p>

                                {{-- Remove --}}
                                <form action="{{ route('cart.destroy', $item) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-dark-600 hover:text-red-400 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Order Summary --}}
            <div class="lg:col-span-1">
                <div class="glass-card p-6 sticky top-24">
                    <h2 class="font-sans text-2xl text-dark-50 mb-6" style="font-family: 'Cormorant Garamond', serif;">Итого</h2>

                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between text-sm font-body">
                            <span class="text-dark-400">Товары ({{ $cartItems->sum('quantity') }} шт.)</span>
                            <span class="text-dark-200">{{ number_format($total, 0, '.', ' ') }} ₽</span>
                        </div>
                        <div class="flex justify-between text-sm font-body">
                            <span class="text-dark-400">Доставка</span>
                            <span class="{{ $total >= 5000 ? 'text-emerald-400' : 'text-dark-200' }}">
                                {{ $total >= 5000 ? 'Бесплатно' : 'По тарифам' }}
                            </span>
                        </div>
                    </div>

                    <div class="divider-gold pt-4 flex justify-between font-body font-semibold mb-6">
                        <span class="text-dark-100">Итого</span>
                        <span class="text-dark-50 text-lg">{{ number_format($total, 0, '.', ' ') }} ₽</span>
                    </div>

                    <a href="{{ route('checkout.create') }}" class="btn-gold w-full text-sm py-4 text-center block">
                        Оформить заказ
                    </a>
                    <a href="{{ route('catalog') }}" class="btn-ghost w-full text-center text-sm mt-3">
                        Продолжить покупки
                    </a>
                </div>
            </div>
        </div>
        @endif
    </div>
</x-app-layout>
