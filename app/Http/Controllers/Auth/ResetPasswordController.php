<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class ResetPasswordController extends Controller
{
    /**
     * Показать форму сброса пароля
     */
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->email
        ]);
    }

    /**
     * Сбросить пароль
     */
    public function reset(Request $request)
    {
        // Валидация данных
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6|confirmed',
        ], [
            'token.required' => 'Отсутствует токен сброса пароля',
            'email.required' => 'Пожалуйста, укажите ваш email',
            'email.email' => 'Введите корректный email адрес',
            'email.exists' => 'Пользователь с таким email не найден',
            'password.required' => 'Пожалуйста, введите новый пароль',
            'password.min' => 'Пароль должен содержать минимум 6 символов',
            'password.confirmed' => 'Пароли не совпадают',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Сброс пароля
        $response = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        // Проверка результата сброса
        if ($response == Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', 'Пароль успешно изменен! Теперь вы можете войти с новым паролем.');
        }

        return back()->withErrors(['email' => 'Не удалось сбросить пароль. Попробуйте снова.']);
    }
}