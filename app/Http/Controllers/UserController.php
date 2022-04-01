<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email:rfc,dns|unique:App\Models\User',
            'password' => 'required|confirmed|min:8|max:64'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = new User();
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

        return redirect()
            ->route('user.login')
            ->with('success', 'Вы успешно зарегистрировались');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function auth(Request $request)
    {
        $validator = $request->validate([
            'email' => 'required|email:rfc',
            'password' => 'required|min:8'
        ]);

        if (Auth::attempt($validator, $request->remember_token)) {
            $request->session()->regenerate();

            return redirect()
                ->intended(route('home'))
                ->with('success', 'Вы успешно прошли авторизацию.');
        }

        return back()
            ->withErrors(['Предоставленные учетные данные не найдены.'])
            ->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('home')
            ->with('success', 'Вы успешно вышли из учетной записи.');
    }
}
