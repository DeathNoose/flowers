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
        
        // Получаем заказы пользователя
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