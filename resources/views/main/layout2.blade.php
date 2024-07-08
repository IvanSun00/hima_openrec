<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Tailwind Element --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/tw-elements.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/css/tw-elements.min.css" />

    {{-- AOS --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link rel="icon" href="{{ asset('assets/img/logo-web.png') }}">

    {{-- FontAwesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    {{-- Swiper --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <style>
        @font-face {
            font-family: intro;
            src: url("{{ asset('assets/font/Intro.otf') }}") format('truetype');
        }

        * {
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --text: #D8CFC2;
            --bg: #2B2828;
        }

        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: #317AB6;
            background: linear-gradient(180deg,
                    #C1D6E2 0%,
                    #52BAC1 49%,
                    #317AB6 100%);
            border-radius: 8px;
        }

        ::-webkit-scrollbar-track {
            background-color: var(--bg);
        }

        body,
        html {
            overflow-x: hidden !important;
        }

        body {
            background: var(--black) !important;
            /* background: url("{{ asset('assets/img/background.png') }}");
            background-size: cover; */
            color: var(--text);
        }

        .font1 {
            font-family: intro;
        }

        .text-shadow {
            text-shadow: 5px 5px 2px rgba(0, 0, 0, 0.75);
        }

        canvas {
            width: 100%;
            height: 100%;
            background: var(--black) !important;
        }

        .bg-gradient {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -2;
        }

        .section-content {
            position: relative;
        }

        .section-content::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url("{{ asset('assets/img/background.png') }}") no-repeat center center;
            background-size: cover;
            opacity: 0.4;
            z-index: -1;
        }
    </style>

    @yield('styles')

</head>

<body class="p-0 m-0 overflow-x-hidden">

    <div class="bg-gradient">
        <canvas id="canvas" width="32" height="32"></canvas>
    </div>

    <div class="section-content flex flex-col items-center justify-center">
        @yield('content')
    </div>


    {{-- Tailwind --}}
    <script src="https://cdn.tailwindcss.com/3.3.0"></script>
    <!-- GSAP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/ScrollTrigger.min.js"></script>

    {{-- JQUERY --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

    {{-- AOS --}}
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    {{-- SweetAlert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Tailwind --}}
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>

    <!-- Swiper -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!-- Vanilla tilt -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.8.1/vanilla-tilt.min.js"></script>

    <script>
        let c = document.getElementById('canvas');
        let $ = c.getContext('2d');

        let col = function(x, y, r, g, b) {
            $.fillStyle = "rgb(" + r + "," + g + "," + b + ")";
            $.fillRect(x, y, 1, 1);
        }

        let R = function(x, y, t) {
            return (Math.floor(32 + 32 * Math.cos((x * x - y * y) / 300 + t)));
        }

        let G = function(x, y, t) {
            return (Math.floor(32 + 32 * Math.sin((x * x * Math.cos(t / 4) + y * y * Math.sin(t / 3)) / 300)));
        }

        let B = function(x, y, t) {
            return (Math.floor(32 + 32 * Math.sin(5 * Math.sin(t / 9) + ((x - 100) * (x - 100) + (y - 100) * (y -
                100)) / 1100)));
        }

        let t = 0;

        let run = function() {
            for (let x = 0; x <= 32; x++) {
                for (let y = 0; y <= 32; y++) {
                    col(x, y, R(x, y, t), G(x, y, t), B(x, y, t));
                }
            }
            t = t + 0.015;
            window.requestAnimationFrame(run);
        }

        run();
    </script>

    <script>
        AOS.init();
    </script>

    @yield('script')

</body>

</html>
