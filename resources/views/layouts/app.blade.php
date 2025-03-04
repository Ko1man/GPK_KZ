<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF+6">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PKAI</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,700,800&display=swap" rel="stylesheet">
    <link href="{{asset('/circle/assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('/circle/assets/plugins/font-awesome/css/all.min.css')}}" rel="stylesheet">
    <link href="{{asset('/circle/assets/plugins/perfectscroll/perfect-scrollbar.css')}}" rel="stylesheet">
    <link href="{{asset('/circle/assets/css/custom.css')}}" rel="stylesheet">
    <link href="{{asset('/circle/assets/css/main.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('css/custom.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @stack('css')
    @vite(['resources/js/app.js'])
</head>
<body>
<div class="page-container">
    @include('layouts.header')
    @include('layouts.sidebar')
<div class="page-content">
        @yield('content')
    </div>
</div>

</body>
</html>
