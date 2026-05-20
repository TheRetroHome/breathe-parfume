<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Breathe Parfume</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .auth-field { position: relative; }

        .auth-input {
            width: 100%;
            background: transparent;
            border: none;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            padding: 24px 0 10px 0;
            color: #f0ede4;
            font-size: 0.9375rem;
            font-family: 'Inter', sans-serif;
            outline: none;
            transition: border-color 0.35s ease;
            line-height: 1;
        }
        .auth-input:focus {
            border-bottom-color: #d49517;
        }
        .auth-input::placeholder { color: transparent; }

        .auth-label {
            position: absolute;
            top: 24px;
            left: 0;
            color: #55544a;
            font-size: 0.6875rem;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            transition: all 0.25s ease;
            pointer-events: none;
            font-family: 'Inter', sans-serif;
            font-weight: 500;
        }
        .auth-input:focus ~ .auth-label,
        .auth-input:not(:placeholder-shown) ~ .auth-label {
            top: 5px;
            font-size: 0.5625rem;
            color: #d49517;
            letter-spacing: 0.25em;
        }
        .auth-input:-webkit-autofill ~ .auth-label {
            top: 5px;
            font-size: 0.5625rem;
            color: #d49517;
        }
        .auth-input:-webkit-autofill,
        .auth-input:-webkit-autofill:hover,
        .auth-input:-webkit-autofill:focus {
            -webkit-box-shadow: 0 0 0 100px #0a0a07 inset;
            -webkit-text-fill-color: #f0ede4;
            caret-color: #f0ede4;
            border-bottom-color: #d49517;
        }

        .auth-divider {
            width: 32px;
            height: 1px;
            background: linear-gradient(90deg, #d49517, #b07211);
            margin-bottom: 2rem;
        }

        @keyframes float-slow {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-20px) scale(1.05); }
        }
        @keyframes float-slow2 {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(16px) scale(0.97); }
        }
        .orb-1 { animation: float-slow 12s ease-in-out infinite; }
        .orb-2 { animation: float-slow2 15s ease-in-out infinite; }
        .orb-3 { animation: float-slow 18s ease-in-out infinite reverse; }
    </style>
</head>
<body class="bg-dark-950 text-dark-100 font-body antialiased">

<div class="min-h-screen flex">

    {{-- ===== LEFT PANEL ===== --}}
    <div class="hidden lg:flex lg:w-[46%] xl:w-[42%] relative overflow-hidden flex-col justify-between"
         style="background: #070705; padding: 3.5rem;">

        {{-- Decorative orbs --}}
        <div class="orb-1 absolute pointer-events-none rounded-full"
             style="width: 500px; height: 500px; bottom: -100px; right: -150px;
                    background: radial-gradient(circle, rgba(212,149,23,0.18) 0%, transparent 70%);
                    filter: blur(60px);"></div>
        <div class="orb-2 absolute pointer-events-none rounded-full"
             style="width: 300px; height: 300px; top: -60px; left: -60px;
                    background: radial-gradient(circle, rgba(131,111,217,0.12) 0%, transparent 70%);
                    filter: blur(50px);"></div>
        <div class="orb-3 absolute pointer-events-none rounded-full"
             style="width: 200px; height: 200px; top: 45%; left: 30%;
                    background: radial-gradient(circle, rgba(212,149,23,0.08) 0%, transparent 70%);
                    filter: blur(40px);"></div>

        {{-- Subtle grid texture --}}
        <div class="absolute inset-0 pointer-events-none"
             style="background-image: linear-gradient(rgba(255,255,255,0.025) 1px, transparent 1px),
                                      linear-gradient(90deg, rgba(255,255,255,0.025) 1px, transparent 1px);
                    background-size: 48px 48px;"></div>

        {{-- Top: Logo --}}
        <div class="relative z-10">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-3 group">
                <div class="w-9 h-9 rounded-full border border-gold-500/30 flex items-center justify-center bg-gold-500/5
                            transition-all duration-300 group-hover:border-gold-400/50 group-hover:bg-gold-500/8">
                    <span class="text-gold-400" style="font-family: 'Cormorant Garamond', serif; font-size: 1.2rem;">B</span>
                </div>
                <span class="text-xs text-dark-500 tracking-[0.3em] uppercase font-body transition-colors group-hover:text-dark-300">
                    Breathe Parfume
                </span>
            </a>
        </div>

        {{-- Center: Quote --}}
        <div class="relative z-10 max-w-xs xl:max-w-sm">
            <div class="auth-divider"></div>
            <blockquote class="leading-snug text-dark-300 mb-5"
                        style="font-family: 'Cormorant Garamond', serif; font-style: italic;
                               font-weight: 300; font-size: clamp(1.75rem, 2.5vw, 2.5rem); line-height: 1.25;">
                «Аромат — это невидимый аксессуар, неотъемлемая часть личности»
            </blockquote>
            <p class="text-xs text-dark-700 font-body tracking-[0.25em] uppercase">— Coco Chanel</p>
        </div>

        {{-- Bottom: Stats --}}
        <div class="relative z-10">
            <div class="grid grid-cols-3 gap-4 pt-6 border-t border-dark-800/30">
                <div>
                    <p class="text-xl text-dark-200 mb-1" style="font-family: 'Cormorant Garamond', serif;">15+</p>
                    <p class="text-xs text-dark-700 font-body uppercase tracking-widest leading-tight">Ароматов</p>
                </div>
                <div>
                    <p class="text-xl text-dark-200 mb-1" style="font-family: 'Cormorant Garamond', serif;">100%</p>
                    <p class="text-xs text-dark-700 font-body uppercase tracking-widest leading-tight">Оригинал</p>
                </div>
                <div>
                    <p class="text-xl text-dark-200 mb-1" style="font-family: 'Cormorant Garamond', serif;">2026</p>
                    <p class="text-xs text-dark-700 font-body uppercase tracking-widest leading-tight">Коллекция</p>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== RIGHT PANEL ===== --}}
    <div class="w-full lg:w-[54%] xl:w-[58%] flex flex-col min-h-screen"
         style="background: radial-gradient(ellipse at 70% 10%, rgba(212,149,23,0.035) 0%, transparent 55%), #0a0a07;">

        {{-- Mobile logo --}}
        <div class="lg:hidden flex justify-center pt-10 pb-2">
            <a href="{{ route('home') }}" class="inline-flex flex-col items-center gap-2.5">
                <div class="w-10 h-10 rounded-full border border-gold-500/30 flex items-center justify-center bg-gold-500/5">
                    <span class="text-gold-400 text-xl" style="font-family: 'Cormorant Garamond', serif;">B</span>
                </div>
                <span class="text-xs text-dark-500 tracking-[0.3em] uppercase font-body">Breathe Parfume</span>
            </a>
        </div>

        {{-- Form area --}}
        <div class="flex-1 flex items-center justify-center px-8 sm:px-12 md:px-20 lg:px-16 xl:px-24 2xl:px-32 py-10">
            <div class="w-full max-w-[360px]">
                {{ $slot }}
            </div>
        </div>

        {{-- Footer --}}
        <div class="py-5 px-8 text-center border-t border-dark-900">
            <p class="text-xs text-dark-800 font-body tracking-wider">
                © {{ date('Y') }} Breathe Parfume
            </p>
        </div>
    </div>

</div>
</body>
</html>
