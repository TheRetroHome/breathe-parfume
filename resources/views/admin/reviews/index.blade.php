@extends('layouts.admin')
@section('title', 'Отзывы')

@section('content')
<div class="mb-6">
    <p class="text-dark-400 font-body text-sm">Всего: {{ $reviews->total() }}</p>
</div>

<div class="space-y-4">
    @foreach($reviews as $review)
    <div class="glass-card p-5 flex gap-4">
        <div class="flex-1 min-w-0">
            <div class="flex items-center flex-wrap gap-3 mb-2">
                <p class="text-sm font-body font-medium text-dark-200">{{ $review->user->name }}</p>
                <a href="{{ route('product.show', $review->product->slug) }}" class="text-xs text-dark-500 hover:text-gold-400 transition-colors font-body" target="_blank">{{ $review->product->name }}</a>
                <div class="star-rating">
                    @for($s = 1; $s <= 5; $s++)
                    <svg class="w-3.5 h-3.5 {{ $s <= $review->rating ? 'fill-current' : 'fill-current text-dark-700' }}" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    @endfor
                </div>
                <span class="{{ $review->is_approved ? 'text-emerald-400 border-emerald-600/30' : 'text-gold-400 border-gold-600/30' }} text-xs px-2 py-0.5 border font-body">
                    {{ $review->is_approved ? 'Одобрен' : 'На модерации' }}
                </span>
            </div>
            @if($review->title)
            <p class="font-sans text-dark-100 mb-1" style="font-family: 'Cormorant Garamond', serif;">{{ $review->title }}</p>
            @endif
            <p class="text-sm text-dark-400 font-body leading-relaxed">{{ $review->body }}</p>
            <p class="text-xs text-dark-600 font-body mt-2">{{ $review->created_at->format('d.m.Y H:i') }}</p>
        </div>

        <div class="flex flex-col gap-2 shrink-0">
            <form action="{{ route('admin.reviews.approve', $review) }}" method="POST">
                @csrf @method('PATCH')
                <button type="submit" class="text-xs font-body px-3 py-1.5 border transition-colors {{ $review->is_approved ? 'border-dark-600 text-dark-400 hover:border-gold-500/40' : 'border-emerald-600/40 text-emerald-400 hover:border-emerald-500' }}">
                    {{ $review->is_approved ? 'Скрыть' : 'Одобрить' }}
                </button>
            </form>
            <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST"
                  onsubmit="return confirm('Удалить отзыв?')">
                @csrf @method('DELETE')
                <button type="submit" class="text-xs font-body px-3 py-1.5 border border-dark-700 text-dark-500 hover:border-red-500/40 hover:text-red-400 transition-colors w-full">
                    Удалить
                </button>
            </form>
        </div>
    </div>
    @endforeach
</div>

@if($reviews->hasPages())
<div class="mt-6">{{ $reviews->links('pagination.custom') }}</div>
@endif
@endsection
