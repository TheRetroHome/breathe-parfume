@extends('layouts.admin')
@section('title', 'Редактировать категорию')

@section('content')
<div class="max-w-lg">
    <div class="mb-6">
        <a href="{{ route('admin.categories.index') }}" class="text-sm text-dark-500 hover:text-gold-400 transition-colors font-body">← Назад</a>
    </div>

    <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="glass-card p-6 space-y-4">
        @csrf @method('PUT')
        <div>
            <label class="label-dark">Название *</label>
            <input type="text" name="name" value="{{ old('name', $category->name) }}" class="input-dark" required>
        </div>
        <div>
            <label class="label-dark">Описание</label>
            <textarea name="description" rows="3" class="input-dark resize-none">{{ old('description', $category->description) }}</textarea>
        </div>
        <div class="flex gap-4 pt-2">
            <button type="submit" class="btn-gold text-sm px-6 py-3">Сохранить</button>
            <a href="{{ route('admin.categories.index') }}" class="btn-outline text-sm px-6 py-3">Отмена</a>
        </div>
    </form>
</div>
@endsection
