<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-6 py-3 bg-gold-500 text-dark-950 font-body font-semibold text-xs uppercase tracking-widest hover:bg-gold-400 focus:outline-none transition-colors duration-200']) }}>
    {{ $slot }}
</button>
