<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{asset('/site/imgs/icon.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('/site/css/main.css') }}?v={{time()}}">
    <title>Urstay | @yield('title')</title>
</head>
<body >
    <div class="@yield('body-class')">
        @include('includes.owner-header')
        @yield('content')
    </div>
    @include('includes.footer')

    <script src="{{ asset('site/js/listeners.js') }}?v={{time()}}"></script>
</body>
</html>
