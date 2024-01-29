<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Регистрация пользователя
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        $request->validate([
            'email' => 'required|email:rfc,dns|unique:App\Models\User',
            'password' => 'required|confirmed|between:8,64'
        ], [], [
            'email' => 'Электронная почта',
            'password' => 'Пароль'
        ]);

        $user = new User();
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

        auth()->login($user);

        return to_route('task.index', ['view' => 'user'])->with('success', 'Вы успешно зарегистрировались');
    }

    /**
     * Авторизация пользователя
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function auth(Request $request)
    {
        $request->validate([
            'email' => 'required|email:rfc',
            'password' => 'required|between:8,64',
            'remember_token' => 'nullable|boolean'
        ]);

        if (auth()->attempt($request->only('email', 'password'), $request->remember_token)) {
            $request->session()->regenerate();

            return to_route('task.index', ['view' => 'user'])->with('success', 'Вы успешно прошли авторизацию');
        }

        return back()->withErrors(['Предоставленные учетные данные не найдены']);
    }

    /**
     * Выход из учетной записи
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('index')->with('success', 'Вы успешно вышли из учетной записи');
    }
}
