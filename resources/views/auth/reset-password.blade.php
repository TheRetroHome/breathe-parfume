<x-guest-layout>

    <div class="mb-12">
        <p class="text-xs text-dark-600 font-body uppercase tracking-[0.25em] mb-3">Новый пароль</p>
        <h1 class="text-dark-50 leading-none" style="font-family: 'Cormorant Garamond', serif; font-size: 2.75rem; font-weight: 300;">
            Сброс пароля
        </h1>
    </div>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="space-y-8 mb-10">

            <div class="auth-field">
                <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}"
                       class="auth-input" placeholder=" " required autofocus autocomplete="username">
                <label for="email" class="auth-label">Email</label>
                @error('email')
                    <p class="text-xs text-red-400/80 mt-2 font-body">{{ $message }}</p>
                @enderror
            </div>

            <div class="auth-field">
                <input id="password" type="password" name="password"
                       class="auth-input" placeholder=" " required autocomplete="new-password">
                <label for="password" class="auth-label">Новый пароль</label>
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

        <button type="submit"
                class="w-full py-4 text-xs font-body font-semibold uppercase tracking-[0.25em]
                       bg-gold-500 text-dark-950 transition-all duration-300
                       hover:bg-gold-400 hover:shadow-[0_8px_30px_rgba(212,149,23,0.25)]
                       focus:outline-none focus:ring-1 focus:ring-gold-400/40">
            Сохранить пароль
        </button>
    </form>

</x-guest-layout>
