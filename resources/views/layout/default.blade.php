<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $title }} | {{ env('APP_NAME') }}</title>

        <meta property="og:title" content="{{ $title }} | {{ env('APP_NAME') }}">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:site_name" content="Example">
        <meta property="og:description" content="{{ $description ?? '' }}">
        <meta name="description" content="{{ $description ?? '' }}">
        <meta name="robots" content="noindex,nofollow">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="canonical" href="{{ url()->current() }}">
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

        @auth
            <script>
                const Laravel = {
                    'user': '{{ auth()->user()->getAuthIdentifier() }}'
                };
            </script>
        @endauth
        @vite([
            'resources/css/app.sass',
            'resources/js/app.js'
        ])
    </head>
    <body>
        <div class="p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
            <div class="container">
                <div class="d-flex align-items-center justify-content-between">
                    <a class="h5 my-0 mr-md-auto text-decoration-none text-dark" href="{{ route('index') }}">{{ env('APP_NAME') }}</a>
                    <div class="d-flex">
                        @auth
                            <a class="btn btn-outline-success" href="{{ route('task.index', ['view' => 'user']) }}">Управление</a>
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
                    @include('include.notification')
                    @yield('content')
                </div>
            </section>
        </main>
        <footer class="text-muted py-5">
            <div class="container">
                <p class="mb-1">&copy; {{ env('APP_NAME') }} (Laravel) {{ \Carbon\Carbon::now()->year }}</p>
            </div>
        </footer>
    </body>
</html>
