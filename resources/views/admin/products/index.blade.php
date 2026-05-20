@extends('layouts.admin')
@section('title', 'Товары')

@section('content')
<div class="flex items-center justify-between mb-8">
    <p class="text-dark-400 font-body text-sm">Всего: {{ $products->total() }}</p>
    <a href="{{ route('admin.products.create') }}" class="btn-gold text-sm px-5 py-2.5">+ Добавить товар</a>
</div>

<div class="glass-card overflow-hidden">
    <table class="w-full">
        <thead>
            <tr class="border-b border-dark-800">
                <th class="text-left px-5 py-3 text-xs font-body uppercase tracking-widest text-dark-500">Товар</th>
                <th class="text-left px-5 py-3 text-xs font-body uppercase tracking-widest text-dark-500 hidden md:table-cell">Категория</th>
                <th class="text-left px-5 py-3 text-xs font-body uppercase tracking-widest text-dark-500 hidden lg:table-cell">Цена</th>
                <th class="text-left px-5 py-3 text-xs font-body uppercase tracking-widest text-dark-500 hidden lg:table-cell">Склад</th>
                <th class="text-left px-5 py-3 text-xs font-body uppercase tracking-widest text-dark-500">Статус</th>
                <th class="px-5 py-3"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-dark-800">
            @foreach($products as $product)
            <tr class="hover:bg-dark-800/30 transition-colors">
                <td class="px-5 py-4">
                    <p class="text-sm font-body text-dark-200 font-medium">{{ $product->name }}</p>
                    <p class="text-xs text-dark-500 font-body">{{ $product->brand }} · {{ $product->volume_ml }} мл</p>
                </td>
                <td class="px-5 py-4 hidden md:table-cell">
                    <p class="text-xs text-dark-400 font-body">{{ $product->category->name }}</p>
                </td>
                <td class="px-5 py-4 hidden lg:table-cell">
                    <p class="text-sm font-body text-dark-200">{{ number_format($product->price, 0, '.', ' ') }} ₽</p>
                </td>
                <td class="px-5 py-4 hidden lg:table-cell">
                    <p class="text-sm font-body {{ $product->stock > 0 ? 'text-dark-200' : 'text-red-400' }}">{{ $product->stock }}</p>
                </td>
                <td class="px-5 py-4">
                    <div class="flex gap-2 flex-wrap">
                        @if($product->is_active)
                        <span class="text-xs px-2 py-0.5 bg-emerald-600/10 text-emerald-400 border border-emerald-600/20 font-body">Активен</span>
                        @else
                        <span class="text-xs px-2 py-0.5 bg-red-500/10 text-red-400 border border-red-500/20 font-body">Скрыт</span>
                        @endif
                        @if($product->is_new)
                        <span class="text-xs px-2 py-0.5 bg-gold-500/10 text-gold-400 border border-gold-500/20 font-body">New</span>
                        @endif
                    </div>
                </td>
                <td class="px-5 py-4">
                    <div class="flex items-center gap-3 justify-end">
                        <a href="{{ route('admin.products.edit', $product) }}" class="text-xs text-dark-400 hover:text-gold-400 transition-colors font-body">Изменить</a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                              onsubmit="return confirm('Удалить товар?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-xs text-dark-600 hover:text-red-400 transition-colors font-body">Удалить</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@if($products->hasPages())
<div class="mt-6">{{ $products->links('pagination.custom') }}</div>
@endif
@endsection
