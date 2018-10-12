<!DOCTYPE html>
<html lang="en">

<head>
   @include('contents.header.header')
</head>

<body>
    @include('contents.navbar.navbar')
    @yield('content')
    <byu-footer></byu-footer>
</body>

</html>