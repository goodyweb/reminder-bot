<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}"> 
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />

        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-black-900 antialiased">

    <video class="bg-video" playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop"><source src="assets/mp4/bg.mp4" type="video/mp4" /></video>
        <!-- Masthead-->
        <div class="masthead1 " >
            <div class="masthead1-content text-dark">
                <div class="container-fluid ">
                <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-light shadow-md overflow-hidden sm:rounded-lg" style="--bs-bg-opacity: .6;">
            <div>
            <div class="bg-light shadow-md overflow-hidden sm:rounded-lg min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-light-100" style="--bs-bg-opacity: .5;">
            <div>
                <a href="/">
                <img src="assets/img/goody.png" width="200px" height="100px">
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-light shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
                </div>
            </div>
        </div>




        
    </body>
</html>