<x-app-layout>
    <x-slot name="title">Заказ #{{ $order->id }}</x-slot>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="mb-8 flex items-center gap-4">
            <a href="{{ route('orders.index') }}" class="text-dark-500 hover:text-gold-400 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
                </svg>
            </a>
            <div>
                <p class="section-subtitle mb-1">Детали заказа</p>
                <h1 class="text-3xl font-sans text-dark-50" style="font-family: 'Cormorant Garamond', serif;">Заказ #{{ $order->id }}</h1>
            </div>
        </div>

        {{-- Status --}}
        <div class="glass-card p-5 mb-6 flex items-center justify-between">
            <div>
                <p class="text-xs font-body text-dark-500 uppercase tracking-wider mb-1">Статус</p>
                <p class="text-lg font-sans" style="font-family: 'Cormorant Garamond', serif;
                   color: {{ ['pending'=>'#efc84d','confirmed'=>'#6e95e6','shipped'=>'#836fd9','delivered'=>'#16b06e','cancelled'=>'#e05471'][$order->status] ?? '#8c8c70' }}">
                    {{ $order->status_label }}
                </p>
            </div>
            <div class="text-right">
                <p class="text-xs font-body text-dark-500 mb-1">Дата заказа</p>
                <p class="text-sm font-body text-dark-200">{{ $order->created_at->format('d.m.Y') }}</p>
            </div>
        </div>

        {{-- Items --}}
        <div class="glass-card p-6 mb-6">
            <h2 class="text-sm font-body uppercase tracking-widest text-gold-500 mb-5">Состав заказа</h2>
            <div class="space-y-4">
                @foreach($order->items as $item)
                <div class="flex gap-4">
                    <div class="w-14 h-16 bg-dark-800 shrink-0 flex items-center justify-center overflow-hidden">
                        @if($item->product && $item->product->main_image && file_exists(storage_path('app/public/' . $item->product->main_image)))
                        <img src="{{ asset('storage/' . $item->product->main_image) }}" alt="" class="w-full h-full object-cover">
                        @else
                        <span class="text-2xl">🌸</span>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-body text-dark-100">{{ $item->product_name }}</p>
                        <p class="text-xs text-dark-500 font-body">{{ $item->quantity }} × {{ number_format($item->price, 0, '.', ' ') }} ₽</p>
                    </div>
                    <p class="font-body font-medium text-dark-100 shrink-0">{{ number_format($item->subtotal, 0, '.', ' ') }} ₽</p>
                </div>
                @endforeach
            </div>

            <div class="divider-gold mt-5 pt-5 flex justify-between font-semibold font-body">
                <span class="text-dark-100">Итого</span>
                <span class="text-dark-50 text-lg">{{ number_format($order->total, 0, '.', ' ') }} ₽</span>
            </div>
        </div>

        {{-- Delivery Info --}}
        <div class="glass-card p-6">
            <h2 class="text-sm font-body uppercase tracking-widest text-gold-500 mb-5">Информация о доставке</h2>
            <dl class="space-y-3">
                <div class="flex gap-4">
                    <dt class="text-sm text-dark-500 font-body w-32 shrink-0">Получатель</dt>
                    <dd class="text-sm text-dark-200 font-body">{{ $order->name }}</dd>
                </div>
                <div class="flex gap-4">
                    <dt class="text-sm text-dark-500 font-body w-32 shrink-0">Телефон</dt>
                    <dd class="text-sm text-dark-200 font-body">{{ $order->phone }}</dd>
                </div>
                <div class="flex gap-4">
                    <dt class="text-sm text-dark-500 font-body w-32 shrink-0">Адрес</dt>
                    <dd class="text-sm text-dark-200 font-body">{{ $order->address }}</dd>
                </div>
                <div class="flex gap-4">
                    <dt class="text-sm text-dark-500 font-body w-32 shrink-0">Оплата</dt>
                    <dd class="text-sm text-dark-200 font-body">{{ $order->payment_method === 'cash' ? 'Наличными' : 'Картой' }}</dd>
                </div>
                @if($order->comment)
                <div class="flex gap-4">
                    <dt class="text-sm text-dark-500 font-body w-32 shrink-0">Комментарий</dt>
                    <dd class="text-sm text-dark-200 font-body">{{ $order->comment }}</dd>
                </div>
                @endif
            </dl>
        </div>
    </div>
</x-app-layout>
