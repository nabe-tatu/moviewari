<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            width: 100%;
            height: 100%;
            color: black;
            background-color: #1b1e21;
            background-image: url(/img/theater.jpg);
            background-repeat: no-repeat;
            background-size: cover;/* contain → cover　*/
            background-position: center center;/* 追加　*/
            background-attachment: fixed;
        }
    </style>
</head>
<body>
<div id="app">
    <general-page></general-page>
</div>
</body>
</html>



<script>
    import GeneralPage from "../js/components/GeneralPage";
    export default {
        components: {GeneralPage}
    }
</script>
