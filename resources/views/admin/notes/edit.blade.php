@extends('layouts.admin')
@section('title', 'Редактировать ноту')

@section('content')
<div class="max-w-lg">
    <div class="mb-6">
        <a href="{{ route('admin.notes.index') }}" class="text-sm text-dark-500 hover:text-gold-400 transition-colors font-body">← Назад</a>
    </div>

    <form action="{{ route('admin.notes.update', $note) }}" method="POST" class="glass-card p-6 space-y-4">
        @csrf @method('PUT')
        <div>
            <label class="label-dark">Название *</label>
            <input type="text" name="name" value="{{ old('name', $note->name) }}" class="input-dark" required>
        </div>
        <div>
            <label class="label-dark">Тип *</label>
            <select name="type" class="input-dark" required>
                <option value="top" {{ old('type', $note->type) === 'top' ? 'selected' : '' }}>Верхняя</option>
                <option value="heart" {{ old('type', $note->type) === 'heart' ? 'selected' : '' }}>Сердечная</option>
                <option value="base" {{ old('type', $note->type) === 'base' ? 'selected' : '' }}>Базовая</option>
            </select>
        </div>
        <div>
            <label class="label-dark">Иконка (emoji)</label>
            <input type="text" name="icon" value="{{ old('icon', $note->icon) }}" class="input-dark">
        </div>
        <div class="flex gap-4 pt-2">
            <button type="submit" class="btn-gold text-sm px-6 py-3">Сохранить</button>
            <a href="{{ route('admin.notes.index') }}" class="btn-outline text-sm px-6 py-3">Отмена</a>
        </div>
    </form>
</div>
@endsection
