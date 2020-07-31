<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user-id" content="{{ Auth::user() ? Auth::user()->id : 0 }}">
    <title>{{ config('app.name', 'DR Social Spot') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <v-app id="app">
        @yield('content')

        <footer-layout></footer-layout>
    </v-app>
    
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>