<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|regex:/^[а-яА-ЯёЁa-zA-Z\s\-]+$/u',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20|regex:/^\+7\s?\(?[0-9]{3}\)?\s?[0-9]{3}-?[0-9]{2}-?[0-9]{2}$/',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'name.required' => 'Пожалуйста, укажите ваше имя',
            'name.regex' => 'Имя может содержать только буквы, пробелы и дефисы',
            'email.required' => 'Пожалуйста, укажите email',
            'email.email' => 'Введите корректный email адрес',
            'email.unique' => 'Этот email уже зарегистрирован',
            'phone.required' => 'Пожалуйста, укажите номер телефона',
            'phone.regex' => 'Введите номер в формате +7 (999) 123-45-67',
            'password.required' => 'Пожалуйста, укажите пароль',
            'password.min' => 'Пароль должен содержать минимум 6 символов',
            'password.confirmed' => 'Пароли не совпадают',
        ]);

        if ($validator->fails()) {
            return redirect()->route('register')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'is_admin' => false,
        ]);

        auth()->login($user);

        return redirect()->route('home')->with('success', 'Добро пожаловать, ' . $user->name . '!');
    }
}