<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-6 py-3 bg-transparent border border-dark-700 text-dark-300 font-body font-semibold text-xs uppercase tracking-widest hover:border-dark-500 hover:text-dark-100 focus:outline-none transition-colors duration-200']) }}>
    {{ $slot }}
</button>
