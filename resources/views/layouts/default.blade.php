<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if(auth()->check())
        <script>
            window.Laravel = {{ \Illuminate\Support\Js::from(['user' => auth()->user()->getAuthIdentifier()]) }}
        </script>
    @endif

    <title>@yield('title')</title>
</head>
<body>
<div class="p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ route('home') }}" class="h5 my-0 mr-md-auto text-decoration-none text-dark">{{ env('APP_NAME') }}</a>
            <div class="d-flex">
                @auth
                    <a class="btn btn-outline-success" href="{{ route('task.main') }}">Управление</a>
                    <a class="btn btn-outline-primary ms-3" href="{{ route('user.logout') }}">Выход</a>
                @else
                    <a class="btn btn-outline-primary" href="{{ route('user.login') }}">Войти</a>
                    <a class="btn btn-outline-dark ms-3" href="{{ route('user.registry') }}">Регистрация</a>
                @endauth
            </div>
        </div>
    </div>
</div>
<main>
    <section class="container">
        <div class="row py-lg-3">
            @include('includes.notifications')
            @yield('content')
        </div>
    </section>
</main>
<footer class="text-muted py-5">
    <div class="container">
        <p class="mb-1">Example (Laravel) - © Bootstrap</p>
    </div>
</footer>
<script defer="defer" src="{{ asset('js/app.js') }}"></script>
</body>
</html>
