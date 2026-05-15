<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function makeAdmin(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.show', $user)
                ->with('error', 'Вы не можете назначить себя администратором через эту форму');
        }
        
        $user->is_admin = true;
        $user->save();
        
        return redirect()->route('admin.users.show', $user)
            ->with('success', 'Пользователь назначен администратором');
    }

    public function removeAdmin(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.show', $user)
                ->with('error', 'Вы не можете снять права администратора с себя');
        }
        
        $user->is_admin = false;
        $user->save();
        
        return redirect()->route('admin.users.show', $user)
            ->with('success', 'Права администратора сняты');
    }
}