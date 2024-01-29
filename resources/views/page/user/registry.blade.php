@extends('layout.default')
@section('content')
    <form method="POST" action="{{ route('user.create') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label" for="registry-email">
                <span class="text-danger">*</span>
                Электронная почта
            </label>
            <input class="form-control" id="registry-email" type="email" name="email" placeholder="name@example.com" value="{{ old('email') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label" for="registry-password">
                <span class="text-danger">*</span>
                Пароль
            </label>
            <input class="form-control" id="registry-password" type="password" name="password" placeholder="Пароль" value="{{ old('password') }}" minlength="8" maxlength="64" required>
        </div>
        <div class="mb-3">
            <label class="form-label" for="registry-password">
                <span class="text-danger">*</span>
                Повторите пароль
            </label>
            <input class="form-control" id="registry-password" type="password" name="password_confirmation" placeholder="Повторите пароль" value="{{ old('password_confirmation') }}" required>
        </div>
        <button class="btn btn-primary px-5 py-2" type="submit">Продолжить</button>
    </form>
@endsection
