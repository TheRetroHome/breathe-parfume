@extends('layouts.admin')
@section('title', $product->name)

@section('content')
<div class="flex items-center justify-between mb-6">
    <a href="{{ route('admin.products.index') }}" class="text-sm text-dark-500 hover:text-gold-400 transition-colors font-body">← Назад</a>
    <a href="{{ route('admin.products.edit', $product) }}" class="btn-gold text-sm px-5 py-2">Редактировать</a>
</div>

<div class="glass-card p-6">
    <h2 class="text-2xl font-sans text-dark-50 mb-2" style="font-family: 'Cormorant Garamond', serif;">{{ $product->name }}</h2>
    <p class="text-dark-400 font-body text-sm">{{ $product->short_description }}</p>
    <div class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-4">
        <div><p class="text-xs text-dark-500">Цена</p><p class="text-dark-100 font-body">{{ number_format($product->price, 0, '.', ' ') }} ₽</p></div>
        <div><p class="text-xs text-dark-500">Склад</p><p class="text-dark-100 font-body">{{ $product->stock }}</p></div>
        <div><p class="text-xs text-dark-500">Заказов</p><p class="text-dark-100 font-body">{{ $product->orders_count }}</p></div>
        <div><p class="text-xs text-dark-500">Рейтинг</p><p class="text-dark-100 font-body">{{ $product->rating }} ({{ $product->reviews_count }})</p></div>
    </div>
</div>
@endsection
