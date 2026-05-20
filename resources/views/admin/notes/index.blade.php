@extends('layouts.admin')
@section('title', 'Ноты')

@section('content')
<div class="flex items-center justify-between mb-8">
    <p class="text-dark-400 font-body text-sm">Всего: {{ $notes->total() }}</p>
    <a href="{{ route('admin.notes.create') }}" class="btn-gold text-sm px-5 py-2.5">+ Добавить ноту</a>
</div>

<div class="glass-card overflow-hidden">
    <table class="w-full">
        <thead>
            <tr class="border-b border-dark-800">
                <th class="text-left px-5 py-3 text-xs font-body uppercase tracking-widest text-dark-500">Нота</th>
                <th class="text-left px-5 py-3 text-xs font-body uppercase tracking-widest text-dark-500">Тип</th>
                <th class="text-left px-5 py-3 text-xs font-body uppercase tracking-widest text-dark-500">Товаров</th>
                <th class="px-5 py-3"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-dark-800">
            @foreach($notes as $note)
            <tr class="hover:bg-dark-800/30 transition-colors">
                <td class="px-5 py-4">
                    <p class="text-sm font-body text-dark-200">{{ $note->icon }} {{ $note->name }}</p>
                </td>
                <td class="px-5 py-4">
                    <span class="text-xs px-2 py-1 font-body border {{ ['top' => 'text-emerald-400 border-emerald-600/20', 'heart' => 'text-burgundy-400 border-burgundy-600/20', 'base' => 'text-gold-400 border-gold-600/20'][$note->type] ?? '' }}">
                        {{ ['top' => 'Верхняя', 'heart' => 'Сердечная', 'base' => 'Базовая'][$note->type] ?? $note->type }}
                    </span>
                </td>
                <td class="px-5 py-4 text-sm text-dark-400 font-body">{{ $note->products_count }}</td>
                <td class="px-5 py-4">
                    <div class="flex items-center gap-3 justify-end">
                        <a href="{{ route('admin.notes.edit', $note) }}" class="text-xs text-dark-400 hover:text-gold-400 transition-colors font-body">Изменить</a>
                        <form action="{{ route('admin.notes.destroy', $note) }}" method="POST"
                              onsubmit="return confirm('Удалить ноту?')">
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
