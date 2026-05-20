<x-app-layout>
    <x-slot name="title">Мои заказы</x-slot>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="mb-10">
            <p class="section-subtitle mb-2">История покупок</p>
            <h1 class="section-title">Мои заказы</h1>
        </div>

        @if($orders->isEmpty())
        <div class="text-center py-24">
            <div class="text-6xl mb-6">📦</div>
            <h2 class="text-3xl font-sans text-dark-300 mb-3" style="font-family: 'Cormorant Garamond', serif;">Заказов пока нет</h2>
            <p class="text-dark-500 font-body mb-8">Выберите ароматы и оформите свой первый заказ</p>
            <a href="{{ route('catalog') }}" class="btn-gold">Перейти в каталог</a>
        </div>
        @else
        <div class="space-y-4">
            @foreach($orders as $order)
            <a href="{{ route('orders.show', $order) }}"
               class="glass-card p-5 flex flex-col sm:flex-row sm:items-center gap-4 hover:border-gold-500/30 transition-all duration-300 block group">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-2">
                        <p class="font-body text-dark-100 font-medium">Заказ #{{ $order->id }}</p>
                        <span class="px-2 py-0.5 text-xs font-body font-semibold uppercase tracking-wider border"
                              style="color: {{ ['pending'=>'#efc84d','confirmed'=>'#6e95e6','shipped'=>'#836fd9','delivered'=>'#16b06e','cancelled'=>'#e05471'][$order->status] ?? '#8c8c70' }};
                                     border-color: {{ ['pending'=>'#efc84d','confirmed'=>'#6e95e6','shipped'=>'#836fd9','delivered'=>'#16b06e','cancelled'=>'#e05471'][$order->status] ?? '#8c8c70' }}40;">
                            {{ $order->status_label }}
                        </span>
                    </div>
                    <p class="text-xs text-dark-500 font-body">{{ $order->created_at->format('d.m.Y в H:i') }}</p>
                    <p class="text-xs text-dark-500 font-body mt-1">{{ $order->items->count() }} {{ trans_choice('товар|товара|товаров', $order->items->count()) }}</p>
                </div>

                <div class="text-right">
                    <p class="text-lg font-body font-semibold text-dark-50">{{ number_format($order->total, 0, '.', ' ') }} ₽</p>
                    <p class="text-xs text-dark-500 font-body group-hover:text-gold-400 transition-colors mt-1">Подробнее →</p>
                </div>
            </a>
            @endforeach
        </div>

        @if($orders->hasPages())
        <div class="mt-10">{{ $orders->links('pagination.custom') }}</div>
        @endif
        @endif
    </div>
</x-app-layout>
