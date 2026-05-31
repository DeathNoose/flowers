<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.required' => 'Пожалуйста, укажите ваш email',
            'email.email' => 'Введите корректный email адрес',
            'email.exists' => 'Пользователь с таким email не найден',
        ]);

        $user = User::where('email', $request->email)->first();
        $token = app('auth.password.broker')->createToken($user);
        
        // Отправляем СВОЁ письмо
        $resetUrl = URL::to('/reset-password/' . $token . '?email=' . urlencode($user->email));
        
        $html = '
        <div style="font-family: Arial, sans-serif; max-width: 500px; margin: 0 auto;">
            <div style="background: #D26F8B; padding: 20px; text-align: center;">
                <h2 style="color: white;">🌺 Family Flowers</h2>
            </div>
            <div style="border: 1px solid #F0E4E8; padding: 30px;">
                <h3>Здравствуйте, ' . ($user->name ?? 'пользователь') . '!</h3>
                <p><a href="' . $resetUrl . '" style="background: #D26F8B; color: white; padding: 12px 30px; text-decoration: none;">Сбросить пароль</a></p>
                <p>Ссылка действительна 60 минут.</p>
            </div>
        </div>
        ';
        
        Mail::send([], [], function ($message) use ($user, $html) {
            $message->to($user->email)
                    ->subject('Восстановление пароля - Family Flowers')
                    ->html($html);
        });
        
        return back()->with('status', 'Ссылка для восстановления отправлена на ваш email');
    }
}