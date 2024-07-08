@extends('main/layout2')

@section('styles')
    <title>OPEN RECRUITMENT | HIMAINFRA 2024/2025</title>

    <style>
        svg text {
            text-transform: uppercase;
            animation: stroke 3s alternate;
            stroke-width: 4;
            stroke: var(--bg);
            fill: var(--text);
            color: #000;
        }

        @keyframes stroke {
            0% {
                fill: rgba(255, 200, 0, 0);
                stroke: var(--bg);
                stroke-dashoffset: 25%;
                stroke-dasharray: 0 50%;
                stroke-width: 1;
            }

            70% {
                fill: rgba(255, 200, 0, 0);
                stroke: var(--bg);
            }

            80% {
                fill: rgba(255, 200, 0, 0);
                stroke: var(--bg);
                stroke-width: 2;
            }

            100% {
                fill: var(--text);
                stroke: var(--bg);
                stroke-dashoffset: -25%;
                stroke-dasharray: 50% 0;
                stroke-width: 4;
            }
        }

        .card {
            /* background-color: #F8A348;
                                                                                                                background-image: linear-gradient(43deg, #F8A348 0%, #C61F6D 100%); */
            transition: all 0.5s cubic-bezier(0.23, 1, 0.320, 1);
            background-color: rgba(255, 255, 255, 0.074);
            border: 1px solid rgba(255, 255, 255, 0.222);
            -webkit-backdrop-filter: blur(20px);
            backdrop-filter: blur(20px);
        }

        .card:hover {
            transform: rotateY(10deg) rotateX(10deg) scale(1.05);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .card:before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.1));
            transition: transform 0.5s cubic-bezier(0.23, 1, 0.320, 1);
            z-index: 1;
        }

        .card:hover:before {
            transform: translateX(-100%);
        }

        .card:after {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.1));
            transition: transform 0.5s cubic-bezier(0.23, 1, 0.320, 1);
            z-index: 1;
        }

        .card:hover:after {
            transform: translateX(100%);
        }

        .waviy {
            -webkit-box-reflect: below -20px linear-gradient(transparent, rgba(0, 0, 0, .1));
        }

        .waviy span {
            display: inline-block;
            animation: waviy 2s infinite;
            animation-delay: calc(.1s * var(--i));
        }

        @keyframes waviy {

            0%,
            40%,
            100% {
                transform: translateY(0)
            }

            20% {
                transform: translateY(-20px)
            }
        }

        .swiper-wrapper {
            transition: transform 0.5s ease-out;
        }

        .swiper-slide {
            width: 260px;
            height: 320px;
            border-radius: 15px;
        }

        .tilt-card {
            width: 260px;
            height: 320px;
            border-radius: 15px;
            box-shadow: 10px 10px 30px rgba(0, 0, 0, 0.5);
            background: rgba(255, 255, 255, 0.1);
            display: flex;
            justify-content: center;
            align-items: center;
            border-top: 1px solid rgba(255, 255, 255, 0.5);
            border-left: 1px solid rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(5px);
        }

        .xr:hover {
            background: rgba(245, 132, 3, 0.2);
        }

        .cnb:hover {
            background: rgba(128, 0, 255, 0.2);
        }

        .id:hover {
            background: rgba(255, 0, 136, 0.2);
        }

        .is:hover {
            background: rgba(0, 145, 255, 0.2);
        }

        .hrd:hover {
            background: rgba(0, 255, 72, 0.2);
        }

        .academic:hover {
            background: rgba(255, 0, 0, 0.2);
        }

        .swiper-slide .content {
            padding: 20px;
            text-align: center;
        }

        .swiper-slide .content img {
            width: 160px;
            opacity: 0.2;
            position: absolute;
        }
    </style>

    @include('main.partial.star')
@endsection

