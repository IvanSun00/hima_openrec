<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Pendaftar {{ isset($title) ? '| ' . $title : '' }}</title>

    <!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/tw-elements.min.css" />
    <script src="https://cdn.tailwindcss.com/3.3.0"></script>
    <link href="https://fonts.googleapis.com/css2?family=Asap:wght@400;600;700;800&display=swap" rel="stylesheet">

    <link rel="icon" href="{{ asset('assets/img/logo-web.png') }}">

    <style>
        @font-face {
            font-family: intro;
            src: url("{{ asset('assets/font/intro.otf') }}") format('truetype');
        }

        body,
        html {
            overflow-x: hidden !important;
        }

        body {
            background: var(--bg);
            background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
                url("{{ asset('assets/img/background.png') }}");
            background-size: cover;
            color: var(--text);
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

        .font1 {
            font-family: intro;
        }

        .text-shadow {
            text-shadow: 5px 5px 2px rgba(0, 0, 0, 0.75);
        }

        label {
            color: #fff !important;
        }

        input,
        textarea,
        select {
            color: #F8A348 !important;
        }

        input:focused {
            outline: #F8A348 !important;
        }

        form svg {
            stroke: #fff !important;
        }

        form button[id*='datepicker-toggle'] svg {
            fill: #fff !important;
        }

        [type=button],
        [type=reset],
        [type=submit],
        button {
            -webkit-appearance: button;
            background-color: #F8A348;
            background-image: none;
        }

        input:disabled,
        textarea:disabled {
            background: #aaaaaa50 !important;
        }

        input:-webkit-autofill,
        textarea:-webkit-autofill,
        select:-webkit-autofill {
            -webkit-box-shadow: 0 0 0px 1000px var(--bg) inset !important;
            -webkit-text-fill-color: #F8A348 !important;
            transition: background-color 5000s ease-in-out 0s;
        }
    </style>

    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                fontFamily: {
                    'asap': ["Asap"],
                    'dillan': ["dillan"],
                },
            },
            corePlugins: {
                preflight: false,
            },
        };
    </script>

    @yield('styles')
</head>

<body>
    <!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com -->
    <!-- Main navigation container -->
    <nav
        class="flex-no-wrap relative flex w-full items-center justify-between py-2 shadow-md shadow-black/5 dark:bg-neutral-600 dark:shadow-black/10 lg:flex-wrap lg:justify-start lg:py-4">
        <div class="flex w-full flex-wrap items-center justify-between px-2 md:px-5">

            <!-- Collapsible navigation container -->
            <div class="flex flex-grow justify-between items-center lg:!flex lg:basis-auto" id="navbarSupportedContent1"
                data-te-collapse-item>
                <!-- Logo -->
                <a class="mb-2 ml-2 mt-1 flex items-center text-neutral-900 hover:text-neutral-900 focus:text-neutral-900 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:text-neutral-400 lg:mb-0 lg:mt-0 w-fit"
                    href="#">
                    <img src="{{ asset('assets/img/logo-web.png') }}" style="height: 36px" alt="Logo HIMA"
                        loading="lazy" />
                </a>
                {{-- @if (Session::has('isAdmin') && session('isAdmin'))
                    <ul class="list-style-none mx-auto flex flex-col pl-0 lg:flex-row" data-te-navbar-nav-ref>
                        <li class="lg:mb-0 lg:pr-2" data-te-nav-item-ref>
                            <a class="transition duration-200 hover:text-neutral-300 hover:ease-in-out focus:text-neutral-700 disabled:text-black/30 motion-reduce:transition-none dark:text-neutral-200 dark:hover:text-neutral-300 dark:focus:text-neutral-300 lg:px-2 [&.active]:text-black/90 dark:[&.active]:text-neutral-400 text-white text-center"
                                href="{{ route('admin.dashboard') }}" data-te-nav-link-ref>Admin Page</a>
                        </li>
                    </ul>
                @endif --}}
            </div>

            <!-- Right elements -->
            <div class="relative flex items-center">
                <!-- Second dropdown container -->
                <div class="relative" data-te-dropdown-alignment="end">
                    <a href="{{ route('logout') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="#fbfbfb" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <main class="lg:px-16 px-3 pt-8">
        {{-- @yield('stepper') --}}
        @yield('content')
    </main>

    <!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com -->
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @yield('scripts')
</body>

</html>
