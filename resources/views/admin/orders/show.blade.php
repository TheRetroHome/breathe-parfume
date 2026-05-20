@extends('layouts.admin')
@section('title', 'Заказ #' . $order->id)

@section('content')
<div class="flex items-center justify-between mb-6">
    <a href="{{ route('admin.orders.index') }}" class="text-sm text-dark-500 hover:text-gold-400 transition-colors font-body">← К заказам</a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    {{-- Order Info --}}
    <div class="lg:col-span-2 space-y-5">
        {{-- Items --}}
        <div class="glass-card p-6">
            <h2 class="text-sm font-body uppercase tracking-widest text-gold-500 mb-4">Товары</h2>
            <div class="space-y-3">
                @foreach($order->items as $item)
                <div class="flex items-center gap-4 py-2 border-b border-dark-800">
                    <div class="flex-1">
                        <p class="text-sm font-body text-dark-200">{{ $item->product_name }}</p>
                        <p class="text-xs text-dark-500 font-body">{{ $item->quantity }} × {{ number_format($item->price, 0, '.', ' ') }} ₽</p>
                    </div>
                    <p class="text-sm font-body font-medium text-dark-100">{{ number_format($item->subtotal, 0, '.', ' ') }} ₽</p>
                </div>
                @endforeach
                <div class="flex justify-between font-semibold font-body text-dark-50 pt-2">
                    <span>Итого</span>
                    <span>{{ number_format($order->total, 0, '.', ' ') }} ₽</span>
                </div>
            </div>
        </div>

        {{-- Delivery --}}
        <div class="glass-card p-6">
            <h2 class="text-sm font-body uppercase tracking-widest text-gold-500 mb-4">Доставка</h2>
            <dl class="space-y-3">
                @foreach(['name' => 'Получатель', 'phone' => 'Телефон', 'address' => 'Адрес', 'payment_method' => 'Оплата', 'comment' => 'Комментарий'] as $field => $label)
                @if($order->$field)
                <div class="flex gap-4">
                    <dt class="text-xs text-dark-500 w-24 shrink-0 font-body pt-0.5">{{ $label }}</dt>
                    <dd class="text-sm text-dark-200 font-body">
                        {{ $field === 'payment_method' ? ($order->$field === 'cash' ? 'Наличными' : 'Картой') : $order->$field }}
                    </dd>
                </div>
                @endif
                @endforeach
            </dl>
        </div>

        {{-- Admin Note --}}
        <div class="glass-card p-6">
            <h2 class="text-sm font-body uppercase tracking-widest text-gold-500 mb-4">Заметка администратора</h2>
            <form action="{{ route('admin.orders.update', $order) }}" method="POST" class="space-y-3">
                @csrf @method('PUT')
                <textarea name="admin_note" rows="3" class="input-dark resize-none w-full"
                          placeholder="Внутренние заметки...">{{ $order->admin_note }}</textarea>
                <button type="submit" class="btn-gold text-xs px-5 py-2">Сохранить</button>
            </form>
        </div>
    </div>

    {{-- Status --}}
    <div class="space-y-5">
        <div class="glass-card p-6">
            <h2 class="text-sm font-body uppercase tracking-widest text-gold-500 mb-4">Статус заказа</h2>
            <div class="mb-4 text-center">
                <p class="text-xl font-sans"
                   style="font-family: 'Cormorant Garamond', serif;
                          color: {{ ['pending'=>'#efc84d','confirmed'=>'#6e95e6','shipped'=>'#836fd9','delivered'=>'#16b06e','cancelled'=>'#e05471'][$order->status] ?? '#8c8c70' }}">
                    {{ $order->status_label }}
                </p>
            </div>
            <form action="{{ route('admin.orders.status', $order) }}" method="POST" class="space-y-3">
                @csrf @method('PATCH')
                <select name="status" class="input-dark w-full">
                    @foreach(['pending' => 'Ожидает', 'confirmed' => 'Подтверждён', 'shipped' => 'Отправлен', 'delivered' => 'Доставлен', 'cancelled' => 'Отменён'] as $val => $label)
                    <option value="{{ $val }}" {{ $order->status === $val ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn-gold w-full text-sm py-3">Обновить статус</button>
            </form>
        </div>

        <div class="glass-card p-6">
            <h2 class="text-sm font-body uppercase tracking-widest text-gold-500 mb-3">Клиент</h2>
            <p class="text-sm font-body text-dark-200">{{ $order->user->name }}</p>
            <p class="text-xs text-dark-500 font-body">{{ $order->user->email }}</p>
        </div>
    </div>
</div>
@endsection
