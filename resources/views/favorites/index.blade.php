<x-app-layout>
    <x-slot name="title">Избранное</x-slot>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="mb-10">
            <p class="section-subtitle mb-2">Сохранённые ароматы</p>
            <h1 class="section-title">Избранное</h1>
        </div>

        @if($products->isEmpty())
        <div class="text-center py-24">
            <div class="text-6xl mb-6">💜</div>
            <h2 class="text-3xl font-sans text-dark-300 mb-3" style="font-family: 'Cormorant Garamond', serif;">Список пуст</h2>
            <p class="text-dark-500 font-body mb-8">Сохраняйте понравившиеся ароматы, нажимая на ♡</p>
            <a href="{{ route('catalog') }}" class="btn-gold">Исследовать каталог</a>
        </div>
        @else
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
            @foreach($products as $product)
            @include('components.product-card', ['product' => $product])
            @endforeach
        </div>
        @endif
    </div>
</x-app-layout>
