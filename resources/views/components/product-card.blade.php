@props(['product', 'compact' => false])

<div class="card-product group {{ $compact ? 'p-3' : 'p-4' }}" x-data="{ added: false }">
    {{-- Badges --}}
    @if($product->is_new)
        <span class="badge-new">New</span>
    @endif
    @if($product->old_price && $product->discount_percent)
        <span class="badge-sale">-{{ $product->discount_percent }}%</span>
    @endif

    {{-- Product Image --}}
    <a href="{{ route('product.show', $product->slug) }}" class="block overflow-hidden mb-4">
        <div class="{{ $compact ? 'aspect-[3/4]' : 'aspect-[3/4]' }} bg-dark-800 relative overflow-hidden">
            @if($product->main_image && file_exists(storage_path('app/public/' . $product->main_image)))
                <img src="{{ asset('storage/' . $product->main_image) }}"
                     alt="{{ $product->name }}"
                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
            @else
                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-dark-800 to-dark-900">
                    <div class="text-center">
                        <div class="text-5xl mb-2">🌸</div>
                        <p class="text-xs text-dark-600 font-body">{{ $product->brand }}</p>
                    </div>
                </div>
            @endif

            {{-- Hover Overlay --}}
            <div class="absolute inset-0 overlay-dark opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end p-4">
                <div class="w-full">
                    {{-- Notes preview --}}
                    @if(!$compact && $product->notes->isNotEmpty())
                    <div class="mb-3 flex flex-wrap gap-1">
                        @foreach($product->notes->take(3) as $note)
                        <span class="text-xs px-2 py-1 bg-dark-900/80 text-dark-300 border border-dark-700/60">
                            {{ $note->icon }} {{ $note->name }}
                        </span>
                        @endforeach
                    </div>
                    @endif

                    <form action="{{ route('cart.store', $product) }}" method="POST" @submit.prevent="
                        fetch('{{ route('cart.store', $product) }}', {
                            method: 'POST',
                            headers: {'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content, 'Accept': 'application/json'},
                            body: new FormData($el)
                        }).then(r => r.json()).then(d => {
                            if(d.success) {
                                added = true;
                                const cnt = document.getElementById('cart-count');
                                if(cnt) cnt.textContent = d.cart_count;
                                setTimeout(() => added = false, 2000);
                            }
                        }).catch(() => $el.submit())
                    ">
                        @csrf
                        <button type="submit"
                                class="w-full py-2.5 text-xs font-body font-semibold uppercase tracking-wider transition-all duration-300"
                                :class="added ? 'bg-emerald-600 text-white' : 'bg-gold-500 text-dark-950 hover:bg-gold-400'">
                            <span x-show="!added">В корзину</span>
                            <span x-show="added" style="display:none;">✓ Добавлено</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </a>

    {{-- Info --}}
    <div>
        <p class="text-xs font-body text-dark-500 uppercase tracking-widest mb-1">{{ $product->brand }}</p>
        <a href="{{ route('product.show', $product->slug) }}"
           class="block text-dark-100 font-sans leading-tight mb-2 hover:text-gold-400 transition-colors {{ $compact ? 'text-sm' : 'text-base' }}"
           style="font-family: 'Cormorant Garamond', serif;">
            {{ $product->name }}
        </a>

        @if(!$compact)
        <p class="text-xs text-dark-500 font-body mb-2">{{ $product->volume_ml }} мл · {{ $product->concentration }}</p>

        {{-- Rating --}}
        @if($product->reviews_count > 0)
        <div class="flex items-center gap-1.5 mb-3">
            <div class="flex items-center gap-0.5 text-gold-400">
                @for($s = 1; $s <= 5; $s++)
                <svg class="w-3 h-3 {{ $s <= round($product->rating) ? 'fill-current' : 'fill-current text-dark-700' }}" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
                @endfor
            </div>
            <span class="text-xs text-dark-500 font-body">({{ $product->reviews_count }})</span>
        </div>
        @endif
        @endif

        {{-- Price --}}
        <div class="flex items-baseline gap-2 flex-wrap">
            <span class="font-body font-semibold text-dark-50 {{ $compact ? 'text-sm' : 'text-base' }}">
                {{ number_format($product->price, 0, '.', ' ') }} ₽
            </span>
            @if($product->old_price)
            <span class="text-xs text-dark-600 font-body line-through">
                {{ number_format($product->old_price, 0, '.', ' ') }} ₽
            </span>
            @endif
        </div>
    </div>
</div>
