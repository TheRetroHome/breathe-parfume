@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full bg-dark-950 border border-dark-700 text-dark-100 text-sm font-body px-4 py-3 focus:border-gold-500/60 focus:outline-none focus:ring-0 transition-colors duration-200 placeholder-dark-600']) }}>
