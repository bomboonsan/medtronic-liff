<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Medtronic ConNEXT</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">


        @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    </head>
    <body class="bg-[#170F5F] text-white">
        <div class="h-full w-full flex justify-center items-center min-h-screen">
            <img id="homeLogo" class="home-logo hidden" height="300" src="{{ asset('img/logo-connext-white.png') }}" alt="" />
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                setTimeout(() => { 
                    const homeLogo = document.getElementById("homeLogo");
                    homeLogo.classList.remove("hidden");
                    homeLogo.classList.add("animation-logo");
                }, 700)
                
            });
        </script>
    </body>
</html>
