@extends('main.layout2')
@section('styles')
    <title>Pendaftar | {{ $title }}</title>

    <style>
        .button {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 9px 12px;
            gap: 8px;
            height: 40px;
            width: 100%;
            border: none;
            background: #317AB6;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
            z-index: 300;
        }

        .svg-icon {
            fill: white;
        }

        .lable {
            line-height: 22px;
            color: #fff;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .button:hover {
            background: #fff;
            color: #317AB6;
            border: 1px solid #317AB6;
        }

        .button:hover .lable {
            /* background: #fff; */
            color: #317AB6;
        }

        .button:hover .svg-icon {
            animation: slope 1s linear infinite;
            fill: #317AB6;
        }

        #loginForm {
            backdrop-filter: blur(50px);
            background: rgba(255, 255, 255, 0.1);
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
    </style>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
@endsection
@section('content')
    {{-- <div id="cursor"></div>
    <div id="cursor_2"></div> --}}

    {{-- back btn --}}
    <div class="fixed top-8 left-8">
        <a href="{{ route('home') }}">
            <button type="button"
                class="bg-white text-center w-48 rounded-2xl h-14 relative font-sans text-black text-xl font-semibold group">
                <div
                    class="bg-[#52BAC1] rounded-xl h-12 w-1/4 flex items-center justify-center absolute left-1 top-[4px] group-hover:w-[184px] z-10 duration-500">
                    <svg width="25px" height="25px" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg">
                        <path fill="#000000" d="M224 480h640a32 32 0 1 1 0 64H224a32 32 0 0 1 0-64z"></path>
                        <path fill="#000000"
                            d="m237.248 512 265.408 265.344a32 32 0 0 1-45.312 45.312l-288-288a32 32 0 0 1 0-45.312l288-288a32 32 0 1 1 45.312 45.312L237.248 512z">
                        </path>
                    </svg>
                </div>
                <p class="translate-x-2 text-md">Go Back</p>
            </button>
        </a>

    </div>



    <section class="w-9/12 min-h-[100svh] py-8 sm:py-0 flex flex-col justify-center items-center text-center">
        <div class="card w-[80vw] md:max-w-[700px] min-h-[300px] rounded-md overflow-hidden relative flex justify-center items-center"
            data-aos="fade-up" data-aos-duration="1000">
            <div
                class="card-content px-8 py-4 relative z-1 flex flex-col gap-4 justify-center items-center text-center h-full text-white">
                <p class="card-title uppercase font-bold text-3xl md:text-5xl font1 tracking-wider">Open Registration
                    HIMAINFRA 2024
                </p>
                <a href= '{{ route('google.redirect') }}' class="mt-4 w-full">
                    <button class="button" id="login">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="svg-icon"
                            viewBox="0 0 16 16">
                            <path
                                d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z">
                            </path>
                        </svg>
                        <span class="lable text-sm xl:text-lg">Login With Google</span>
                    </button>
                </a>
            </div>
        </div>

    </section>
    {{-- <div id="g_id_onload"
            data-client_id="{{ env('GOOGLE_CLIENT_ID') }}"
            data-context="signin"
            data-ux_mode="redirect"
            data-login_uri="{{ route('processLogin') }}"
            data-auto_prompt="false">
        </div>

        <div class="g_id_signin"
            data-type="standard"
            data-shape="rectangular"
            data-theme="outline"
            data-text="signin_with"
            data-size="large"
            data-logo_alignment="left"
        >
        </div> --}}
    <!-- Add this to your HTML body -->
    {{-- <div id="g_id_onload" data-client_id="{{ env('GOOGLE_CLIENT_ID') }}" data-context="signin" data-auto_prompt="false"></div>
        <div class="g_id_signin" data-type="standard" data-shape="rectangular" data-theme="outline" data-text="signin_with" data-size="large" data-logo_alignment="left"></div> --}}

    </div>
@endsection

@section('script')
    <script>
        AOS.init();
        $(document).ready(function() {
            @if (Session::has('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Oopss...',
                    text: '{{ Session::get('error') }}',
                    showConfirmButton: false,
                    timer: 2500
                });
            @endif
            // $('#login').click(function() {
            //     $('.g_id_signin').click();
            // });
        });
    </script>
    <!-- Add this to your HTML body or in a separate script -->
    <script>
        // Load the Google Sign-In API
        // google.accounts.id.initialize({
        // client_id: '{{ env('GOOGLE_CLIENT_ID') }}', // Replace with your client ID
        // callback: handleCredentialResponse, // Your callback function
        // cancel_on_tap_outside: false,
        // });

        // // Callback function to handle the response
        // function handleCredentialResponse(response) {
        // if (response.credential) {
        //     // Successfully obtained user credentials
        //     console.log('Credential:', response.credential);

        //     // You can now send the credential to your server for verification
        //     // Example: sendCredentialToServer(response.credential);
        // } else {
        //     // Handle the case where the user canceled the sign-in
        //     console.log('Sign-in canceled');
        // }
        // }

        // // Function to initiate Google Sign-In
        // function startGoogleSignIn() {
        // var signinOptions = {
        //     prompt_parent_id: 'g_id_onload', // ID of the container where the button will be rendered
        //     bubbleId: 'g_id_signin', // ID of the button container
        // };

        // google.accounts.id.prompt(signinOptions);
        // }
    </script>

    </html>
@endsection
