<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
    <head>
        <meta charset="utf-8" >
        <meta name="viewport" content="width=device-width, initial-scale=1" >

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}" >

        <title>{{ config( "app.name", "Laravel" ) }}</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com" >
        <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet" >

        <!-- Scripts -->
        @vite( [ "resources/sass/app.scss", "resources/js/app.js" ] )

        <style>
            @font-face {
                font-family: TheLastKingdom;
                src: url( "/font/The_Last_Kingdom.ttf" ) format( "truetype" );
            }

            body {
                background-image: url( "/assets/graphic/background/bg-image.jpg" );
                background-size: cover;
                background-repeat: no-repeat;
                background-position: top center;
                background-attachment: fixed;
            }

            #km-main {
                font-family: "TheLastKingdom", "Nunito", sans-serif !important;
                font-size: calc( 2.5rem + 0.39vw ) !important;
            }
            #app .card {
                background-image: url( "/assets/graphic/background/main.jpg" );
                background-repeat: repeat;
            }
            #app .card button {
                background-image: url( "/assets/graphic/background/content.jpg" );
                background-repeat: repeat;
            }
        </style>
    </head>
    <body>
        <div id="app" >
            <main class="vh-100 py-4" >
                @yield( "content" )
            </main>
        </div>
    </body>
</html>
