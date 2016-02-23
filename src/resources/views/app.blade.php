<!DOCTYPE html>
<html lang="en">
<head>
    <title>Travel Share</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name=description content="Share and explore travel destinations around the world with others" />
    <meta name="keywords" content="Travel, Share, travelshare, explore, destinations, users, discover, places, connect, world, flyers, travelflyers" />
    <meta name="author" content="David Trushkov" />
    <link rel="shortcut icon" href="{!! asset('/src/public/css/Travel-Share-Icon.png') !!}" />

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>


    <link rel="stylesheet" href="{{ URL::asset('src/public/css/libs/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('src/public/css/libs/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('src/public/css/app.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('src/public/css/homenavigation.css') }}">
    <link rel="stylesheet" type="text/css" href="/travel/src/semantic/dist/semantic.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/dropzone.css">

</head>

<body>

    @include('pages.partials.homenavigation')


    @yield('content')


<!-- JavaScripts -->
<script src="{{ URL::asset('src/public/js/libs/jquery.js') }}"></script>
<script type="text/javascript" src={{ URL::asset('src/public/js/libs/bootstrap.js') }}></script>
<script src="{{ URL::asset('src/public/js/libs/sweetalert.js') }}"></script>
<script src="{{ URL::asset('src/public/js/libs/FitText.js') }}"></script>
<script src="{{ URL::asset('src/public/js/main.js') }}"></script>
<script src="/travel/src/semantic/dist/semantic.min.js"></script>

@include('pages.partials.footer')
@yield('scripts.footer')
@include('flash')

</body>
</html>
