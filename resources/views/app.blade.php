<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- FontFace CSS -->
        <link href="/fonts/stylesheet.css" rel="stylesheet">

        <!-- Slick SLider CSS -->
        <link rel="stylesheet" href="/css/slick.css" />
        <link href="/css/select2.css" rel="stylesheet">
        @if (app()->getLocale() == 'en')
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="/css/bootstrap.min.css" >
        <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">
        <!-- Custom CSS -->
        <link href="/css/style.css" rel="stylesheet">
        @else
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="/css/bootstrap.min_AR.css" >
        <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">
        <!-- Custom CSS -->
        <link href="/css/style_AR.css" rel="stylesheet">
        @endif
        <link href="/css/custom-dev-style.css" rel="stylesheet">

        <!-- Q-tip Plugin -->
        <link href="/css/qtip.css" rel="stylesheet">

        <!-- FontAwesome CSS -->
        <script src="https://kit.fontawesome.com/667634235d.js" crossorigin="anonymous"></script>
        <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />


        <link id="" rel="shortcut icon" href="/favicon.ico?" />
        {{-- <title id="title"></title> --}}

    </head>
    <body>
        <div id="app">
            <app></app>


        </div>

        <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->


        <!--Pcr form script ends -->

    </body>
</html>
