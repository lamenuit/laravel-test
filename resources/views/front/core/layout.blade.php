<!DOCTYPE html>
<html>
<head>
    <title></title>
    @if (isset($css_libs) && !empty($css_libs))
        @foreach ($css_libs as $css)
            <link rel="stylesheet" type="text/css" href="{{ asset($css) }}">
        @endforeach
    @endif
</head>
<body>
    <div class="container-fluid">
        @include('front.core.header')
    </div>

    <div class="container">
        @yield('main')
    </div>

    <div>
        @include('front.core.footer')
    </div>

    @if (isset($js_libs) && !empty($js_libs))
        @foreach ($js_libs as $js)
            <script type="text/javascript" src="{{ asset($js) }}"></script>
        @endforeach
    @endif
    @stack('after_scripts')
</body>
</html>