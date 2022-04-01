@extends('layouts.default')
@section('title', 'Авторизация - Example')
@section('content')
    <form method="POST" action="{{ route('user.auth') }}">
        @csrf
        <div class="mb-3">
            <label for="registry-email" class="form-label">
                <span class="text-danger">*</span>
                Адрес электронной почты
            </label>
            <input class="form-control" id="registry-email" type="email" name="email" placeholder="name@example.com" value="{{ old('email') }}" required>
        </div>
        <div class="mb-3">
            <label for="registry-password" class="form-label">
                <span class="text-danger">*</span>
                Пароль
            </label>
            <input class="form-control" id="registry-password" type="password" name="password" placeholder="Пароль" value="{{ old('password') }}" required>
        </div>
        <div class="mb-3">
            <label>
                <input class="form-check-input" type="checkbox" name="remember_token"> Запомнить меня
            </label>
        </div>
        <button class="btn btn-primary px-5 py-2" type="submit">Авторизация</button>
    </form>
@endsection
