<x-app-layout>
    <x-slot name="title">{{ $product->name }}</x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        {{-- Breadcrumbs --}}
        <nav class="flex items-center gap-2 text-xs font-body text-dark-500 mb-10">
            <a href="{{ route('home') }}" class="hover:text-gold-400 transition-colors">Главная</a>
            <span>/</span>
            <a href="{{ route('catalog') }}" class="hover:text-gold-400 transition-colors">Каталог</a>
            <span>/</span>
            <span class="text-dark-300">{{ $product->name }}</span>
        </nav>

        {{-- Product --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 xl:gap-20 mb-20">

            {{-- Image --}}
            <div class="lg:sticky lg:top-24 self-start">
                <div class="aspect-square bg-gradient-to-br from-dark-800 to-dark-900 border border-dark-800 overflow-hidden relative group">
                    @if($product->main_image && file_exists(storage_path('app/public/' . $product->main_image)))
                        <img src="{{ asset('storage/' . $product->main_image) }}"
                             alt="{{ $product->name }}"
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <div class="text-center">
                                <div class="text-8xl mb-4 animate-float">🌸</div>
                                <p class="text-xl text-dark-500 font-sans" style="font-family: 'Cormorant Garamond', serif;">{{ $product->brand }}</p>
                            </div>
                        </div>
                    @endif

                    {{-- Badges --}}
                    @if($product->is_new)
                    <div class="absolute top-4 right-4 px-3 py-1.5 bg-emerald-600 text-white text-xs font-body font-semibold uppercase tracking-wider">New</div>
                    @endif
                </div>

                {{-- Additional Images --}}
                @if($product->images->isNotEmpty())
                <div class="grid grid-cols-4 gap-2 mt-3">
                    @foreach($product->images as $img)
                    <div class="aspect-square bg-dark-800 border border-dark-700 overflow-hidden cursor-pointer hover:border-gold-500 transition-colors">
                        <img src="{{ asset('storage/' . $img->image) }}" alt="" class="w-full h-full object-cover">
                    </div>
                    @endforeach
                </div>
                @endif
            </div>

            {{-- Info --}}
            <div>
                <div class="mb-2">
                    <span class="section-subtitle">{{ $product->brand }}</span>
                </div>

                <h1 class="text-5xl md:text-6xl leading-none mb-4 text-dark-50"
                    style="font-family: 'Cormorant Garamond', serif;">
                    {{ $product->name }}
                </h1>

                <div class="flex flex-wrap items-center gap-4 mb-6">
                    {{-- Gender badge --}}
                    <span class="text-xs font-body px-3 py-1 border border-dark-700 text-dark-400 uppercase tracking-wider">
                        {{ match($product->gender) { 'male' => 'Мужской', 'female' => 'Женский', 'unisex' => 'Унисекс', default => $product->gender } }}
                    </span>
                    <span class="text-xs font-body px-3 py-1 border border-dark-700 text-dark-400">
                        {{ $product->volume_ml }} мл
                    </span>
                    @if($product->concentration)
                    <span class="text-xs font-body px-3 py-1 border border-dark-700 text-dark-400">
                        {{ $product->concentration }}
                    </span>
                    @endif
                    @if($product->country)
                    <span class="text-xs font-body text-dark-500">
                        {{ $product->country }}
                    </span>
                    @endif
                </div>

                {{-- Rating --}}
                @if($product->reviews_count > 0)
                <div class="flex items-center gap-3 mb-6">
                    <div class="star-rating">
                        @for($s = 1; $s <= 5; $s++)
                        <svg class="w-4 h-4 {{ $s <= round($product->rating) ? 'fill-current' : 'fill-current text-dark-700' }}" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        @endfor
                    </div>
                    <span class="text-sm text-gold-400 font-body font-semibold">{{ number_format($product->rating, 1) }}</span>
                    <span class="text-sm text-dark-500 font-body">({{ $product->reviews_count }} отзывов)</span>
                </div>
                @endif

                <p class="text-dark-300 font-body leading-relaxed text-lg mb-8">{{ $product->short_description }}</p>

                {{-- Price --}}
                <div class="flex items-baseline gap-4 mb-8">
                    <span class="text-4xl font-sans text-dark-50" style="font-family: 'Cormorant Garamond', serif;">
                        {{ number_format($product->price, 0, '.', ' ') }} ₽
                    </span>
                    @if($product->old_price)
                    <span class="text-xl text-dark-600 font-body line-through">
                        {{ number_format($product->old_price, 0, '.', ' ') }} ₽
                    </span>
                    @if($product->discount_percent)
                    <span class="px-2 py-1 bg-burgundy-600/30 text-burgundy-400 text-sm font-body font-semibold">
                        -{{ $product->discount_percent }}%
                    </span>
                    @endif
                    @endif
                </div>

                {{-- Stock --}}
                <div class="mb-8">
                    @if($product->stock > 10)
                    <p class="text-xs font-body text-emerald-400 flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 inline-block"></span>
                        В наличии
                    </p>
                    @elseif($product->stock > 0)
                    <p class="text-xs font-body text-gold-400 flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-gold-400 inline-block"></span>
                        Осталось: {{ $product->stock }} шт.
                    </p>
                    @else
                    <p class="text-xs font-body text-dark-500 flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-dark-600 inline-block"></span>
                        Нет в наличии
                    </p>
                    @endif
                </div>

                {{-- Actions --}}
                <div class="flex gap-3 mb-8" x-data="{ added: false }">
                    @if($product->stock > 0)
                    <form action="{{ route('cart.store', $product) }}" method="POST" class="flex-1"
                          @submit.prevent="
                            fetch('{{ route('cart.store', $product) }}', {
                                method: 'POST',
                                headers: {'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content, 'Accept': 'application/json'},
                                body: new FormData($el)
                            }).then(r => r.json()).then(d => {
                                if(d.success) {
                                    added = true;
                                    const cnt = document.getElementById('cart-count');
                                    if(cnt) cnt.textContent = d.cart_count;
                                }
                            }).catch(() => $el.submit())
                          ">
                        @csrf
                        <button type="submit"
                                class="w-full py-4 font-body font-semibold uppercase tracking-wider transition-all duration-300 text-sm"
                                :class="added ? 'bg-emerald-600 text-white' : 'bg-gold-500 text-dark-950 hover:bg-gold-400'">
                            <span x-show="!added">Добавить в корзину</span>
                            <span x-show="added" style="display:none;">✓ В корзине</span>
                        </button>
                    </form>
                    @else
                    <div class="flex-1 py-4 text-center text-sm font-body text-dark-500 border border-dark-700">Нет в наличии</div>
                    @endif

                    {{-- Favorite --}}
                    @auth
                    <form action="{{ route('favorites.toggle', $product) }}" method="POST"
                          @submit.prevent="
                            fetch('{{ route('favorites.toggle', $product) }}', {
                                method: 'POST',
                                headers: {'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content, 'Accept': 'application/json'},
                            }).then(r => r.json()).then(d => { fav = d.added });
                          "
                          x-data="{ fav: {{ $userFavorite ? 'true' : 'false' }} }">
                        @csrf
                        <button type="submit"
                                class="p-4 border transition-all duration-300"
                                :class="fav ? 'border-burgundy-500/60 bg-burgundy-500/10 text-burgundy-400' : 'border-dark-700 text-dark-400 hover:border-burgundy-500/40 hover:text-burgundy-400'">
                            <svg class="w-5 h-5" :fill="fav ? 'currentColor' : 'none'" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/>
                            </svg>
                        </button>
                    </form>
                    @endauth
                </div>

                {{-- Fragrance Pyramid --}}
                @if($notes->isNotEmpty())
                <div class="border border-dark-800 p-6 mb-8">
                    <h3 class="text-xs font-body uppercase tracking-widest text-gold-500 mb-5">Пирамида аромата</h3>

                    <div class="space-y-4">
                        @if(isset($notes['top']) && $notes['top']->isNotEmpty())
                        <div>
                            <p class="text-xs font-body text-dark-500 mb-2 uppercase tracking-wider">Верхние ноты</p>
                            <div class="flex flex-wrap gap-2">
                                @foreach($notes['top'] as $note)
                                <span class="note-pill">{{ $note->icon }} {{ $note->name }}</span>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        @if(isset($notes['heart']) && $notes['heart']->isNotEmpty())
                        <div>
                            <p class="text-xs font-body text-dark-500 mb-2 uppercase tracking-wider">Сердечные ноты</p>
                            <div class="flex flex-wrap gap-2">
                                @foreach($notes['heart'] as $note)
                                <span class="note-pill">{{ $note->icon }} {{ $note->name }}</span>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        @if(isset($notes['base']) && $notes['base']->isNotEmpty())
                        <div>
                            <p class="text-xs font-body text-dark-500 mb-2 uppercase tracking-wider">Базовые ноты</p>
                            <div class="flex flex-wrap gap-2">
                                @foreach($notes['base'] as $note)
                                <span class="note-pill">{{ $note->icon }} {{ $note->name }}</span>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>

        {{-- Description --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-20">
            <div>
                <h2 class="text-3xl font-sans text-dark-50 mb-6" style="font-family: 'Cormorant Garamond', serif;">Об аромате</h2>
                <div class="text-dark-300 font-body leading-relaxed space-y-4">
                    @foreach(explode("\n", $product->description) as $paragraph)
                    @if(trim($paragraph))
                    <p>{{ trim($paragraph) }}</p>
                    @endif
                    @endforeach
                </div>
            </div>

            <div class="lg:pl-8 lg:border-l border-dark-800">
                <h3 class="text-xs font-body uppercase tracking-widest text-gold-500 mb-6">Характеристики</h3>
                <dl class="space-y-4">
                    <div class="flex justify-between py-3 border-b border-dark-800">
                        <dt class="text-sm text-dark-500 font-body">Бренд</dt>
                        <dd class="text-sm text-dark-200 font-body font-medium">{{ $product->brand }}</dd>
                    </div>
                    <div class="flex justify-between py-3 border-b border-dark-800">
                        <dt class="text-sm text-dark-500 font-body">Концентрация</dt>
                        <dd class="text-sm text-dark-200 font-body font-medium">{{ $product->concentration ?? '—' }}</dd>
                    </div>
                    <div class="flex justify-between py-3 border-b border-dark-800">
                        <dt class="text-sm text-dark-500 font-body">Объём</dt>
                        <dd class="text-sm text-dark-200 font-body font-medium">{{ $product->volume_ml }} мл</dd>
                    </div>
                    <div class="flex justify-between py-3 border-b border-dark-800">
                        <dt class="text-sm text-dark-500 font-body">Пол</dt>
                        <dd class="text-sm text-dark-200 font-body font-medium">{{ match($product->gender) { 'male' => 'Мужской', 'female' => 'Женский', 'unisex' => 'Унисекс', default => $product->gender } }}</dd>
                    </div>
                    @if($product->country)
                    <div class="flex justify-between py-3 border-b border-dark-800">
                        <dt class="text-sm text-dark-500 font-body">Страна</dt>
                        <dd class="text-sm text-dark-200 font-body font-medium">{{ $product->country }}</dd>
                    </div>
                    @endif
                </dl>
            </div>
        </div>

        {{-- Reviews Section --}}
        <div class="mb-20">
            <div class="flex items-end justify-between mb-10">
                <div>
                    <p class="section-subtitle mb-2">Отзывы покупателей</p>
                    <h2 class="text-4xl font-sans text-dark-50" style="font-family: 'Cormorant Garamond', serif;">
                        {{ $product->reviews_count }} {{ trans_choice('отзыв|отзыва|отзывов', $product->reviews_count) }}
                    </h2>
                </div>
                @if($product->reviews_count > 0)
                <div class="text-right">
                    <p class="text-5xl font-sans text-gold-400" style="font-family: 'Cormorant Garamond', serif;">{{ number_format($product->rating, 1) }}</p>
                    <div class="star-rating justify-end mt-1">
                        @for($s = 1; $s <= 5; $s++)
                        <svg class="w-4 h-4 {{ $s <= round($product->rating) ? 'fill-current' : 'fill-current text-dark-700' }}" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        @endfor
                    </div>
                </div>
                @endif
            </div>

            {{-- Add Review Form --}}
            @auth
            @if(!$userReview)
            <div class="glass-card p-6 mb-10" x-data="{ rating: 0, hovered: 0 }">
                <h3 class="text-lg font-sans text-dark-100 mb-5" style="font-family: 'Cormorant Garamond', serif;">Оставить отзыв</h3>
                <form action="{{ route('review.store', $product) }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="label-dark">Оценка</label>
                        <div class="flex gap-2">
                            @for($s = 1; $s <= 5; $s++)
                            <button type="button"
                                    @click="rating = {{ $s }}"
                                    @mouseenter="hovered = {{ $s }}"
                                    @mouseleave="hovered = 0"
                                    class="text-2xl transition-transform hover:scale-110">
                                <span :class="(hovered || rating) >= {{ $s }} ? 'text-gold-400' : 'text-dark-700'">★</span>
                            </button>
                            @endfor
                            <input type="hidden" name="rating" :value="rating">
                        </div>
                        @error('rating')<p class="text-xs text-red-400 mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="label-dark">Заголовок (необязательно)</label>
                        <input type="text" name="title" value="{{ old('title') }}" class="input-dark" placeholder="Кратко о впечатлении">
                    </div>
                    <div>
                        <label class="label-dark">Отзыв</label>
                        <textarea name="body" rows="4" class="input-dark resize-none" placeholder="Расскажите о вашем впечатлении от аромата...">{{ old('body') }}</textarea>
                        @error('body')<p class="text-xs text-red-400 mt-1">{{ $message }}</p>@enderror
                    </div>
                    <button type="submit" class="btn-gold">Опубликовать отзыв</button>
                </form>
            </div>
            @else
            <div class="glass-card p-5 mb-10 flex items-center gap-3">
                <svg class="w-5 h-5 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-sm text-dark-300 font-body">Вы уже оставили отзыв на этот товар.</p>
            </div>
            @endif
            @else
            <div class="glass-card p-5 mb-10 flex items-center gap-4">
                <p class="text-sm text-dark-400 font-body">
                    <a href="{{ route('login') }}" class="text-gold-400 hover:text-gold-300 underline">Войдите</a>, чтобы оставить отзыв.
                </p>
            </div>
            @endauth

            {{-- Reviews List --}}
            @if($reviews->isNotEmpty())
            <div class="space-y-6">
                @foreach($reviews as $review)
                <div class="glass-card p-6">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-full bg-gold-500/10 border border-gold-500/20 flex items-center justify-center shrink-0">
                            <span class="text-gold-500 font-semibold font-body">{{ mb_strtoupper(mb_substr($review->user->name, 0, 1)) }}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center flex-wrap gap-3 mb-2">
                                <p class="text-sm font-body font-medium text-dark-200">{{ $review->user->name }}</p>
                                <div class="star-rating">
                                    @for($s = 1; $s <= 5; $s++)
                                    <svg class="w-3.5 h-3.5 {{ $s <= $review->rating ? 'fill-current' : 'fill-current text-dark-700' }}" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                    @endfor
                                </div>
                                <span class="text-xs text-dark-600 font-body">{{ $review->created_at->format('d.m.Y') }}</span>
                            </div>
                            @if($review->title)
                            <h4 class="font-sans text-dark-100 text-lg mb-2" style="font-family: 'Cormorant Garamond', serif;">{{ $review->title }}</h4>
                            @endif
                            <p class="text-dark-400 text-sm font-body leading-relaxed">{{ $review->body }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            @if($reviews->hasPages())
            <div class="mt-8">{{ $reviews->links('pagination.custom') }}</div>
            @endif
            @else
            <p class="text-center text-dark-500 font-body py-12">Пока нет отзывов. Будьте первым!</p>
            @endif
        </div>

        {{-- Related Products --}}
        @if($related->isNotEmpty())
        <div>
            <div class="text-center mb-12">
                <p class="section-subtitle mb-3">Похожие ароматы</p>
                <h2 class="section-title">Вам может понравиться</h2>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
                @foreach($related as $relProduct)
                @include('components.product-card', ['product' => $relProduct])
                @endforeach
            </div>
        </div>
        @endif
    </div>
</x-app-layout>
