<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BYU Music Department</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/music.png') }}"/>
    <link rel="stylesheet" href="{{ asset('css/style/loginStyles/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style/img.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style/color.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style/nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style/font.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style/layout.css') }}">
    <link type="text/css" rel="stylesheet" href="//cloud.typography.com/75214/6517752/css/fonts.css" media="all" />
    <link rel="stylesheet" href="https://cdn.byu.edu/byu-theme-components/latest/byu-theme-components.min.css" />
    <script async src="https://cdn.byu.edu/byu-theme-components/latest/byu-theme-components.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="{{ asset('js/main.js') }}"></script>
</head>

<body>
    <byu-header>
        <span slot="site-title">BYU Music Department</span>
        <byu-search slot="search" action="https://www.google.com/#q=$1" method="get" placeholder="Search"></byu-search>
        <byu-user-info slot="user">
        <!-- TODO use BYU api to make the login work -->
            <a slot="login" href="#login">Sign In</a>
            <a slot="logout" href="#logout">Sign Out</a>
        </byu-user-info>
        <!-- TODO make a javascript file that adds the class active "after" a click -->
        <byu-menu slot="nav" class="transparent">
            <a href="{{ route('teacher') }}">Techer View</a>
            <a href="{{ route('student') }}">Student View</a>
        </byu-menu>
    </byu-header>

    <!-- Here is where the views are displayed is displayed  -->
    @yield('content')

    <byu-footer></byu-footer>
</body>

</html>