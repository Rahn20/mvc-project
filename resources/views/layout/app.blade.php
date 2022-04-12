<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
         <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title> @yield('title') </title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="{{ url('/favicon.ico') }}">
        <link rel="stylesheet" type="text/css" href="{{ url('/styles/app.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ url('/styles/histogram.css') }}">
    </head>

<body>

    @include('layout.nav')

    <main>
        <div class="app">

            @yield('content')

        </div>
    </main>

    
    @include('layout.footer')

</body>
</html>