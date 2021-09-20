<!doctype html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Custom CSS -->

        <link id="" rel="shortcut icon" href="/favicon.ico?" />
        {{-- <title id="title"></title> --}}

    </head>
    <body>
        <div id="app">
            <layout></layout>
            <router-view></router-view>


        </div>

        <script src="/js/app.js"></script>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->


        <!--Pcr form script ends -->

    </body>
</html>
