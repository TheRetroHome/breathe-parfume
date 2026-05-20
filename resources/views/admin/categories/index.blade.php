@extends('layouts.admin')
@section('title', 'Категории')

@section('content')
<div class="flex items-center justify-between mb-8">
    <p class="text-dark-400 font-body text-sm">Всего: {{ $categories->total() }}</p>
    <a href="{{ route('admin.categories.create') }}" class="btn-gold text-sm px-5 py-2.5">+ Добавить</a>
</div>

<div class="glass-card overflow-hidden">
    <table class="w-full">
        <thead>
            <tr class="border-b border-dark-800">
                <th class="text-left px-5 py-3 text-xs font-body uppercase tracking-widest text-dark-500">Название</th>
                <th class="text-left px-5 py-3 text-xs font-body uppercase tracking-widest text-dark-500">Slug</th>
                <th class="text-left px-5 py-3 text-xs font-body uppercase tracking-widest text-dark-500">Товаров</th>
                <th class="px-5 py-3"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-dark-800">
            @foreach($categories as $category)
            <tr class="hover:bg-dark-800/30 transition-colors">
                <td class="px-5 py-4 text-sm font-body text-dark-200">{{ $category->name }}</td>
                <td class="px-5 py-4 text-xs font-body text-dark-500">{{ $category->slug }}</td>
                <td class="px-5 py-4 text-sm font-body text-dark-400">{{ $category->products_count }}</td>
                <td class="px-5 py-4">
                    <div class="flex items-center gap-3 justify-end">
                        <a href="{{ route('admin.categories.edit', $category) }}" class="text-xs text-dark-400 hover:text-gold-400 transition-colors font-body">Изменить</a>
                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                              onsubmit="return confirm('Удалить категорию?')">
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
@endsection
