<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/scss/app.scss', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="min-h-screen bg-neutral-50">
        
        <div class="event-page">
            <div class="max-w-screen-md mx-auto p-3">
                @if(session('success'))
                    <div class="alert alert-success mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-error mb-4">
                        {{ session('error') }}
                    </div>
                @endif
                <article class="article-container">                                       
                    @if ($event->thumbnail)
                        <figure class="block w-full mb-5">
                            <img class="w-full h-auto" src="{{ asset($event->thumbnail) }}" alt="">
                        </figure>             
                    @endif
                    <div class="py-3 px-4">
                        <h1>{{ $event->title }}</h1>
                    </div> 
                    <div class="article-body">                        
                        {!! $event->description !!}
                        <div class="mt-5">
                            <p>
                                <strong>Date : {{ $event->start_date_formatted }} - {{ $event->end_date_formatted }}</strong>
                            </p>
                        </div>
                    </div>                          
                    <div class="mt-5 text-center">
                        <form id="register-event" action="{{ route('event_user_registers.store') }}" method="POST">
                            @csrf
                            {{-- Dev --}}
                            {{-- <input type="hidden" name="line_token" value="Ue003cf1394a776ed6898a14ed554a3ab" required> --}}
                            {{-- Pro --}}
                            <input type="hidden" name="line_token" value="">
                            <input type="hidden" name="event_id" value="{{ $event->id }}" required>
                            <input type="hidden" name="status" value="register">
                            <button id="submit-btn" type="submit" class="btn btn-wide bg-primary hover:bg-[#3868B2] text-white text-xl">
                                Register
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24" fill="#FFF"><path d="M438-226 296-368l58-58 84 84 168-168 58 58-226 226ZM200-80q-33 0-56.5-23.5T120-160v-560q0-33 23.5-56.5T200-800h40v-80h80v80h320v-80h80v80h40q33 0 56.5 23.5T840-720v560q0 33-23.5 56.5T760-80H200Zm0-80h560v-400H200v400Zm0-480h560v-80H200v80Zm0 0v-80 80Z"/></svg>
                            </button>
                            {{-- <button type="button" class="btn btn-wide bg-primary text-white text-xl" onclick="registerEvent()">
                                Register
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24" fill="#FFF"><path d="M438-226 296-368l58-58 84 84 168-168 58 58-226 226ZM200-80q-33 0-56.5-23.5T120-160v-560q0-33 23.5-56.5T200-800h40v-80h80v80h320v-80h80v80h40q33 0 56.5 23.5T840-720v560q0 33-23.5 56.5T760-80H200Zm0-80h560v-400H200v400Zm0-480h560v-80H200v80Zm0 0v-80 80Z"/></svg>
                            </button> --}}
                        </form>
                        
                    </div>              
                </article>
            </div>  
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', main);
            function main() {
                const lineToken = getUrlParameter('token');
                document.querySelector('input[name="line_token"]').value = lineToken;
                checkEvent(lineToken , '{{ $event->id }}');
            }
            function getUrlParameter(param) {
                var urlWithoutHash = window.location.href.split('#')[0];
                var parameters = {};
                urlWithoutHash.replace(
                    /[?&]+([^=&]+)=([^&]*)/gi,
                    function(match, key, val) {
                    parameters[key] = val;
                    }
                );
                return parameters[param];
            }
            // function initializeLiff(myLiffId) {
            // return liff
            //     .init({
            //         liffId: myLiffId
            //     })
            //     .then(() => {
            //         // start to use LIFF's api
            //         //initializeApp();

            //         if (!liff.isLoggedIn()) {
            //             liff.login({ redirectUri: window.location.href });
            //         }
            //         else {
            //             const idToken = liff.getDecodedIDToken();
            //             const lineToken = idToken.sub;
            //             // Update the hidden field with the lineUserId
            //             document.querySelector('input[name="line_token"]').value = lineToken;

            //             checkEvent(lineToken , '{{ $event->id }}');
            //         }

            //     })
            //     .catch((err) => {
            //         console.log('err');
            //     });
            // }
            // initializeLiff("{{ env('LINE_LIFFF_EVENT_ID') }}");

            function registerEvent() {
                // Use LIFF API to get user's LINE ID
                liff.getProfile()
                .then(profile => {
                    // Submit the form
                    document.getElementById('register-event').submit();
                })
                .catch(error => {
                    console.error(error);
                });
            }

            function checkEvent( lineUserId , eventID) {
                // console.log(lineUserId , eventID);
                $.ajax({
                    url: '/check-event',
                    type: 'GET',
                    data: { 
                        line_token: lineUserId ,
                        event_id: eventID ,
                    },                    
                    success: function (response) {
                        if (response.registered) {
                            // ถ้าเคยสมัครแล้ว 
                            setTimeout(() => {                        
                                console.log('Registered');
                                $('#submit-btn').addClass('hidden');
                            }, 200)
                        } else {
                            // ถ้ายังไม่ได้สมัคร
                            console.log('Not registered');
                            $('#submit-btn').removeClass('hidden');
                        }
                    },
                    error: function () {
                        console.log('Error checking registration');
                    }
                });
            }
        </script>

        @livewireScripts
    </body>
</html>
