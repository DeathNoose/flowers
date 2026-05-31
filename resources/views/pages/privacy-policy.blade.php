@extends('layouts.app')

@section('title', 'Политика конфиденциальности')

@section('content')
<div class="policy-page">
    <div class="container">
        <div class="policy-header">
            <h1 class="policy-title">Политика <span class="highlight">конфиденциальности</span></h1>
            <p class="policy-subtitle">Интернет-магазин «Family Flowers»</p>
            <p class="policy-date">Дата последнего обновления: 31 мая 2026 г.</p>
        </div>
        
        <div class="policy-content">
            <div class="policy-card">
                <h2>1. Общие положения</h2>
                <p>Настоящая Политика конфиденциальности (далее — «Политика») регулирует отношения по обработке персональных данных между Интернет-магазином «Family Flowers» (далее — «Магазин», «Мы») и Пользователем (далее — «Пользователь», «Вы»).</p>
                <p>Используя сайт <a href="{{ route('home') }}">familyflowers.ru</a> и оформляя заказ, Вы даете согласие на сбор, обработку и хранение своих персональных данных в соответствии с настоящей Политикой.</p>
                
                <h2>2. Какие данные мы собираем</h2>
                <p>При оформлении заказа или регистрации на сайте мы можем запросить следующую информацию:</p>
                <ul>
                    <li>Имя и фамилия;</li>
                    <li>Контактный номер телефона;</li>
                    <li>Адрес электронной почты (email);</li>
                    <li>Адрес доставки (город, улица, дом, квартира);</li>
                    <li>Комментарии к заказу.</li>
                </ul>
                
                <h2>3. Как мы используем ваши данные</h2>
                <p>Ваши персональные данные используются исключительно для следующих целей:</p>
                <ul>
                    <li>Обработка и доставка заказов;</li>
                    <li>Связь с Вами для уточнения деталей заказа;</li>
                    <li>Информирование о статусе заказа;</li>
                    <li>Улучшение качества обслуживания;</li>
                    <li>Предоставление информации об акциях и специальных предложениях (только при Вашем согласии).</li>
                </ul>
                
                <h2>4. Как мы защищаем ваши данные</h2>
                <p>Мы принимаем все необходимые меры для защиты ваших персональных данных от несанкционированного доступа, изменения, раскрытия или уничтожения:</p>
                <ul>
                    <li>Использование защищенного соединения (SSL) при передаче данных;</li>
                    <li>Ограниченный доступ к персональным данным сотрудников магазина;</li>
                    <li>Регулярное обновление систем безопасности.</li>
                </ul>
                
                <h2>5. Передача данных третьим лицам</h2>
                <p>Мы не передаем ваши персональные данные третьим лицам, за исключением случаев, предусмотренных законодательством РФ или необходимых для выполнения заказа (например, курьерским службам и платежным системам).</p>
                <p>Третьи лица, привлекаемые к исполнению заказа, обязуются соблюдать конфиденциальность и использовать полученные данные только для выполнения своих обязательств.</p>
                
                <h2>6. Ваши права</h2>
                <p>Вы имеете право:</p>
                <ul>
                    <li>Получить информацию о том, какие персональные данные о Вас хранятся;</li>
                    <li>Требовать исправления неточных или неполных данных;</li>
                    <li>Требовать удаления персональных данных;</li>
                    <li>Отозвать согласие на обработку персональных данных.</li>
                </ul>
                <p>Для реализации своих прав Вы можете связаться с нами по электронной почте: <a href="mailto:family.flowers@mail.ru">family.flowers@mail.ru</a></p>
                
                <h2>7. Сроки хранения данных</h2>
                <p>Ваши персональные данные хранятся в течение срока, необходимого для выполнения целей, указанных в настоящей Политике, если иное не предусмотрено законодательством РФ.</p>
                <p>После достижения целей обработки данные подлежат уничтожению, если иное не предусмотрено законом.</p>
                
                <h2>8. Использование файлов cookie</h2>
                <p>Сайт использует файлы cookie для улучшения работы и анализа трафика. Вы можете отключить cookie в настройках браузера, но это может повлиять на функциональность сайта.</p>
                
                <h2>9. Изменение Политики конфиденциальности</h2>
                <p>Мы оставляем за собой право вносить изменения в настоящую Политику. Все изменения публикуются на этой странице. Рекомендуем периодически проверять Политику на наличие обновлений.</p>
                
                <h2>10. Контактная информация</h2>
                <p>По всем вопросам, связанным с обработкой персональных данных, Вы можете обратиться:</p>
                <ul>
                    <li>По телефону: <a href="tel:+79630101012">+7 (963) 010-10-12</a></li>
                    <li>По электронной почте: <a href="mailto:family.flowers@mail.ru">family.flowers@mail.ru</a></li>
                    <li>По адресу: г. Курган, 3-й микрорайон, д. 30, ТЦ "Метрополис"</li>
                </ul>
            </div>
        </div>
        
        <div class="policy-footer">
            <a href="{{ route('home') }}" class="btn-back">← Вернуться на главную</a>
        </div>
    </div>
