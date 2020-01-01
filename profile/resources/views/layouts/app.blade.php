<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>hello laravel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
@include('include.navbar')
    <div class="container">
    @if(Request::is('/'))
        @include('include.showcase')
    @endif
        <div class="row">
            <div class="col-md-8 col-lg-8">
            @include('include.contact')
            @yield('content')
            </div>
        </div>
    </div>
</body>
</html>