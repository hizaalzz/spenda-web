<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('/images/favico.ico') }}">
    <link rel="stylesheet" href="{{ asset('/css/template.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/optional.css') }}">
    <style>
        html {
            min-height: 100%;
        }

        body {
            height: 100vh;
        }

    </style>
</head>

<body>
    <div class="container-fluid h-100">
        <div class="row h-100">
            @yield('content')
        </div>
    </div>
    <script src="{{ asset('/js/dependencies.js') }}"></script>
    <script src="{{ asset('/js/app.js') }}"></script>
</body>

</html>
