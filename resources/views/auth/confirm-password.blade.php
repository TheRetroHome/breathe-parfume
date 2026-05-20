<x-guest-layout>

    <div class="mb-12">
        <p class="text-xs text-dark-600 font-body uppercase tracking-[0.25em] mb-3">Защищённая зона</p>
        <h1 class="text-dark-50 leading-none mb-4" style="font-family: 'Cormorant Garamond', serif; font-size: 2.75rem; font-weight: 300;">
            Подтверждение
        </h1>
        <p class="text-sm text-dark-600 font-body leading-relaxed">
            Введите пароль для продолжения.
        </p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="space-y-8 mb-10">
            <div class="auth-field">
                <input id="password" type="password" name="password"
                       class="auth-input" placeholder=" " required autocomplete="current-password">
                <label for="password" class="auth-label">Пароль</label>
                @error('password')
                    <p class="text-xs text-red-400/80 mt-2 font-body">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <button type="submit"
                class="w-full py-4 text-xs font-body font-semibold uppercase tracking-[0.25em]
                       bg-gold-500 text-dark-950 transition-all duration-300
                       hover:bg-gold-400 hover:shadow-[0_8px_30px_rgba(212,149,23,0.25)]
                       focus:outline-none focus:ring-1 focus:ring-gold-400/40">
            Подтвердить
        </button>
    </form>

</x-guest-layout>
