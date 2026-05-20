<x-app-layout>
    <x-slot name="title">Политика конфиденциальности</x-slot>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="mb-10">
            <p class="section-subtitle mb-2">Документы</p>
            <h1 class="section-title">Политика конфиденциальности</h1>
        </div>

        <div class="prose prose-invert max-w-none font-body text-dark-300 space-y-6">
            <p class="text-dark-400 text-sm">Последнее обновление: {{ date('d.m.Y') }}</p>

            <div class="glass-card p-6">
                <h2 class="text-xl font-sans text-dark-100 mb-4" style="font-family: 'Cormorant Garamond', serif;">1. Сбор информации</h2>
                <p class="text-sm leading-relaxed">Мы собираем информацию, которую вы предоставляете при регистрации: имя, адрес электронной почты, номер телефона и адрес доставки. Эта информация необходима для обработки ваших заказов.</p>
            </div>

            <div class="glass-card p-6">
                <h2 class="text-xl font-sans text-dark-100 mb-4" style="font-family: 'Cormorant Garamond', serif;">2. Использование данных</h2>
                <p class="text-sm leading-relaxed">Ваши данные используются исключительно для обработки заказов, доставки товаров и улучшения качества обслуживания. Мы не передаём ваши данные третьим лицам, за исключением случаев, необходимых для выполнения заказа (служба доставки).</p>
            </div>

            <div class="glass-card p-6">
                <h2 class="text-xl font-sans text-dark-100 mb-4" style="font-family: 'Cormorant Garamond', serif;">3. Защита данных</h2>
                <p class="text-sm leading-relaxed">Мы применяем технические и организационные меры для защиты ваших персональных данных от несанкционированного доступа, изменения, раскрытия или уничтожения.</p>
            </div>

            <div class="glass-card p-6">
                <h2 class="text-xl font-sans text-dark-100 mb-4" style="font-family: 'Cormorant Garamond', serif;">4. Cookies</h2>
                <p class="text-sm leading-relaxed">Наш сайт использует cookies для обеспечения работы функций корзины, авторизации и аналитики. Вы можете отключить cookies в настройках браузера, однако это может повлиять на функциональность сайта.</p>
            </div>

            <div class="glass-card p-6">
                <h2 class="text-xl font-sans text-dark-100 mb-4" style="font-family: 'Cormorant Garamond', serif;">5. Ваши права</h2>
                <p class="text-sm leading-relaxed">Вы имеете право запросить доступ к своим персональным данным, их исправление или удаление. Для этого свяжитесь с нами по адресу hello@breathe-parfume.ru.</p>
            </div>
        </div>
    </div>
</x-app-layout>
