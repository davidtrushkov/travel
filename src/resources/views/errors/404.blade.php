@extends('home')

@section('content')

    @include('pages.partials.navigation')


    <div class="container" style="padding-bottom: 37%">
        <h1>Page Not Found</h1>
        <a href="{{ URL('/') }}">Go to homepage.</a>
    </div>


@stop