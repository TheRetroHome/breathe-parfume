@extends('layouts.admin')
@section('title', 'Редактировать: ' . $product->name)

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.products.index') }}" class="text-sm text-dark-500 hover:text-gold-400 transition-colors font-body">← Назад к товарам</a>
</div>

<form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
    @csrf @method('PUT')

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="space-y-5">
            <div class="glass-card p-6 space-y-4">
                <h2 class="text-sm font-body uppercase tracking-widest text-gold-500 mb-2">Основная информация</h2>

                <div>
                    <label class="label-dark">Название *</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" class="input-dark" required>
                </div>
                <div>
                    <label class="label-dark">Бренд *</label>
                    <input type="text" name="brand" value="{{ old('brand', $product->brand) }}" class="input-dark" required>
                </div>
                <div>
                    <label class="label-dark">Категория *</label>
                    <select name="category_id" class="input-dark" required>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="label-dark">Пол *</label>
                        <select name="gender" class="input-dark" required>
                            @foreach(['male' => 'Мужской', 'female' => 'Женский', 'unisex' => 'Унисекс'] as $val => $lbl)
                            <option value="{{ $val }}" {{ old('gender', $product->gender) === $val ? 'selected' : '' }}>{{ $lbl }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="label-dark">Концентрация</label>
                        <input type="text" name="concentration" value="{{ old('concentration', $product->concentration) }}" class="input-dark">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="label-dark">Объём (мл) *</label>
                        <input type="number" name="volume_ml" value="{{ old('volume_ml', $product->volume_ml) }}" class="input-dark" required>
                    </div>
                    <div>
                        <label class="label-dark">Страна</label>
                        <input type="text" name="country" value="{{ old('country', $product->country) }}" class="input-dark">
                    </div>
                </div>
                <div>
                    <label class="label-dark">Краткое описание *</label>
                    <textarea name="short_description" rows="2" class="input-dark resize-none" required>{{ old('short_description', $product->short_description) }}</textarea>
                </div>
                <div>
                    <label class="label-dark">Полное описание *</label>
                    <textarea name="description" rows="6" class="input-dark resize-none" required>{{ old('description', $product->description) }}</textarea>
                </div>
            </div>
        </div>

        <div class="space-y-5">
            <div class="glass-card p-6 space-y-4">
                <h2 class="text-sm font-body uppercase tracking-widest text-gold-500 mb-2">Цена и склад</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="label-dark">Цена (₽) *</label>
                        <input type="number" name="price" value="{{ old('price', $product->price) }}" class="input-dark" step="0.01" required>
                    </div>
                    <div>
                        <label class="label-dark">Старая цена (₽)</label>
                        <input type="number" name="old_price" value="{{ old('old_price', $product->old_price) }}" class="input-dark" step="0.01">
                    </div>
                </div>
                <div>
                    <label class="label-dark">Склад *</label>
                    <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="input-dark" min="0" required>
                </div>
            </div>

            <div class="glass-card p-6 space-y-4">
                <h2 class="text-sm font-body uppercase tracking-widest text-gold-500 mb-2">Изображение</h2>
                @if($product->main_image && file_exists(storage_path('app/public/' . $product->main_image)))
                <div class="w-20 h-24 mb-3 overflow-hidden bg-dark-800">
                    <img src="{{ asset('storage/' . $product->main_image) }}" alt="" class="w-full h-full object-cover">
                </div>
                @endif
                <div>
                    <label class="label-dark">Новое изображение (оставьте пустым, чтобы не менять)</label>
                    <input type="file" name="main_image" accept="image/*" class="input-dark py-2 file:mr-3 file:py-1 file:px-3 file:border-0 file:bg-dark-700 file:text-dark-300 file:text-xs file:cursor-pointer">
                </div>
            </div>

            <div class="glass-card p-6 space-y-3">
                <h2 class="text-sm font-body uppercase tracking-widest text-gold-500 mb-2">Статус</h2>
                @foreach(['is_active' => 'Активен', 'is_new' => 'Новинка', 'is_bestseller' => 'Бестселлер'] as $field => $label)
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" name="{{ $field }}" value="1"
                           {{ old($field, $product->$field) ? 'checked' : '' }}
                           class="accent-gold-500 w-4 h-4">
                    <span class="text-sm font-body text-dark-300">{{ $label }}</span>
                </label>
                @endforeach
            </div>

            <div class="glass-card p-6">
                <h2 class="text-sm font-body uppercase tracking-widest text-gold-500 mb-4">Ноты аромата</h2>
                @foreach(['top' => '🌿 Верхние', 'heart' => '🌸 Сердечные', 'base' => '🪵 Базовые'] as $type => $label)
                @if($notes->has($type))
                <div class="mb-4">
                    <p class="text-xs text-dark-500 font-body mb-2">{{ $label }}</p>
                    <div class="grid grid-cols-2 gap-1.5">
                        @foreach($notes[$type] as $note)
                        <label class="flex items-center gap-2 cursor-pointer text-xs font-body text-dark-400 hover:text-dark-200">
                            <input type="checkbox" name="notes[]" value="{{ $note->id }}"
                                   {{ in_array($note->id, old('notes', $productNoteIds)) ? 'checked' : '' }}
                                   class="accent-gold-500">
                            {{ $note->icon }} {{ $note->name }}
                        </label>
                        @endforeach
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>

    <div class="flex gap-4">
        <button type="submit" class="btn-gold text-sm px-8 py-3">Сохранить</button>
        <a href="{{ route('admin.products.index') }}" class="btn-outline text-sm px-8 py-3">Отмена</a>
    </div>
</form>
@endsection
