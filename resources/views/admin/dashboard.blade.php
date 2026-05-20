@extends('layouts.admin')
@section('title', 'Дашборд')

@section('content')
{{-- Stats Grid --}}
<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-10">
    @php
    $statCards = [
        ['label' => 'Всего заказов',  'value' => $stats['total_orders'],    'color' => 'gold'],
        ['label' => 'Ожидают',        'value' => $stats['pending_orders'],   'color' => 'yellow'],
        ['label' => 'Товаров',        'value' => $stats['total_products'],   'color' => 'lavender'],
        ['label' => 'Клиентов',       'value' => $stats['total_users'],      'color' => 'emerald'],
        ['label' => 'Выручка',        'value' => number_format($stats['total_revenue'], 0, '.', ' ') . ' ₽', 'color' => 'gold'],
        ['label' => 'Новых отзывов',  'value' => $stats['pending_reviews'],  'color' => 'burgundy'],
    ];
    @endphp

    @foreach($statCards as $card)
    <div class="glass-card p-5 text-center">
        <p class="text-2xl font-sans font-bold text-dark-50 mb-1" style="font-family: 'Cormorant Garamond', serif;">{{ $card['value'] }}</p>
        <p class="text-xs font-body text-dark-500 uppercase tracking-wider">{{ $card['label'] }}</p>
    </div>
    @endforeach
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    {{-- Recent Orders --}}
    <div class="glass-card p-6">
        <div class="flex items-center justify-between mb-5">
            <h2 class="text-lg font-sans text-dark-100" style="font-family: 'Cormorant Garamond', serif;">Последние заказы</h2>
            <a href="{{ route('admin.orders.index') }}" class="text-xs text-gold-500 hover:text-gold-400 transition-colors font-body uppercase tracking-wider">Все →</a>
        </div>
        <div class="space-y-3">
            @foreach($recentOrders as $order)
            <a href="{{ route('admin.orders.show', $order) }}"
               class="flex items-center justify-between py-2.5 border-b border-dark-800 hover:border-dark-700 transition-colors">
                <div>
                    <p class="text-sm font-body text-dark-200">#{{ $order->id }} · {{ $order->name }}</p>
                    <p class="text-xs text-dark-500 font-body">{{ $order->created_at->format('d.m.Y H:i') }}</p>
                </div>
                <div class="text-right">
                    <p class="text-sm font-body font-medium text-dark-100">{{ number_format($order->total, 0, '.', ' ') }} ₽</p>
                    <span class="text-xs font-body px-2 py-0.5 border"
                          style="color: {{ ['pending'=>'#efc84d','confirmed'=>'#6e95e6','shipped'=>'#836fd9','delivered'=>'#16b06e','cancelled'=>'#e05471'][$order->status] ?? '#8c8c70' }};
                                 border-color: {{ ['pending'=>'#efc84d','confirmed'=>'#6e95e6','shipped'=>'#836fd9','delivered'=>'#16b06e','cancelled'=>'#e05471'][$order->status] ?? '#8c8c70' }}40;">
                        {{ $order->status_label }}
                    </span>
                </div>
            </a>
            @endforeach
        </div>
    </div>

    {{-- Top Products --}}
    <div class="glass-card p-6">
        <div class="flex items-center justify-between mb-5">
            <h2 class="text-lg font-sans text-dark-100" style="font-family: 'Cormorant Garamond', serif;">Топ товаров</h2>
            <a href="{{ route('admin.products.index') }}" class="text-xs text-gold-500 hover:text-gold-400 transition-colors font-body uppercase tracking-wider">Все →</a>
        </div>
        <div class="space-y-3">
            @foreach($topProducts as $i => $product)
            <div class="flex items-center gap-4 py-2 border-b border-dark-800">
                <span class="text-lg font-sans text-dark-600 w-6" style="font-family: 'Cormorant Garamond', serif;">{{ $i + 1 }}</span>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-body text-dark-200 truncate">{{ $product->name }}</p>
                    <p class="text-xs text-dark-500 font-body">{{ $product->orders_count }} заказов</p>
                </div>
                <p class="text-sm font-body font-medium text-dark-100 shrink-0">{{ number_format($product->price, 0, '.', ' ') }} ₽</p>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
