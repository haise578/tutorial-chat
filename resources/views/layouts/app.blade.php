<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <title>@yield('title')</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand mr-auto" href="/">{{ Config::get('app.name', 'Application') }}</a>
        @if(Auth::check())
            <a class="navbar-brand" href="/user/{{ Auth::id() }}">
                <button class="btn btn-success" type="button">MyPage</button>
            </a>
        @endif
        <form method="POST" action="/logout" class="nav-item">
            @csrf
            <button class="btn btn-primary" type="submit">Logout</button>
        </form>
    </nav>
    <div class="container my-4">
        @yield('content')
    </div>
</body>
</html>
