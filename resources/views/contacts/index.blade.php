@extends('layouts.app')

@section('title', 'Контакты')

@section('content')
<div class="container" style="padding: 60px 0 80px;">
    {{-- Заголовок --}}
    <div style="text-align: center; margin-bottom: 60px;">
        <h1 style="font-size: 3rem; font-weight: bold; margin-bottom: 16px; color: #1A1A1A;">
            Наши <span style="color: #D26F8B;">контакты</span>
        </h1>
        <p style="color: #888888; font-size: 1.125rem; max-width: 600px; margin: 0 auto;">
            Удовольствие от хорошего качества длится дольше, чем радость от низкой цены.<br>
            Свяжитесь с нами любым удобным способом
        </p>
    </div>
    
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px;">
        {{-- Левая колонка: Контактная информация --}}
        <div>
            <div style="background: #FFFFFF; border-radius: 24px; padding: 32px; height: 100%; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); border: 1px solid #F0E4E8;">
                <h2 style="font-size: 1.5rem; font-weight: bold; margin-bottom: 24px; color: #1A1A1A;">Свяжитесь с нами</h2>
                
                {{-- Сообщения об успехе/ошибке --}}
                @if(session('success'))
                    <div style="margin-bottom: 24px; padding: 16px; background: rgba(210, 111, 139, 0.1); border: 1px solid #D26F8B; border-radius: 12px; color: #D26F8B;">
                        {{ session('success') }}
                    </div>
                @endif
                
                @if(session('error'))
                    <div style="margin-bottom: 24px; padding: 16px; background: rgba(229, 57, 53, 0.1); border: 1px solid #E53935; border-radius: 12px; color: #E53935;">
                        {{ session('error') }}
                    </div>
                @endif
                
                {{-- Контактная информация --}}
                <div style="display: flex; flex-direction: column; gap: 24px;">
                    <!-- Адрес -->
                    <div style="display: flex; gap: 16px;">
                        <div style="width: 48px; height: 48px; background: rgba(210, 111, 139, 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg style="width: 24px; height: 24px; color: #D26F8B;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 style="font-weight: 600; font-size: 1.125rem; margin-bottom: 8px; color: #1A1A1A;">Адрес</h3>
                            <p style="color: #666666; line-height: 1.5;">
                                г. Курган, 3-й микрорайон, д. 30<br>
                                ТЦ "Метрополис", цокольный этаж<br>
                                Ориентир: у кинотеатра "Современник", напротив касс супермаркета "Метрополис"
                            </p>
                            <p style="color: #888888; font-size: 0.875rem; margin-top: 8px;">📍 Остановка "Культурный центр Современник" — 1 минута пешком</p>
                        </div>
                    </div>

                    <!-- Телефон -->
                    <div style="display: flex; gap: 16px;">
                        <div style="width: 48px; height: 48px; background: rgba(210, 111, 139, 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg style="width: 24px; height: 24px; color: #D26F8B;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <div>
                            <h3 style="font-weight: 600; font-size: 1.125rem; margin-bottom: 8px; color: #1A1A1A;">Телефон</h3>
                            <p>
                                <a href="tel:+79630101012" style="color: #4A4A4A; text-decoration: none; font-size: 1.125rem; transition: color 0.3s;">+7 (963) 010-10-12</a>
                            </p>
                        </div>
                    </div>

                    <!-- Email -->
                    <div style="display: flex; gap: 16px;">
                        <div style="width: 48px; height: 48px; background: rgba(210, 111, 139, 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg style="width: 24px; height: 24px; color: #D26F8B;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <h3 style="font-weight: 600; font-size: 1.125rem; margin-bottom: 8px; color: #1A1A1A;">Email</h3>
                            <p>
                                <a href="mailto:family.flowers@mail.ru" style="color: #4A4A4A; text-decoration: none; transition: color 0.3s;">family.flowers@mail.ru</a>
                            </p>
                        </div>
                    </div>

                    <!-- Режим работы -->
                    <div style="display: flex; gap: 16px;">
                        <div style="width: 48px; height: 48px; background: rgba(210, 111, 139, 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg style="width: 24px; height: 24px; color: #D26F8B;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 style="font-weight: 600; font-size: 1.125rem; margin-bottom: 8px; color: #1A1A1A;">Режим работы</h3>
                            <p style="color: #4A4A4A;">
                                Ежедневно: <span style="color: #1A1A1A;">8:00 – 22:00</span><br>
                                Без обеда, без выходных
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Социальные сети --}}
                <div style="margin-top: 32px; padding-top: 24px; border-top: 1px solid #F0E4E8;">
                    <h4 style="font-weight: 600; font-size: 1.125rem; margin-bottom: 16px; color: #1A1A1A;">Мы в соцсетях</h4>
                    <div style="display: flex; justify-content: flex-start;">
                        <a href="https://vk.com/family.flowers.premium" target="_blank" rel="noopener noreferrer" 
                           style="width: 48px; height: 48px; background: #F5F0F2; border: 1px solid #F0E4E8; border-radius: 12px; display: flex; align-items: center; justify-content: center; transition: all 0.3s;">
                            <i class="fab fa-vk" style="color: #888888; font-size: 1.5rem; transition: color 0.3s;"></i>
                        </a>
                    </div>
                    <p style="color: #888888; font-size: 0.75rem; margin-top: 12px;">Подписывайтесь на нас!</p>
                </div>
            </div>
        </div>
        
        {{-- Правая колонка: Форма обратной связи --}}
        <div>
            <div style="background: #FFFFFF; border-radius: 24px; padding: 32px; height: 100%; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); border: 1px solid #F0E4E8;">
                <h2 style="font-size: 1.5rem; font-weight: bold; margin-bottom: 24px; color: #1A1A1A;">Написать нам</h2>
                
                <form action="{{ route('contacts.send') }}" method="POST" style="display: flex; flex-direction: column; gap: 20px;">
                    @csrf
                    
                    <div>
                        <label for="name" style="display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 8px; color: #1A1A1A;">Ваше имя <span style="color: #D26F8B;">*</span></label>
                        <input type="text" 
                               name="name" 
                               id="name" 
                               required
                               value="{{ old('name') }}"
                               style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px 16px; color: #1A1A1A; transition: all 0.3s; outline: none;"
                               placeholder="Иван Иванов">
                        @error('name')
                            <p style="color: #E53935; font-size: 0.875rem; margin-top: 4px;">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="email" style="display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 8px; color: #1A1A1A;">Email <span style="color: #D26F8B;">*</span></label>
                        <input type="email" 
                               name="email" 
                               id="email" 
                               required
                               value="{{ old('email') }}"
                               style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px 16px; color: #1A1A1A; transition: all 0.3s; outline: none;"
                               placeholder="ivan@example.com">
                        @error('email')
                            <p style="color: #E53935; font-size: 0.875rem; margin-top: 4px;">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="phone" style="display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 8px; color: #1A1A1A;">Телефон</label>
                        <input type="tel" 
                               name="phone" 
                               id="phone" 
                               value="{{ old('phone') }}"
                               style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px 16px; color: #1A1A1A; transition: all 0.3s; outline: none;"
                               placeholder="+7 (900) 123-45-67">
                        @error('phone')
                            <p style="color: #E53935; font-size: 0.875rem; margin-top: 4px;">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="message" style="display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 8px; color: #1A1A1A;">Сообщение <span style="color: #D26F8B;">*</span></label>
                        <textarea name="message" 
                                  id="message" 
                                  required
                                  rows="5"
                                  style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px 16px; color: #1A1A1A; transition: all 0.3s; outline: none; resize: vertical;"
                                  placeholder="Расскажите, что вас интересует...">{{ old('message') }}</textarea>
                        @error('message')
                            <p style="color: #E53935; font-size: 0.875rem; margin-top: 4px;">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <button type="submit" style="width: 100%; background: #D26F8B; color: #FFFFFF; font-weight: 600; padding: 12px 24px; border-radius: 40px; border: none; cursor: pointer; transition: all 0.3s;">
                        Отправить сообщение
                    </button>
                    
                    <p style="font-size: 0.75rem; color: #888888; text-align: center; margin-top: 16px;">
                        <span style="color: #D26F8B;">*</span> — поля, обязательные для заполнения
                    </p>
                </form>
            </div>
        </div>
    </div>
    
    {{-- Карта --}}
    <div style="margin-top: 60px;">
        <div style="background: #FFFFFF; border-radius: 24px; overflow: hidden; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); border: 1px solid #F0E4E8;">
            <div style="padding: 20px 24px; border-bottom: 1px solid #F0E4E8;">
                <h2 style="font-size: 1.25rem; font-weight: bold; color: #1A1A1A;">Как нас найти</h2>
                <p style="color: #888888; font-size: 0.875rem; margin-top: 4px;">г. Курган, 3-й микрорайон, д. 30, ТЦ "Метрополис"</p>
            </div>
            <div style="aspect-ratio: 16 / 7; background: #F5F0F2;">
                <iframe 
                    src="https://yandex.ru/map-widget/v1/?ll=65.266836%2C55.462676&z=18&pt=65.266836%2C55.462676&l=map"
                    width="100%" 
                    height="100%" 
                    frameborder="0"
                    allowfullscreen="true"
                    style="filter: grayscale(100%); transition: filter 0.5s;">
                </iframe>
            </div>
            <div style="padding: 16px 24px; background: #FAF8F9; text-align: center;">
                <p style="color: #D26F8B; font-weight: 600; margin-bottom: 6px;">📍 Адрес магазина</p>
                <p style="color: #666666; font-size: 0.875rem;">
                    г. Курган, 3-й микрорайон, д. 30<br>
                    ТЦ "Метрополис", цокольный этаж<br>
                    Ориентир: у кинотеатра "Современник", напротив касс супермаркета "Метрополис"
                </p>
                <p style="color: #888888; font-size: 0.75rem; margin-top: 8px;">
                    🚶 Остановка "Культурный центр Современник" — 1 минута пешком
                </p>
            </div>
        </div>
    </div>

<style>
    .container {
        max-width: 1400px;
        width: 100%;
        margin: 0 auto;
        padding: 0 40px;
    }
    
    @media (max-width: 1024px) {
        .container {
            padding: 0 20px;
        }
    }
    
    @media (max-width: 768px) {
        .container {
            padding: 0 16px;
        }
        h1 {
            font-size: 2rem !important;
        }
        [style*="grid-template-columns: 1fr 1fr"] {
            grid-template-columns: 1fr !important;
            gap: 32px !important;
        }
    }
    
    input:focus, textarea:focus {
        border-color: #D26F8B !important;
        box-shadow: 0 0 0 3px rgba(210, 111, 139, 0.15) !important;
    }
    
    button:hover {
        background: #E89BB3 !important;
        transform: translateY(-2px);
    }
    
    a[href="tel:+79630101012"]:hover,
    a[href="mailto:family.flowers@mail.ru"]:hover {
        color: #D26F8B !important;
    }
    
    .fa-vk:hover {
        color: #D26F8B !important;
    }
    
    .social-link:hover {
        border-color: #D26F8B !important;
        background: rgba(210, 111, 139, 0.1) !important;
    }
    
    iframe:hover {
        filter: grayscale(0%) !important;
    }
</style>
@endsection