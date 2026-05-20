<x-guest-layout>

    @if(session('status'))
    <div class="mb-8 px-4 py-3 border-l-2 border-emerald-500 bg-emerald-500/5 text-emerald-400 text-xs font-body tracking-wide">
        {{ session('status') }}
    </div>
    @endif

    {{-- Heading --}}
    <div class="mb-12">
        <p class="text-xs text-dark-600 font-body uppercase tracking-[0.25em] mb-3">Добро пожаловать</p>
        <h1 class="text-dark-50 leading-none" style="font-family: 'Cormorant Garamond', serif; font-size: 2.75rem; font-weight: 300;">
            Вход
        </h1>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        {{-- Fields --}}
        <div class="space-y-8 mb-10">

            <div class="auth-field">
                <input id="email" type="email" name="email" value="{{ old('email') }}"
                       class="auth-input" placeholder=" " required autofocus autocomplete="email">
                <label for="email" class="auth-label">Email</label>
                @error('email')
                    <p class="text-xs text-red-400/80 mt-2 font-body">{{ $message }}</p>
                @enderror
            </div>

            <div class="auth-field">
                <input id="password" type="password" name="password"
                       class="auth-input" placeholder=" " required autocomplete="current-password">
                <label for="password" class="auth-label">Пароль</label>
                @error('password')
                    <p class="text-xs text-red-400/80 mt-2 font-body">{{ $message }}</p>
                @enderror
            </div>

        </div>

        {{-- Remember + Forgot --}}
        <div class="flex items-center justify-between mb-10">
            <label class="flex items-center gap-2.5 cursor-pointer group">
                <div class="relative shrink-0">
                    <input type="checkbox" name="remember" id="remember" class="peer sr-only">
                    <div class="w-4 h-4 border border-dark-700 peer-checked:border-gold-500/60 transition-colors duration-200"
                         style="background: transparent;"></div>
                    <svg class="absolute inset-0 w-4 h-4 text-gold-400 opacity-0 peer-checked:opacity-100 transition-opacity duration-200 pointer-events-none"
                         fill="none" viewBox="0 0 16 16">
                        <path stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                              d="M3 8.5l3 3 5.5-6"/>
                    </svg>
                </div>
                <span class="text-xs text-dark-600 uppercase tracking-[0.15em] font-body group-hover:text-dark-400 transition-colors">
                    Запомнить
                </span>
            </label>

            @if(Route::has('password.request'))
            <a href="{{ route('password.request') }}"
               class="text-xs text-dark-600 uppercase tracking-[0.15em] font-body hover:text-gold-500 transition-colors duration-200">
                Забыли пароль?
            </a>
            @endif
        </div>

        {{-- Submit --}}
        <button type="submit"
                class="w-full py-4 text-xs font-body font-semibold uppercase tracking-[0.25em]
                       bg-gold-500 text-dark-950 transition-all duration-300
                       hover:bg-gold-400 hover:shadow-[0_8px_30px_rgba(212,149,23,0.25)]
                       focus:outline-none focus:ring-1 focus:ring-gold-400/40 mb-8">
            Войти
        </button>

        {{-- Register link --}}
        <p class="text-center text-xs font-body text-dark-700 uppercase tracking-[0.15em]">
            Нет аккаунта?&ensp;
            <a href="{{ route('register') }}" class="text-gold-500/80 hover:text-gold-400 transition-colors duration-200">
                Зарегистрироваться
            </a>
        </p>

    </form>

</x-guest-layout>
