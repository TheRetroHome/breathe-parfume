<x-app-layout>
    <x-slot name="title">Каталог ароматов</x-slot>

    {{-- Page Header --}}
    <div class="py-16 bg-dark-900/40 border-b border-dark-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="section-subtitle mb-3">Наша коллекция</p>
            <h1 class="section-title">
                @if(request('q'))
                    Поиск: «{{ request('q') }}»
                @elseif(request('gender') === 'male')
                    Мужские ароматы
                @elseif(request('gender') === 'female')
                    Женские ароматы
                @elseif(request('gender') === 'unisex')
                    Унисекс ароматы
                @else
                    Все ароматы
                @endif
            </h1>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex flex-col lg:flex-row gap-8">

            {{-- Sidebar Filters --}}
            <aside class="lg:w-72 shrink-0" x-data="{ filtersOpen: false }">
                {{-- Mobile Filter Toggle --}}
                <button @click="filtersOpen = !filtersOpen"
                        class="lg:hidden w-full flex items-center justify-between px-5 py-3 bg-dark-900 border border-dark-700 text-dark-200 text-sm mb-4">
                    <span>Фильтры</span>
                    <svg class="w-4 h-4 transition-transform" :class="filtersOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <form method="GET" action="{{ route('catalog') }}"
                      class="space-y-6"
                      :class="{ 'hidden': !filtersOpen }"
                      x-bind:class="{ 'hidden lg:block': !filtersOpen, 'block': filtersOpen }">

                    {{-- Hidden fields to preserve other filters --}}
                    @if(request('q'))
                    <input type="hidden" name="q" value="{{ request('q') }}">
                    @endif

                    {{-- Gender --}}
                    <div class="bg-dark-900 border border-dark-800 p-5">
                        <h3 class="text-xs font-body uppercase tracking-widest text-gold-500 mb-4">Пол</h3>
                        <div class="space-y-2">
                            @foreach(['male' => 'Мужские', 'female' => 'Женские', 'unisex' => 'Унисекс'] as $val => $label)
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <div class="relative">
                                    <input type="checkbox" name="gender[]" value="{{ $val }}"
                                           {{ in_array($val, (array) request('gender', [])) ? 'checked' : '' }}
                                           class="sr-only peer">
                                    <div class="w-4 h-4 border border-dark-600 peer-checked:border-gold-500 peer-checked:bg-gold-500/20 transition-colors"></div>
                                    <div class="absolute inset-0.5 hidden peer-checked:flex items-center justify-center">
                                        <svg class="w-2.5 h-2.5 text-gold-400" fill="currentColor" viewBox="0 0 12 12">
                                            <path d="M10.293 3.293a1 1 0 011.414 1.414l-6 6a1 1 0 01-1.414 0l-3-3a1 1 0 011.414-1.414L5 8.586l5.293-5.293z"/>
                                        </svg>
                                    </div>
                                </div>
                                <span class="text-sm text-dark-300 group-hover:text-dark-100 transition-colors font-body">{{ $label }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Fragrance Notes --}}
                    <div class="bg-dark-900 border border-dark-800 p-5">
                        <h3 class="text-xs font-body uppercase tracking-widest text-gold-500 mb-4">Ноты аромата</h3>

                        @foreach(['top' => '🌿 Верхние', 'heart' => '🌸 Сердечные', 'base' => '🪵 Базовые'] as $type => $label)
                        @if($notes->has($type))
                        <div class="mb-4">
                            <p class="text-xs text-dark-500 mb-2 font-body">{{ $label }}</p>
                            <div class="space-y-1.5">
                                @foreach($notes[$type] as $note)
                                <label class="flex items-center gap-2.5 cursor-pointer group">
                                    <div class="relative shrink-0">
                                        <input type="checkbox" name="notes[]" value="{{ $note->id }}"
                                               {{ in_array($note->id, (array) request('notes', [])) ? 'checked' : '' }}
                                               class="sr-only peer">
                                        <div class="w-3.5 h-3.5 border border-dark-600 peer-checked:border-gold-500 peer-checked:bg-gold-500/20 transition-colors"></div>
                                        <div class="absolute inset-0.5 hidden peer-checked:flex items-center justify-center">
                                            <div class="w-1.5 h-1.5 bg-gold-400 rounded-full"></div>
                                        </div>
                                    </div>
                                    <span class="text-xs text-dark-400 group-hover:text-dark-200 transition-colors font-body">
                                        {{ $note->icon }} {{ $note->name }}
                                    </span>
                                </label>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>

                    {{-- Price Range --}}
                    <div class="bg-dark-900 border border-dark-800 p-5">
                        <h3 class="text-xs font-body uppercase tracking-widest text-gold-500 mb-4">Цена, ₽</h3>
                        <div class="flex gap-3">
                            <input type="number" name="price_min" value="{{ request('price_min') }}"
                                   placeholder="От" class="input-dark text-center text-sm w-1/2">
                            <input type="number" name="price_max" value="{{ request('price_max') }}"
                                   placeholder="До" class="input-dark text-center text-sm w-1/2">
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="flex gap-3">
                        <button type="submit" class="btn-gold flex-1 text-sm py-3">Применить</button>
                        <a href="{{ route('catalog') }}" class="btn-outline text-sm py-3 px-4">×</a>
                    </div>
                </form>
            </aside>

            {{-- Products Grid --}}
            <div class="flex-1 min-w-0">
                {{-- Toolbar --}}
                <div class="flex items-center justify-between mb-8 pb-4 border-b border-dark-800">
                    <p class="text-sm text-dark-500 font-body">
                        Найдено: <span class="text-dark-200">{{ $products->total() }}</span> ароматов
                    </p>

                    <div class="flex items-center gap-3">
                        <label class="text-xs text-dark-500 font-body uppercase tracking-wider">Сортировка:</label>
                        <select name="sort" onchange="this.form ? this.form.submit() : (window.location.href = '{{ route('catalog') }}?' + new URLSearchParams({...Object.fromEntries(new URLSearchParams(window.location.search)), sort: this.value}))"
                                class="bg-dark-900 border border-dark-700 text-dark-200 text-sm px-3 py-2 focus:outline-none focus:border-gold-500">
                            <option value="newest" {{ request('sort', 'newest') === 'newest' ? 'selected' : '' }}>Новинки</option>
                            <option value="popular" {{ request('sort') === 'popular' ? 'selected' : '' }}>Популярные</option>
                            <option value="rating" {{ request('sort') === 'rating' ? 'selected' : '' }}>По рейтингу</option>
                            <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>Цена ↑</option>
                            <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Цена ↓</option>
                        </select>
                    </div>
                </div>

                @if($products->isEmpty())
                <div class="text-center py-24">
                    <p class="text-4xl mb-4">🌸</p>
                    <h3 class="text-2xl font-sans text-dark-300 mb-3" style="font-family: 'Cormorant Garamond', serif;">Ничего не найдено</h3>
                    <p class="text-dark-500 font-body mb-8">Попробуйте изменить фильтры или поисковый запрос</p>
                    <a href="{{ route('catalog') }}" class="btn-outline">Сбросить фильтры</a>
                </div>
                @else
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-6">
                    @foreach($products as $product)
                    <div>
                        @include('components.product-card', ['product' => $product])
                    </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                @if($products->hasPages())
                <div class="mt-12">
                    {{ $products->links('pagination.custom') }}
                </div>
                @endif
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
