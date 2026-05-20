<x-guest-layout>

    @if(session('status'))
    <div class="mb-8 px-4 py-3 border-l-2 border-emerald-500 bg-emerald-500/5 text-emerald-400 text-xs font-body tracking-wide">
        {{ session('status') }}
    </div>
    @endif

    <div class="mb-12">
        <p class="text-xs text-dark-600 font-body uppercase tracking-[0.25em] mb-3">Восстановление</p>
        <h1 class="text-dark-50 leading-none mb-4" style="font-family: 'Cormorant Garamond', serif; font-size: 2.75rem; font-weight: 300;">
            Забыли пароль?
        </h1>
        <p class="text-sm text-dark-600 font-body leading-relaxed">
            Введите ваш email — мы пришлём ссылку для сброса.
        </p>
    </div>

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="space-y-8 mb-10">
            <div class="auth-field">
                <input id="email" type="email" name="email" value="{{ old('email') }}"
                       class="auth-input" placeholder=" " required autofocus>
                <label for="email" class="auth-label">Email</label>
                @error('email')
                    <p class="text-xs text-red-400/80 mt-2 font-body">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <button type="submit"
                class="w-full py-4 text-xs font-body font-semibold uppercase tracking-[0.25em]
                       bg-gold-500 text-dark-950 transition-all duration-300
                       hover:bg-gold-400 hover:shadow-[0_8px_30px_rgba(212,149,23,0.25)]
                       focus:outline-none focus:ring-1 focus:ring-gold-400/40 mb-8">
            Отправить ссылку
        </button>

        <p class="text-center text-xs font-body text-dark-700 uppercase tracking-[0.15em]">
            <a href="{{ route('login') }}" class="text-gold-500/80 hover:text-gold-400 transition-colors duration-200">
                ← Вернуться к входу
            </a>
        </p>
    </form>

</x-guest-layout>
