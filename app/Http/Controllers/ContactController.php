<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function index()
    {
        return view('contacts.index');
    }
    
    public function send(Request $request)
    {
        // Валидация с русскими сообщениями об ошибках
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string|max:5000',  // ← ОБЯЗАТЕЛЬНОЕ поле
            'agreement' => 'accepted',
        ], [
            // Русские сообщения об ошибках
            'name.required' => 'Пожалуйста, укажите ваше имя',
            'name.max' => 'Имя не должно превышать 255 символов',
            'email.required' => 'Пожалуйста, укажите ваш email',
            'email.email' => 'Введите корректный email адрес (например: name@mail.ru)',
            'email.max' => 'Email не должен превышать 255 символов',
            'phone.max' => 'Телефон не должен превышать 20 символов',
            'message.required' => 'Пожалуйста, напишите ваше сообщение',
            'message.max' => 'Сообщение не должно превышать 5000 символов',
            'agreement.accepted' => 'Необходимо согласие на обработку персональных данных и принятие политики конфиденциальности',
        ]);
        
        try {
            // Сохраняем в лог
            Log::info('Новое сообщение с сайта', [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? 'Не указан',
                'message' => $validated['message'],
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);
            
            // Если нужно отправить email, раскомментируйте:
            /*
            Mail::send([], [], function($message) use ($validated) {
                $html = "
                    <h2>Новое сообщение с сайта Family Flowers</h2>
                    <p><strong>Имя:</strong> {$validated['name']}</p>
                    <p><strong>Email:</strong> {$validated['email']}</p>
                    <p><strong>Телефон:</strong> " . ($validated['phone'] ?? 'Не указан') . "</p>
                    <p><strong>Сообщение:</strong> {$validated['message']}</p>
                ";
                
                $message->to('family.flowers@mail.ru')
                        ->subject('Новое сообщение с сайта от ' . $validated['name'])
                        ->html($html);
            });
            */
            
            return redirect()->route('contacts')
                ->with('success', 'Спасибо! Ваше сообщение отправлено. Мы свяжемся с вами в ближайшее время.');
                
        } catch (\Exception $e) {
            Log::error('Ошибка при отправке сообщения: ' . $e->getMessage());
            
            return redirect()->route('contacts')
                ->with('error', 'Извините, произошла ошибка. Попробуйте позже или свяжитесь с нами по телефону.');
        }
    }
}