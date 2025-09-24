<!doctype html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    @vite(['resources/js/app.js', 'resources/css/app.css'])

    <style>
        * {
            font-family: Fusans, serif;
            direction: rtl;
        }
    </style>

    @stack('head')

</head>
<body>

@yield('body')

@stack('scripts')
</body>
</html>
