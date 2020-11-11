<html>
<head>
    <title>@yield('title')</title>
    <link rel="stylesheet" type="text/css" href="/css/app.css"/>
</head>
<body>

    <div class="container">
        <div id="app">
            @yield('content')
        </div>
    </div>

    <script src="{{ asset('/js/app.js') }}"></script>
</body>
</html>
