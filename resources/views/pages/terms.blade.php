<x-app-layout>
    <x-slot name="title">Условия использования</x-slot>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="mb-10">
            <p class="section-subtitle mb-2">Документы</p>
            <h1 class="section-title">Условия использования</h1>
        </div>

        <div class="font-body text-dark-300 space-y-6">
            <p class="text-dark-400 text-sm">Последнее обновление: {{ date('d.m.Y') }}</p>

            <div class="glass-card p-6">
                <h2 class="text-xl font-sans text-dark-100 mb-4" style="font-family: 'Cormorant Garamond', serif;">1. Принятие условий</h2>
                <p class="text-sm leading-relaxed">Используя сайт Breathe Parfume, вы соглашаетесь с настоящими условиями использования. Если вы не согласны с условиями, пожалуйста, не используйте сайт.</p>
            </div>

            <div class="glass-card p-6">
                <h2 class="text-xl font-sans text-dark-100 mb-4" style="font-family: 'Cormorant Garamond', serif;">2. Заказы и оплата</h2>
                <p class="text-sm leading-relaxed">Все цены указаны в российских рублях. Заказ считается подтверждённым после получения уведомления от нашего менеджера. Мы оставляем за собой право отклонить заказ в случае отсутствия товара.</p>
            </div>

            <div class="glass-card p-6">
                <h2 class="text-xl font-sans text-dark-100 mb-4" style="font-family: 'Cormorant Garamond', serif;">3. Доставка</h2>
                <p class="text-sm leading-relaxed">Доставка осуществляется по всей России. Сроки и стоимость доставки зависят от региона и обсуждаются при подтверждении заказа. Бесплатная доставка при заказе от 5 000 рублей.</p>
            </div>

            <div class="glass-card p-6">
                <h2 class="text-xl font-sans text-dark-100 mb-4" style="font-family: 'Cormorant Garamond', serif;">4. Возврат товара</h2>
                <p class="text-sm leading-relaxed">Возврат парфюмерии возможен в течение 14 дней с момента получения, при условии, что флакон не был вскрыт. Для возврата свяжитесь с нами по электронной почте.</p>
            </div>

            <div class="glass-card p-6">
                <h2 class="text-xl font-sans text-dark-100 mb-4" style="font-family: 'Cormorant Garamond', serif;">5. Контакты</h2>
                <p class="text-sm leading-relaxed">По всем вопросам обращайтесь: hello@breathe-parfume.ru или +7 (800) 000-00-00.</p>
            </div>
        </div>
    </div>
</x-app-layout>
