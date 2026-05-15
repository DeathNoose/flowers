<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        // Получаем заказы только текущего пользователя
        $orders = Order::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('profile.index', compact('user', 'orders'));
    }

    public function edit()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|regex:/^[а-яА-ЯёЁa-zA-Z\s\-]+$/u',
            'phone' => 'required|string|max:20|regex:/^\+7\s?\(?[0-9]{3}\)?\s?[0-9]{3}-?[0-9]{2}-?[0-9]{2}$/',
            'address' => 'nullable|string|max:500',
            'current_password' => 'required_with:new_password',
            'new_password' => 'nullable|string|min:6|confirmed',
        ], [
            'name.required' => 'Пожалуйста, укажите ваше имя',
            'name.regex' => 'Имя может содержать только буквы, пробелы и дефисы',
            'phone.required' => 'Пожалуйста, укажите номер телефона',
            'phone.regex' => 'Введите номер в формате +7 (999) 123-45-67',
            'current_password.required_with' => 'Введите текущий пароль для смены пароля',
            'new_password.min' => 'Новый пароль должен содержать минимум 6 символов',
            'new_password.confirmed' => 'Новые пароли не совпадают',
        ]);

        if ($validator->fails()) {
            return redirect()->route('profile.edit')
                ->withErrors($validator)
                ->withInput();
        }

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;

        if ($request->new_password) {
            if (!Hash::check($request->current_password, $user->password)) {
                return redirect()->route('profile.edit')
                    ->withErrors(['current_password' => 'Текущий пароль неверен'])
                    ->withInput();
            }
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return redirect()->route('profile.index')->with('success', 'Профиль успешно обновлен');
    }

    
}