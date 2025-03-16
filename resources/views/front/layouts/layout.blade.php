<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, minimum-scale=1, maximum-scale=1" />

    <title>@yield('title') - Aortery</title>

    <link href="{{asset('front/images/favicon.png')}}" rel="icon" sizes="32x32" />
 @include('front.partials.css')

    <style>
        .cke_notifications_area {
            display: none !important;
        }
    </style>
</head>
<body>

@include('front.partials.header')

@yield('content')

@include('front.partials.bottom-bar')

@include('front.partials.footer')

@include('front.partials.script')
</html>
