<x-guest-layout>

    @if(session('status') == 'verification-link-sent')
    <div class="mb-8 px-4 py-3 border-l-2 border-emerald-500 bg-emerald-500/5 text-emerald-400 text-xs font-body tracking-wide">
        Новая ссылка отправлена на ваш email.
    </div>
    @endif

    <div class="mb-12">
        <p class="text-xs text-dark-600 font-body uppercase tracking-[0.25em] mb-3">Последний шаг</p>
        <h1 class="text-dark-50 leading-none mb-4" style="font-family: 'Cormorant Garamond', serif; font-size: 2.75rem; font-weight: 300;">
            Подтвердите email
        </h1>
        <p class="text-sm text-dark-600 font-body leading-relaxed">
            Мы отправили письмо со ссылкой для подтверждения. Перейдите по ней, чтобы завершить регистрацию.
        </p>
    </div>

    <div class="space-y-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit"
                    class="w-full py-4 text-xs font-body font-semibold uppercase tracking-[0.25em]
                           bg-gold-500 text-dark-950 transition-all duration-300
                           hover:bg-gold-400 hover:shadow-[0_8px_30px_rgba(212,149,23,0.25)]
                           focus:outline-none focus:ring-1 focus:ring-gold-400/40">
                Отправить повторно
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    class="w-full py-4 text-xs font-body font-medium uppercase tracking-[0.25em]
                           border border-dark-800 text-dark-600 transition-all duration-300
                           hover:border-dark-600 hover:text-dark-400
                           focus:outline-none">
                Выйти
            </button>
        </form>
    </div>

</x-guest-layout>
