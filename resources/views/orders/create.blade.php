<x-app-layout>
    <x-slot name="title">Оформление заказа</x-slot>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="mb-10">
            <p class="section-subtitle mb-2">Последний шаг</p>
            <h1 class="section-title">Оформление заказа</h1>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

            {{-- Form --}}
            <div>
                <form action="{{ route('checkout.store') }}" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label class="label-dark">Ваше имя *</label>
                        <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}"
                               class="input-dark" required>
                        @error('name')<p class="text-xs text-red-400 mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="label-dark">Телефон *</label>
                        <input type="tel" name="phone" value="{{ old('phone', auth()->user()->phone) }}"
                               class="input-dark" placeholder="+7 (___) ___-__-__" required>
                        @error('phone')<p class="text-xs text-red-400 mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="label-dark">Адрес доставки *</label>
                        <textarea name="address" rows="3" class="input-dark resize-none" required
                                  placeholder="Город, улица, дом, квартира, индекс">{{ old('address', auth()->user()->address) }}</textarea>
                        @error('address')<p class="text-xs text-red-400 mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="label-dark">Способ оплаты *</label>
                        <div class="space-y-2">
                            @foreach(['cash' => 'Наличными при получении', 'card' => 'Картой при получении'] as $val => $label)
                            <label class="flex items-center gap-3 cursor-pointer p-3 border border-dark-700 hover:border-gold-500/40 transition-colors">
                                <input type="radio" name="payment_method" value="{{ $val }}"
                                       {{ old('payment_method', 'cash') === $val ? 'checked' : '' }}
                                       class="accent-gold-500">
                                <span class="text-sm font-body text-dark-300">{{ $label }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <label class="label-dark">Комментарий к заказу</label>
                        <textarea name="comment" rows="3" class="input-dark resize-none"
                                  placeholder="Особые пожелания...">{{ old('comment') }}</textarea>
                    </div>

                    <button type="submit" class="btn-gold w-full py-4 text-base">
                        Подтвердить заказ
                    </button>
                </form>
            </div>

            {{-- Order Summary --}}
            <div>
                <div class="glass-card p-6">
                    <h2 class="font-sans text-2xl text-dark-50 mb-6" style="font-family: 'Cormorant Garamond', serif;">Ваш заказ</h2>

                    <div class="space-y-4 mb-6">
                        @foreach($cartItems as $item)
                        <div class="flex gap-3">
                            <div class="w-12 h-14 bg-dark-800 shrink-0 flex items-center justify-center overflow-hidden">
                                @if($item->product->main_image && file_exists(storage_path('app/public/' . $item->product->main_image)))
                                <img src="{{ asset('storage/' . $item->product->main_image) }}" alt="" class="w-full h-full object-cover">
                                @else
                                <span class="text-xl">🌸</span>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-body text-dark-200 leading-tight">{{ $item->product->name }}</p>
                                <p class="text-xs text-dark-500 font-body">{{ $item->quantity }} × {{ number_format($item->product->price, 0, '.', ' ') }} ₽</p>
                            </div>
                            <p class="text-sm font-body font-medium text-dark-100 shrink-0">
                                {{ number_format($item->product->price * $item->quantity, 0, '.', ' ') }} ₽
                            </p>
                        </div>
                        @endforeach
                    </div>

                    <div class="divider-gold pt-4 flex justify-between font-semibold font-body text-dark-50">
                        <span>Итого</span>
                        <span>{{ number_format($total, 0, '.', ' ') }} ₽</span>
                    </div>

                    <div class="mt-4 p-3 bg-gold-500/5 border border-gold-500/20">
                        <p class="text-xs text-dark-400 font-body">
                            После оформления заказа наш менеджер свяжется с вами для подтверждения.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
