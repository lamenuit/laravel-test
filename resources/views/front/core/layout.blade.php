<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <div>
        @include('front.core.header')
    </div>

    @yield('main')

    <div>
        @include('front.core.footer')
    </div>
</body>
</html>