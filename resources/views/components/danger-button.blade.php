<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-6 py-3 bg-transparent border border-red-800 text-red-400 font-body font-semibold text-xs uppercase tracking-widest hover:bg-red-900/20 hover:border-red-600 focus:outline-none transition-colors duration-200']) }}>
    {{ $slot }}
</button>