</div>

<style>
    .policy-page {
        padding: 60px 0 80px;
    }
    
    .container {
        max-width: 1400px;
        width: 100%;
        margin: 0 auto;
        padding: 0 40px;
    }
    
    .policy-header {
        text-align: center;
        margin-bottom: 60px;
    }
    
    .policy-title {
        font-size: clamp(2rem, 5vw, 3rem);
        font-weight: bold;
        margin-bottom: 16px;
        color: #1A1A1A;
    }
    
    .highlight {
        color: #D26F8B;
    }
    
    .policy-subtitle {
        color: #888888;
        font-size: clamp(0.95rem, 3vw, 1.125rem);
        margin-bottom: 8px;
    }
    
    .policy-date {
        color: #AAAAAA;
        font-size: 0.8rem;
    }
    
    .policy-card {
        background: #FFFFFF;
        border-radius: 24px;
        padding: clamp(28px, 5vw, 48px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        border: 1px solid #F0E4E8;
    }
    
    .policy-card h2 {
        font-size: clamp(1.2rem, 4vw, 1.5rem);
        font-weight: 600;
        color: #D26F8B;
        margin: 28px 0 16px;
        padding-left: 12px;
        border-left: 3px solid #D26F8B;
    }
    
    .policy-card h2:first-of-type {
        margin-top: 0;
    }
    
    .policy-card p {
        color: #4A4A4A;
        line-height: 1.7;
        margin-bottom: 16px;
        font-size: 0.95rem;
    }
    
    .policy-card ul {
        margin: 12px 0 20px 24px;
    }
    
    .policy-card li {
        color: #4A4A4A;
        line-height: 1.7;
        margin-bottom: 8px;
        font-size: 0.95rem;
    }
    
    .policy-card a {
        color: #D26F8B;
        text-decoration: none;
        transition: color 0.3s;
    }
    
    .policy-card a:hover {
        color: #E89BB3;
        text-decoration: underline;
    }
    
    .policy-footer {
        text-align: center;
        margin-top: 40px;
    }
    
    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #D26F8B;
        color: #FFFFFF;
        padding: 12px 28px;
        border-radius: 40px;
        text-decoration: none;
        transition: all 0.3s;
        font-weight: 500;
    }
    
    .btn-back:hover {
        background: #E89BB3;
        transform: translateY(-2px);
    }
    
    @media (max-width: 1024px) {
        .container {
            padding: 0 30px;
        }
        .policy-page {
            padding: 50px 0 70px;
        }
    }
    
    @media (max-width: 768px) {
        .container {
            padding: 0 20px;
        }
        .policy-page {
            padding: 40px 0 60px;
        }
        .policy-card {
            padding: 24px;
        }
        .policy-header {
            margin-bottom: 40px;
        }
    }
    
    @media (max-width: 480px) {
        .container {
            padding: 0 15px;
        }
        .policy-page {
            padding: 30px 0 50px;
        }
        .policy-card {
            padding: 20px;
        }
        .policy-card ul {
            margin-left: 16px;
        }
    }
</style>
@endsection