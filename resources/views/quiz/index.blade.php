<x-app-layout>
    <x-slot name="title">Найти свой аромат</x-slot>

    <div class="min-h-screen flex items-center py-20"
         style="background: radial-gradient(ellipse at 50% 0%, rgba(131,111,217,0.08) 0%, transparent 70%);">

        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 w-full"
             x-data="quiz()" x-init="init()">

            {{-- Header --}}
            <div class="text-center mb-12">
                <p class="section-subtitle mb-4">Персональный подбор</p>
                <h1 class="text-5xl md:text-6xl font-sans text-dark-50 mb-4" style="font-family: 'Cormorant Garamond', serif;">
                    Какой аромат<br><span class="gradient-gold">ваш?</span>
                </h1>
                <p class="text-dark-400 font-body">Ответьте на 5 вопросов — мы подберём идеальный парфюм</p>
            </div>

            {{-- Progress --}}
            <div class="mb-10">
                <div class="flex justify-between text-xs font-body text-dark-600 mb-2">
                    <span>Вопрос <span x-text="step + 1"></span> из 5</span>
                    <span x-text="Math.round(((step + 1) / 5) * 100) + '%'"></span>
                </div>
                <div class="h-px bg-dark-800 relative">
                    <div class="absolute top-0 left-0 h-full bg-gradient-to-r from-gold-600 to-gold-400 transition-all duration-500"
                         :style="'width: ' + ((step + 1) / 5 * 100) + '%'"></div>
                </div>
            </div>

            {{-- Questions --}}
            <form action="{{ route('quiz.result') }}" method="POST" id="quiz-form">
                @csrf

                {{-- Question 1: Mood --}}
                <div x-show="step === 0" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                    <h2 class="text-2xl font-sans text-dark-100 mb-6 text-center" style="font-family: 'Cormorant Garamond', serif;">
                        Какое настроение вы хотите создать?
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        @foreach([
                            ['fresh', '🌊', 'Свежее и лёгкое', 'Как морской бриз или утренняя роса'],
                            ['warm', '🔥', 'Тёплое и уютное', 'Как ваниль, амбра и мускус'],
                            ['floral', '🌸', 'Цветочное и романтичное', 'Роза, жасмин, пион'],
                            ['woody', '🌲', 'Древесное и глубокое', 'Кедр, сандал, ветивер'],
                            ['spicy', '🌶', 'Пряное и загадочное', 'Перец, кардамон, уд'],
                        ] as [$val, $icon, $title, $desc])
                        <label class="cursor-pointer">
                            <input type="radio" name="answers[mood]" value="{{ $val }}" class="sr-only peer" @change="answers.mood = '{{ $val }}'">
                            <div class="p-4 border border-dark-700 peer-checked:border-gold-500 peer-checked:bg-gold-500/5 transition-all duration-200 hover:border-dark-500">
                                <div class="flex items-start gap-3">
                                    <span class="text-2xl">{{ $icon }}</span>
                                    <div>
                                        <p class="font-body text-dark-100 font-medium text-sm">{{ $title }}</p>
                                        <p class="text-xs text-dark-500 font-body mt-0.5">{{ $desc }}</p>
                                    </div>
                                </div>
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>

                {{-- Question 2: Gender --}}
                <div x-show="step === 1" style="display:none;"
                     x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                    <h2 class="text-2xl font-sans text-dark-100 mb-6 text-center" style="font-family: 'Cormorant Garamond', serif;">
                        Для кого вы выбираете аромат?
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        @foreach([
                            ['male', '♂', 'Для мужчины'],
                            ['female', '♀', 'Для женщины'],
                            ['any', '⚥', 'Для любого'],
                        ] as [$val, $icon, $title])
                        <label class="cursor-pointer">
                            <input type="radio" name="answers[gender]" value="{{ $val }}" class="sr-only peer" @change="answers.gender = '{{ $val }}'">
                            <div class="p-6 border border-dark-700 peer-checked:border-gold-500 peer-checked:bg-gold-500/5 transition-all duration-200 hover:border-dark-500 text-center">
                                <p class="text-3xl mb-2">{{ $icon }}</p>
                                <p class="font-body text-dark-100 text-sm">{{ $title }}</p>
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>

                {{-- Question 3: Season --}}
                <div x-show="step === 2" style="display:none;"
                     x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                    <h2 class="text-2xl font-sans text-dark-100 mb-6 text-center" style="font-family: 'Cormorant Garamond', serif;">
                        В какое время года вы планируете носить аромат?
                    </h2>
                    <div class="grid grid-cols-2 gap-3">
                        @foreach([
                            ['spring', '🌸', 'Весна', 'Свежие, цветочные'],
                            ['summer', '☀️', 'Лето', 'Лёгкие, цитрусовые'],
                            ['autumn', '🍂', 'Осень', 'Тёплые, древесные'],
                            ['winter', '❄️', 'Зима', 'Насыщенные, пряные'],
                        ] as [$val, $icon, $title, $desc])
                        <label class="cursor-pointer">
                            <input type="radio" name="answers[season]" value="{{ $val }}" class="sr-only peer" @change="answers.season = '{{ $val }}'">
                            <div class="p-5 border border-dark-700 peer-checked:border-gold-500 peer-checked:bg-gold-500/5 transition-all duration-200 hover:border-dark-500 text-center">
                                <p class="text-3xl mb-2">{{ $icon }}</p>
                                <p class="font-body text-dark-100 text-sm font-medium">{{ $title }}</p>
                                <p class="text-xs text-dark-500 font-body mt-1">{{ $desc }}</p>
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>

                {{-- Question 4: Occasion --}}
                <div x-show="step === 3" style="display:none;"
                     x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                    <h2 class="text-2xl font-sans text-dark-100 mb-6 text-center" style="font-family: 'Cormorant Garamond', serif;">
                        По какому случаю вы ищете аромат?
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        @foreach([
                            ['daily', '☕', 'Каждый день', 'Ненавязчивый, свежий'],
                            ['evening', '🌙', 'Вечер / Свидание', 'Чувственный, долгоиграющий'],
                            ['office', '💼', 'Работа / Офис', 'Деловой, умеренный'],
                            ['special', '✨', 'Особый случай', 'Яркий, запоминающийся'],
                        ] as [$val, $icon, $title, $desc])
                        <label class="cursor-pointer">
                            <input type="radio" name="answers[occasion]" value="{{ $val }}" class="sr-only peer" @change="answers.occasion = '{{ $val }}'">
                            <div class="p-4 border border-dark-700 peer-checked:border-gold-500 peer-checked:bg-gold-500/5 transition-all duration-200 hover:border-dark-500">
                                <div class="flex items-center gap-3">
                                    <span class="text-2xl">{{ $icon }}</span>
                                    <div>
                                        <p class="font-body text-dark-100 font-medium text-sm">{{ $title }}</p>
                                        <p class="text-xs text-dark-500 font-body">{{ $desc }}</p>
                                    </div>
                                </div>
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>

                {{-- Question 5: Intensity --}}
                <div x-show="step === 4" style="display:none;"
                     x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                    <h2 class="text-2xl font-sans text-dark-100 mb-6 text-center" style="font-family: 'Cormorant Garamond', serif;">
                        Какую интенсивность аромата вы предпочитаете?
                    </h2>
                    <div class="space-y-3">
                        @foreach([
                            ['light', 'Лёгкий и деликатный', 'Едва уловимый шлейф, только для вас', '● ○ ○'],
                            ['medium', 'Умеренный', 'Приятный, заметный окружающим', '● ● ○'],
                            ['intense', 'Насыщенный', 'Яркий аромат с долгим шлейфом', '● ● ●'],
                        ] as [$val, $title, $desc, $dots])
                        <label class="cursor-pointer block">
                            <input type="radio" name="answers[intensity]" value="{{ $val }}" class="sr-only peer" @change="answers.intensity = '{{ $val }}'">
                            <div class="p-4 border border-dark-700 peer-checked:border-gold-500 peer-checked:bg-gold-500/5 transition-all duration-200 hover:border-dark-500 flex items-center justify-between">
                                <div>
                                    <p class="font-body text-dark-100 font-medium text-sm">{{ $title }}</p>
                                    <p class="text-xs text-dark-500 font-body">{{ $desc }}</p>
                                </div>
                                <span class="text-gold-500 text-sm tracking-widest font-body shrink-0">{{ $dots }}</span>
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>

                {{-- Navigation --}}
                <div class="flex justify-between mt-10">
                    <button type="button" @click="prev()"
                            x-show="step > 0"
                            class="btn-outline text-sm px-6 py-3">
                        ← Назад
                    </button>
                    <div x-show="step === 0" class="flex-1"></div>

                    <button type="button" @click="next()"
                            x-show="step < 4"
                            class="btn-gold text-sm px-8 py-3 ml-auto">
                        Далее →
                    </button>

                    <button type="submit"
                            x-show="step === 4"
                            style="display:none;"
                            class="btn-gold text-sm px-8 py-3 ml-auto">
                        Найти аромат ✨
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function quiz() {
            return {
                step: 0,
                answers: {},
                init() {},
                next() {
                    if (this.step < 4) this.step++;
                },
                prev() {
                    if (this.step > 0) this.step--;
                },
            }
        }
    </script>
</x-app-layout>
