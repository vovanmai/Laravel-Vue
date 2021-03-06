<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>window.Laravel = { csrfToken: '{{csrf_token()}}' }</script>
    <title>Larticles App</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="/css/app.css">


    <!-- Styles -->
</head>
<body>
    <div id="app">
        <div class="container">
            <articles></articles>
        </div>
        <router-link to="/">Home</router-link>
        <router-link to="/about">||About</router-link>
        <router-view></router-view>
    </div>
    <script src="/js/app.js"></script>
</body>
</html>
