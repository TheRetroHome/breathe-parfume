@extends('layouts.admin')
@section('title', 'Заказы')

@section('content')
{{-- Filter --}}
<div class="flex items-center gap-3 mb-8 flex-wrap">
    @foreach(['all' => 'Все', 'pending' => 'Ожидают', 'confirmed' => 'Подтверждены', 'shipped' => 'В доставке', 'delivered' => 'Доставлены', 'cancelled' => 'Отменены'] as $val => $label)
    <a href="{{ route('admin.orders.index') }}{{ $val !== 'all' ? '?status=' . $val : '' }}"
       class="text-xs font-body px-3 py-1.5 border transition-colors {{ request('status', 'all') === $val ? 'border-gold-500 text-gold-400 bg-gold-500/5' : 'border-dark-700 text-dark-400 hover:border-dark-500' }}">
        {{ $label }}
    </a>
    @endforeach
</div>

<div class="glass-card overflow-hidden">
    <table class="w-full">
        <thead>
            <tr class="border-b border-dark-800">
                <th class="text-left px-5 py-3 text-xs font-body uppercase tracking-widest text-dark-500">#</th>
                <th class="text-left px-5 py-3 text-xs font-body uppercase tracking-widest text-dark-500">Клиент</th>
                <th class="text-left px-5 py-3 text-xs font-body uppercase tracking-widest text-dark-500 hidden md:table-cell">Дата</th>
                <th class="text-left px-5 py-3 text-xs font-body uppercase tracking-widest text-dark-500">Статус</th>
                <th class="text-left px-5 py-3 text-xs font-body uppercase tracking-widest text-dark-500">Сумма</th>
                <th class="px-5 py-3"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-dark-800">
            @foreach($orders as $order)
            <tr class="hover:bg-dark-800/30 transition-colors">
                <td class="px-5 py-4 text-sm font-body text-dark-400">#{{ $order->id }}</td>
                <td class="px-5 py-4">
                    <p class="text-sm font-body text-dark-200">{{ $order->name }}</p>
                    <p class="text-xs text-dark-500 font-body">{{ $order->user->email }}</p>
                </td>
                <td class="px-5 py-4 hidden md:table-cell text-xs text-dark-500 font-body">{{ $order->created_at->format('d.m.Y H:i') }}</td>
                <td class="px-5 py-4">
                    <span class="text-xs px-2 py-0.5 border font-body"
                          style="color: {{ ['pending'=>'#efc84d','confirmed'=>'#6e95e6','shipped'=>'#836fd9','delivered'=>'#16b06e','cancelled'=>'#e05471'][$order->status] ?? '#8c8c70' }};
                                 border-color: {{ ['pending'=>'#efc84d','confirmed'=>'#6e95e6','shipped'=>'#836fd9','delivered'=>'#16b06e','cancelled'=>'#e05471'][$order->status] ?? '#8c8c70' }}40;">
                        {{ $order->status_label }}
                    </span>
                </td>
                <td class="px-5 py-4 text-sm font-body font-medium text-dark-100">{{ number_format($order->total, 0, '.', ' ') }} ₽</td>
                <td class="px-5 py-4">
                    <a href="{{ route('admin.orders.show', $order) }}" class="text-xs text-dark-400 hover:text-gold-400 transition-colors font-body">Подробнее →</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@if($orders->hasPages())
<div class="mt-6">{{ $orders->links('pagination.custom') }}</div>
@endif
@endsection
