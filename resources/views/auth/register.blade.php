<x-guest-layout>

    {{-- Heading --}}
    <div class="mb-12">
        <p class="text-xs text-dark-600 font-body uppercase tracking-[0.25em] mb-3">Присоединяйтесь</p>
        <h1 class="text-dark-50 leading-none" style="font-family: 'Cormorant Garamond', serif; font-size: 2.75rem; font-weight: 300;">
            Регистрация
        </h1>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        {{-- Fields --}}
        <div class="space-y-8 mb-10">

            <div class="auth-field">
                <input id="name" type="text" name="name" value="{{ old('name') }}"
                       class="auth-input" placeholder=" " required autofocus autocomplete="name">
                <label for="name" class="auth-label">Ваше имя</label>
                @error('name')
                    <p class="text-xs text-red-400/80 mt-2 font-body">{{ $message }}</p>
                @enderror
            </div>

            <div class="auth-field">
                <input id="email" type="email" name="email" value="{{ old('email') }}"
                       class="auth-input" placeholder=" " required autocomplete="username">
                <label for="email" class="auth-label">Email</label>
                @error('email')
                    <p class="text-xs text-red-400/80 mt-2 font-body">{{ $message }}</p>
                @enderror
            </div>

            <div class="auth-field">
                <input id="password" type="password" name="password"
                       class="auth-input" placeholder=" " required autocomplete="new-password">
                <label for="password" class="auth-label">Пароль</label>
                @error('password')
                    <p class="text-xs text-red-400/80 mt-2 font-body">{{ $message }}</p>
                @enderror
            </div>

            <div class="auth-field">
                <input id="password_confirmation" type="password" name="password_confirmation"
                       class="auth-input" placeholder=" " required autocomplete="new-password">
                <label for="password_confirmation" class="auth-label">Подтвердите пароль</label>
                @error('password_confirmation')
                    <p class="text-xs text-red-400/80 mt-2 font-body">{{ $message }}</p>
                @enderror
            </div>

        </div>

        {{-- Submit --}}
        <button type="submit"
                class="w-full py-4 text-xs font-body font-semibold uppercase tracking-[0.25em]
                       bg-gold-500 text-dark-950 transition-all duration-300
                       hover:bg-gold-400 hover:shadow-[0_8px_30px_rgba(212,149,23,0.25)]
                       focus:outline-none focus:ring-1 focus:ring-gold-400/40 mb-8">
            Создать аккаунт
        </button>

        {{-- Login link --}}
        <p class="text-center text-xs font-body text-dark-700 uppercase tracking-[0.15em]">
            Уже есть аккаунт?&ensp;
            <a href="{{ route('login') }}" class="text-gold-500/80 hover:text-gold-400 transition-colors duration-200">
                Войти
            </a>
        </p>

    </form>

</x-guest-layout>
