<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('/images/favico.ico') }}">
    <link rel="stylesheet" href="{{ asset('/css/template.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/optional.css') }}">
</head>
<body>
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</body>
</html>