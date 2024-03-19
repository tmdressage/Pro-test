<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    @yield('css')
</head>

<body class="container">
    <header class="header">
        <div class="header__inner">
            <div class="header__menu">
                <button class="header__menu--button menu_button" type="button">
                    <span class="header__menu--button-line"></span>
                </button>
                <nav>
                    <ul class="menu">
                        @if (Auth::check())
                        @can('user')
                        <li class="menu-list"><a class="menu-text" href="/">Home</a></li>
                        <li class="menu-list"><a class="menu-text" href="/logout">Logout</a></li>
                        <li class="menu-list"><a class="menu-text" href="/mypage">Mypage</a></li>
                        @elsecan('admin')
                        <li class="menu-list"><a class="menu-text" href="/">Home</a></li>
                        <li class="menu-list"><a class="menu-text" href="/logout">Logout</a></li>
                        <li class="menu-list"><a class="menu-text" href="/admin">OwnerRegistration</a></li>
                        <li class="menu-list"><a class="menu-text" href="/import">CsvImport</a></li>
                        @elsecan('owner')
                        <li class="menu-list"><a class="menu-text" href="/">Home</a></li>
                        <li class="menu-list"><a class="menu-text" href="/logout">Logout</a></li>
                        <li class="menu-list"><a class="menu-text" href="/owner">ShopRegistration</a></li>
                        <li class="menu-list"><a class="menu-text" href="/reservation/status">ReservationStatus</a></li>
                        @endcan
                        @else
                        <li class="menu-list"><a class="menu-text" href="/">Home</a></li>
                        <li class="menu-list"><a class="menu-text" href="/register">Registration</a></li>
                        <li class="menu-list"><a class="menu-text" href="/login">Login</a></li>
                        @endif
                    </ul>
                </nav>
            </div>
            <h1 class="header__logo">
                Rese
            </h1>
        </div>
    </header>
    <main>
        @yield('content')
    </main>
</body>

</html>