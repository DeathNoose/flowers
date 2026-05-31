@extends('layouts.app')

@section('title', 'Согласие на обработку персональных данных')

@section('content')
<div class="agreement-page">
    <div class="container">
        <div class="agreement-header">
            <h1 class="agreement-title">Согласие на <span class="highlight">обработку персональных данных</span></h1>
            <p class="agreement-subtitle">Интернет-магазин «Family Flowers»</p>
        </div>
        
        <div class="agreement-content">
            <div class="agreement-card">
                <div class="agreement-text">
                    <p>Настоящим я, действуя свободно, своей волей и в своем интересе, даю согласие Индивидуальному предпринимателю (далее — «Оператор») на обработку моих персональных данных при оформлении заказа на сайте <a href="{{ route('home') }}">familyflowers.ru</a> (далее — «Сайт»).</p>
                    
                    <h2>1. Перечень персональных данных</h2>
                    <p>Я предоставляю Оператору следующие персональные данные:</p>
                    <ul>
                        <li>Фамилия, имя, отчество;</li>
                        <li>Номер контактного телефона;</li>
                        <li>Адрес электронной почты (email);</li>
                        <li>Адрес доставки (город, улица, дом, квартира, подъезд, этаж);</li>
                        <li>Сведения, указанные в комментариях к заказу.</li>
                    </ul>
                    
                    <h2>2. Цели обработки персональных данных</h2>
                    <p>Я даю согласие на обработку моих персональных данных в следующих целях:</p>
                    <ul>
                        <li>Оформление, обработка и доставка заказов;</li>
                        <li>Связь со мной для уточнения деталей заказа;</li>
                        <li>Информирование о статусе выполнения заказа;</li>
                        <li>Улучшение качества обслуживания и работы сайта;</li>
                        <li>Направление информационных и рекламных сообщений (с моего дополнительного согласия).</li>
                    </ul>
                    
                    <h2>3. Действия с персональными данными</h2>
                    <p>Я даю согласие на совершение Оператором следующих действий с моими персональными данными:</p>
                    <ul>
                        <li>Сбор и систематизация;</li>
                        <li>Накопление и хранение;</li>
                        <li>Уточнение (обновление, изменение);</li>
                        <li>Использование и передача (в том числе курьерским службам и платежным системам);</li>
                        <li>Обезличивание, блокирование, уничтожение.</li>
                    </ul>
                    <p>Обработка персональных данных осуществляется как с использованием средств автоматизации, так и без их использования.</p>
                    
                    <h2>4. Срок согласия</h2>
                    <p>Настоящее согласие действует с момента оформления заказа на Сайте и до момента достижения целей обработки персональных данных, если иное не предусмотрено законодательством РФ.</p>
                    <p>Я уведомлен(а), что могу отозвать настоящее согласие в любой момент путем направления письменного уведомления на электронный адрес Оператора: <a href="mailto:family.flowers@mail.ru">family.flowers@mail.ru</a>. Отзыв согласия влечет за собой невозможность дальнейшего использования Сайта и оформления заказов.</p>
                    
                    <h2>5. Передача данных третьим лицам</h2>
                    <p>Я даю согласие на передачу моих персональных данных третьим лицам в случаях, необходимых для выполнения заказа (курьерские службы, платежные системы), а также в случаях, предусмотренных законодательством РФ.</p>
                    <p>Третьи лица, получающие персональные данные, обязуются обеспечивать конфиденциальность и использовать полученные данные исключительно для выполнения обязательств перед Оператором.</p>
                    
                    <h2>6. Мои права</h2>
                    <p>Я уведомлен(а) о своих правах, в том числе:</p>
                    <ul>
                        <li>На получение информации о факте обработки моих персональных данных;</li>
                        <li>На уточнение, блокирование или уничтожение моих персональных данных;</li>
                        <li>На отзыв согласия на обработку персональных данных;</li>
                        <li>На обжалование действий Оператора в уполномоченном органе.</li>
                    </ul>
                    
                    <h2>7. Подтверждение</h2>
                    <p>Нажимая кнопку «Оформить заказ» или «Подтвердить заказ», я подтверждаю, что:</p>
                    <ul>
                        <li>Ознакомлен(а) с настоящим Согласием на обработку персональных данных;</li>
                        <li>Понимаю его положения и даю свое согласие добровольно;</li>
                        <li>Подтверждаю достоверность предоставленных мною данных.</li>
                    </ul>
                </div>
                
                <div class="agreement-actions">
                    <button type="button" class="btn-close" onclick="window.close()">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .agreement-page {
        padding: 60px 0 80px;
    }
    
    .container {
        max-width: 1400px;
        width: 100%;
        margin: 0 auto;
        padding: 0 40px;
    }
    
    .agreement-header {
        text-align: center;
        margin-bottom: 60px;
    }
    
    .agreement-title {
        font-size: clamp(1.8rem, 5vw, 2.5rem);
        font-weight: bold;
        margin-bottom: 16px;
        color: #1A1A1A;
    }
    
    .highlight {
        color: #D26F8B;
    }
    
    .agreement-subtitle {
        color: #888888;
        font-size: clamp(0.95rem, 3vw, 1.125rem);
    }
    
    .agreement-card {
        background: #FFFFFF;
        border-radius: 24px;
        padding: clamp(28px, 5vw, 48px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        border: 1px solid #F0E4E8;
    }
    
    .agreement-text h2 {
        font-size: clamp(1.2rem, 4vw, 1.5rem);
        font-weight: 600;
        color: #D26F8B;
        margin: 28px 0 16px;
        padding-left: 12px;
        border-left: 3px solid #D26F8B;
    }
    
    .agreement-text h2:first-of-type {
        margin-top: 0;
    }
    
    .agreement-text p {
        color: #4A4A4A;
        line-height: 1.7;
        margin-bottom: 16px;
        font-size: 0.95rem;
    }
    
    .agreement-text ul {
        margin: 12px 0 20px 24px;
    }
    
    .agreement-text li {
        color: #4A4A4A;
        line-height: 1.7;
        margin-bottom: 8px;
        font-size: 0.95rem;
    }
    
    .agreement-text a {
        color: #D26F8B;
        text-decoration: none;
        transition: color 0.3s;
    }
    
    .agreement-text a:hover {
        color: #E89BB3;
        text-decoration: underline;
    }
    
    .agreement-actions {
        text-align: center;
        margin-top: 40px;
        padding-top: 24px;
        border-top: 1px solid #F0E4E8;
    }
    
    .btn-close {
        background: #D26F8B;
        color: #FFFFFF;
        border: none;
        padding: 12px 32px;
        border-radius: 40px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .btn-close:hover {
        background: #E89BB3;
        transform: translateY(-2px);
    }
    
    @media (max-width: 1024px) {
        .container {
            padding: 0 30px;
        }
        .agreement-page {
            padding: 50px 0 70px;
        }
    }
    
    @media (max-width: 768px) {
        .container {
            padding: 0 20px;
        }
        .agreement-page {
            padding: 40px 0 60px;
        }
        .agreement-card {
            padding: 24px;
        }
        .agreement-header {
            margin-bottom: 40px;
        }
    }
    
    @media (max-width: 480px) {
        .container {
            padding: 0 15px;
        }
        .agreement-page {
            padding: 30px 0 50px;
        }
        .agreement-card {
            padding: 20px;
        }
        .agreement-text ul {
            margin-left: 16px;
        }
        .btn-close {
            width: 100%;
        }
    }
</style>
@endsection