@section('content')
    <nav
        class="flex-no-wrap flex w-full items-center justify-between py-2 shadow-md shadow-black lg:flex-wrap lg:justify-start lg:py-4 absolute top-0">
        <div class="flex w-full flex-wrap items-center justify-between px-5">

            <!-- Collapsible navigation container -->
            <div class="flex flex-grow justify-between items-center lg:!flex lg:basis-auto" id="navbarSupportedContent1"
                data-te-collapse-item>
                <!-- Logo -->
                <a class="mb-2 ml-2 mt-1 flex items-center text-neutral-900 hover:text-neutral-900 focus:text-neutral-900 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:text-neutral-400 lg:mb-0 lg:mt-0 w-fit"
                    href="#">
                    <img src="{{ asset('assets/img/logo-web.png') }}" style="height: 36px" alt="Logo HIMA" loading="lazy" />
                </a>
            </div>

            <!-- Right elements -->
            <div class="relative flex items-center">
                <!-- Second dropdown container -->
                <div class="relative" data-te-dropdown-alignment="end">
                    <a href="{{ route('login') }}">
                        <p class="text-white text-md sm:text-lg">Login</p>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <section class="w-screen">
        <div id="stars"></div>
        <div id="stars2"></div>
    </section>

    <section class="w-9/12 min-h-[100svh] py-8 sm:py-0 flex flex-col justify-center items-center text-center">
        {{-- <h1 class="text-9xl font1 tracking-wide text-shadow">HIMAINFRA</h1>
        <h1 class="text-7xl font1 tracking-wide text-shadow">24/25</h1> --}}
        <div class="title" id="title">
            <svg viewBox="0 0 1320 300" class="w-screen h-full">
                <text x="50%" y="30%" dy=".35em" text-anchor="middle"
                    class="font1 text-[12rem] sm:text-9xl">HIMAINFRA</text>
                <text x="50%" y="80%" dy=".35em" text-anchor="middle" class="font1 text-[9rem] sm:text-8xl">
                    2024-2025
                </text>
            </svg>
        </div>
    </section>

    <section class="w-9/12 min-h-[100svh] py-8 sm:py-0 flex flex-col justify-center items-center text-center"
        id="grow-section">
        {{-- <h1 class="text-9xl font1 tracking-wide text-shadow">#GROW</h1> --}}
        <div class="waviy text-5xl sm:text-7xl xl:text-9xl font1 text-shadow" data-aos="zoom-in-down"
            data-aos-duration="1000">
            <span style="--i:1">#</span>
            <span style="--i:2">G</span>
            <span style="--i:3">R</span>
            <span style="--i:4">O</span>
            <span style="--i:5">W</span>

        </div>
        <h1 class="text-3xl sm:text-5xl font1 tracking-wide text-shadow text-white mt-8 h-10" id="grow-type"></h1>
    </section>

    <section class="w-9/12 min-h-[100svh] py-8 sm:py-0 flex flex-col justify-center items-center text-center">
        <div class="grid grid-rows-2 lg:grid-rows-1 lg:grid-cols-2 w-full flex items-center justify-center gap-12">
            <div class="card w-full h-full rounded-md overflow-hidden relative" data-aos="fade-right"
                data-aos-duration="1000">
                <div
                    class="card-content px-8 py-4 relative z-1 flex flex-col gap-4 justify-center text-center h-full text-white">
                    <p class="card-title uppercase font-bold text-4xl sm:text-5xl font1 tracking-wider">Visi
                    </p>
                    <p class="card-para text-md sm:text-lg">Menjadi HIMA yang memperkaya mahasiswa dengan <b>keterampilan
                            organisasi</b>, <b>pengembangan diri</b>, dan <b>dorongan untuk melayani</b> berlandaskan iman
                        Kristiani.</p>
                </div>
            </div>
            <div class="card w-full h-full rounded-md overflow-hidden relative" data-aos="fade-left"
                data-aos-duration="1000">
                <div
                    class="card-content px-8 py-4 relative z-1 flex flex-col gap-4 justify-center text-center h-full text-white">
                    <p class="card-title uppercase font-bold text-4xl sm:text-5xl font1 tracking-wider">Misi
                    </p>

                    <ol class="text-left sm:text-justify list-decimal ml-6">
                        <li>
                            <p class="card-para text-md sm:text-lg">Meningkatkan kualitas mahasiswa Informatika di bidang
                                organisasi
                            </p>
                        </li>
                        <li>
                            <p class="card-para text-md sm:text-lg">Membangkitkan lingkungan penuh rasa hormat antar civitas
                                Informatika Petra</p>
                        </li>
                        <li>
                            <p class="card-para text-md sm:text-lg">Menghidupi nilai-nilai Kristiani dalam setiap kegiatan
                                HIMAINFRA
                            </p>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="w-screen min-h-[100svh] py-8 sm:py-0 flex flex-col justify-center items-center text-center">
        <h1 class="text-4xl sm:text-7xl xl:text-9xl font1 tracking-wide text-shadow">DEPARTMENTS</h1>
        <div class="swiper-container w-full h-full overflow-hidden py-4 sm:py-8 mt-8 sm:mt-0">
            <div class="swiper-wrapper text-md text-white">
                <div class="swiper-slide">
                    <div class="tilt-card academic">
                        <div class="content">
                            <img src="{{ asset('assets/img/academic.png') }}" alt="" class="top-2 right-2">
                            <h3 class="uppercase drop-shadow-[0_1.2px_1.2px_rgba(0,0,0,0.8)] font1 text-3xl">
                                Academic</h3>
                            <p class="text-md sm:text-lg text-white mt-2">Mewadahi pengembangan mahasiswa Informatika dalam
                                hal akademik, baik melalui
                                pelatihan maupun workshop.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="tilt-card hrd">
                        <div class="content">
                            <img src="{{ asset('assets/img/hrd.png') }}" alt="" class="top-2 right-2">
                            <h3 class="uppercase drop-shadow-[0_1.2px_1.2px_rgba(0,0,0,0.8)] font1 text-3xl">
                                Human Resources Development</h3>
                            <p class="text-md sm:text-lg text-white mt-2">Mewadahi pengembangan mahasiswa Informatika secara
                                softskill dan potensi-potensi non-akademik lainnya.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="tilt-card id">
                        <div class="content">
                            <img src="{{ asset('assets/img/id.png') }}" alt="" class="top-2 right-2">
                            <h3 class="uppercase drop-shadow-[0_1.2px_1.2px_rgba(0,0,0,0.8)] font1 text-3xl">
                                Internal Development</h3>
                            <p class="text-md sm:text-lg text-white mt-2">Mewadahi hubungan dan pertumbuhan internal
                                mahasiswa Informatika.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="tilt-card cnb">
                        <div class="content">
                            <img src="{{ asset('assets/img/cnb.png') }}" alt="" class="top-2 right-2">
                            <h3 class="uppercase drop-shadow-[0_1.2px_1.2px_rgba(0,0,0,0.8)] font1 text-3xl">
                                Creative n Branding</h3>
                            <p class="text-md sm:text-lg text-white mt-2">Mewadahi pengelolaan dan publikasi seputar kegiatan HIMA dan prodi Informatika melalui media sosial.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="tilt-card is">
                        <div class="content">
                            <img src="{{ asset('assets/img/is.png') }}" alt="" class="top-2 right-2">
                            <h3 class="uppercase drop-shadow-[0_1.2px_1.2px_rgba(0,0,0,0.8)] font1 text-3xl">
                                Information System</h3>
                            <p class="text-md sm:text-lg text-white mt-2">Mewadahi pengelolaan website HIMA dan data dari mahasiswa prodi Informatika.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="tilt-card xr">
                        <div class="content">
                            <img src="{{ asset('assets/img/prd.png') }}" alt="" class="top-2 right-2">
                            <h3 class="uppercase drop-shadow-[0_1.2px_1.2px_rgba(0,0,0,0.8)] font1 text-3xl">
                                External Relation</h3>
                            <p class="text-md sm:text-lg text-white mt-2">Mewadahi kebutuhan mahasiswa Informatika secara
                                relasi dengan pihak-pihak luar dan dengan masyarakat.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section class="w-9/12 min-h-[100svh] py-8 sm:py-0 flex flex-col justify-center items-center text-center">
        <h1 class="text-5xl sm:text-7xl xl:text-9xl font1 tracking-wide text-shadow" data-aos="zoom-in-up"
            data-aos-duration="1000">JOIN NOW!</h1>
        <ol class="border-s border-white mt-10" data-aos="zoom-in-down" data-aos-easing="linear"
            data-aos-duration="1000">
            <li>
                <div class="flex-start flex items-center pt-3">
                    <div class="-ms-[5px] me-3 h-[9px] w-[9px] rounded-full bg-white"></div>
                    <p class="text-md sm:text-lg text-white">
                        09 July - 20 July 2024
                    </p>
                </div>
                <div class="mb-6 ms-4 mt-2 text-left">
                    <h4 class="mb-1.5 text-xl sm:text-3xl font-semibold text-white">Open Registration</h4>
                    <a href="{{ route('login') }}">
                        <button
                            class="mt-4 ml-1 cursor-pointer text-white font-bold relative text-[14px] w-[9em] h-[3em] text-center bg-gradient-to-r from-violet-500 from-10% via-sky-500 via-30% to-pink-500 to-90% bg-[length:400%] rounded-[30px] z-10 hover:animate-gradient-xy hover:bg-[length:100%] before:content-[''] before:absolute before:-top-[5px] before:-bottom-[5px] before:-left-[5px] before:-right-[5px] before:bg-gradient-to-r before:from-violet-500 before:from-10% before:via-sky-500 before:via-30% before:to-pink-500 before:bg-[length:400%] before:-z-10 before:rounded-[35px] before:hover:blur-xl before:transition-all before:ease-in-out before:duration-[1s] before:hover:bg-[length:10%] active:bg-violet-700 focus:ring-violet-700">
                            REGIST HERE!
                        </button>
                    </a>


                </div>


            </li>

            <li>
                <div class="flex-start flex items-center pt-8">
                    <div class="-ms-[5px] me-3 h-[9px] w-[9px] rounded-full bg-white"></div>
                    <p class="text-md sm:text-lg text-white">
                        10 July - 21 July 2024
                    </p>
                </div>
                <div class="mb-6 ms-4 mt-2 text-left">
                    <h4 class="mb-1.5 text-xl sm:text-3xl font-semibold text-white">Interview</h4>
                </div>
            </li>
        </ol>
    </section>
@endsection

@section('script')
    {{-- Grow Type --}}
    <script>
        const texts = ["Gallant", "Reverent", "Orderly", "Wholesome"];
        const typingContainer = document.getElementById("grow-type");
        let currentTextIndex = 0;
        let currentText = "";
        let isDeleting = false;
        let typingSpeed = 125;
        let animationStarted = false;

        function type() {
            const text = texts[currentTextIndex];
            if (isDeleting) {
                currentText = text.substring(0, currentText.length - 1);
            } else {
                currentText = text.substring(0, currentText.length + 1);
            }

            typingContainer.innerHTML = currentText;

            let typingDelay = isDeleting ? typingSpeed / 2 : typingSpeed;

            if (!isDeleting && currentText === text) {
                typingDelay = 2500;
                isDeleting = true;
            } else if (isDeleting && currentText === "") {
                isDeleting = false;
                currentTextIndex++;
                if (currentTextIndex === texts.length) {
                    currentTextIndex = 0;
                }
            }

            setTimeout(type, typingDelay);
        }

        function checkIfInView() {
            const growSection = document.getElementById('grow-section');
            const rect = growSection.getBoundingClientRect();
            const windowHeight = (window.innerHeight || document.documentElement.clientHeight);

            if (rect.top <= windowHeight && rect.bottom >= 0) {
                if (!animationStarted) {
                    animationStarted = true;
                    type();
                }
            }
        }

        window.addEventListener('scroll', checkIfInView);
        document.addEventListener("DOMContentLoaded", checkIfInView);
    </script>

    <script>
        gsap.registerPlugin(ScrollTrigger);

        const initSwiper = () => {
            const swiper = new Swiper('.swiper-container', {
                loop: 'true',
                slidesPerView: 'auto',
                spaceBetween: 20,
                initialSlide: 3,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                scrollbar: {
                    el: '.swiper-scrollbar',
                    draggable: true,
                },
                breakpoints: {
                    768: {
                        spaceBetween: 50,
                    },
                    1096: {
                        spaceBetween: 100,
                    },
                },
            });


            gsap.from('.swiper-slide', {
                xPercent: -100,
                ease: 'power1.inOut',
                scrollTrigger: {
                    trigger: '.swiper-container',
                    scrub: true,

                },
            });
        };

        const showDemo = () => {
            initSwiper();
        };

        showDemo();
    </script>

    <!-- Vanilla tilt -->
    <script>
        VanillaTilt.init(document.querySelectorAll(".tilt-card"), {
            max: 25,
            speed: 400,
            glare: true,
            "max-glare": 0.8,
        });
    </script>
@endsection
