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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string|min:10|max:5000',
        ]);
        
        try {
            // Здесь можно отправить email или сохранить в базу данных
            // Для примера просто сохраняем в лог
            Log::info('Новое сообщение с сайта', $validated);
            
            // Если нужно отправить email, раскомментируйте:
            /*
            Mail::send('emails.contact', $validated, function($message) use ($validated) {
                $message->to('info@darkbloom.ru')
                        ->subject('Новое сообщение с сайта от ' . $validated['name']);
                $message->from($validated['email'], $validated['name']);
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