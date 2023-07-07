<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'ToDo')</title>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="{{ asset('css/styleSearch.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styleTable.css') }}" rel="stylesheet">
    <script src="{{ asset('js/search.js') }}"></script>
    <script src="{{ asset('js/modalList.js') }}"></script>
</head>
<body>
{{View::make('layouts.header')}}
@yield('content')
</body>
</html>
{{--<body style="background-image: url(https://i.artfile.ru/1920x1080_1310772_[www.ArtFile.ru].jpg); height: 100%;">--}}
