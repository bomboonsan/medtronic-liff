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
    <body class="bg-neutral-100/70 min-h-screen">
        <main class="max-w-screen-sm px-3 py-3 mx-auto">
            <div class="tabs tabs-boxed tab-custom mb-5">
                <a class="tab tab-active" data-tab="tab_1">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M360-120q-33 0-56.5-23.5T280-200v-400q0-33 23.5-56.5T360-680h400q33 0 56.5 23.5T840-600v400q0 33-23.5 56.5T760-120H360Zm0-400h400v-80H360v80Zm160 160h80v-80h-80v80Zm0 160h80v-80h-80v80ZM360-360h80v-80h-80v80Zm320 0h80v-80h-80v80ZM360-200h80v-80h-80v80Zm320 0h80v-80h-80v80Zm-480-80q-33 0-56.5-23.5T120-360v-400q0-33 23.5-56.5T200-840h400q33 0 56.5 23.5T680-760v40h-80v-40H200v400h40v80h-40Z"/></svg>
                </a> 
                <a class="tab" data-tab="tab_2">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M320-280q17 0 28.5-11.5T360-320q0-17-11.5-28.5T320-360q-17 0-28.5 11.5T280-320q0 17 11.5 28.5T320-280Zm0-160q17 0 28.5-11.5T360-480q0-17-11.5-28.5T320-520q-17 0-28.5 11.5T280-480q0 17 11.5 28.5T320-440Zm0-160q17 0 28.5-11.5T360-640q0-17-11.5-28.5T320-680q-17 0-28.5 11.5T280-640q0 17 11.5 28.5T320-600Zm120 320h240v-80H440v80Zm0-160h240v-80H440v80Zm0-160h240v-80H440v80ZM200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm0-80h560v-560H200v560Zm0-560v560-560Z"/></svg>
                </a>
            </div>

            <div id="tab_1" class="w-full">
                <div class="rounded-lg shadow-xl border border-neutral-200 overflow-hidden">
                    <div id="calendar"></div>                    
                    <p id="token_id" class="hidden"></p>
                </div>   
                <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
                <script src="{{ asset('js/mini-event-calendar.min.js') }}"></script>
                {{-- https://github.com/jestrux/jquery-mini-event-calendar --}}
                <script>
                    var someDaynextMonth = new Date().setDate(new Date().getDate() + 31);
                    var sampleEvents = [
                        @forelse ($events as $event)
                        {
                            title: "{{ $event->title }}",
                            date: "{{ $event->start_date }}",
                            link: "{{ route('events.show', $event->id) }}"
                        }
                            @if (!$loop->last)
                            ,
                            // เพิ่ม , หากยังไม่ใช่ loop สุดท้าย (json format)
                            @endif
                        @empty
                        @endforelse
                    ];
                    $(document).ready(function(){
                        $("#calendar").MEC({
                            events: sampleEvents
                        });
                    });
                </script>            
            </div>

            <div id="tab_2" class="w-full hidden">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Event name</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($events as $event)
                            <tr>
                                <td>
                                    <a href="{{ route('events.show', $event->id) }}" class="table-link">
                                        {{ $event->title }}
                                    </a>                                    
                                </td>
                                <td>{{ $event->start_date_formatted }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">No events available.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>                    
                <div class="mt-5">
                    {{-- {{ $userRegisters->links() }} --}}
                </div>
            </div>

        </main>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const tabs = document.querySelectorAll('.tabs .tab');
                const tabContents = document.querySelectorAll('[id^="tab_"]');
            
                tabs.forEach(tab => {
                    tab.addEventListener('click', () => {
                            // Hide all tab contents
                            tabContents.forEach(content => {
                                // content.style.display = 'none';
                                content.classList.add('hidden');
                        });
                
                        // Deactivate all tabs
                        tabs.forEach(t => {
                            t.classList.remove('tab-active');
                        });
                
                        // Activate the clicked tab
                        tab.classList.add('tab-active');
                
                        // Show the corresponding tab content
                        const tabId = tab.getAttribute('data-tab');
                        const tabContent = document.getElementById(tabId);
                        if (tabContent) {
                            // tabContent.style.display = 'block';
                            tabContent.classList.remove('hidden');
                        }
                    });
                });
            });
        </script>

        <script charset="utf-8" src="https://static.line-scdn.net/liff/edge/2/sdk.js"></script>
        <script>
            function initializeLiff(myLiffId) {
            return liff
                .init({
                    liffId: myLiffId
                })
                .then(() => {
                    // start to use LIFF's api
                    //initializeApp();

                    if (!liff.isLoggedIn()) {
                        liff.login({ redirectUri: window.location.href });
                    }
                    else {
                        const idToken = liff.getDecodedIDToken();
                        const lineToken = idToken.sub;
                        $( "#token_id" ).text( lineToken );
                    }

                })
                .catch((err) => {
                    console.log('err');
                });
            }
            initializeLiff("{{ env('LINE_LIFFF_EVENT_ID') }}");            
        </script>

        @livewireScripts
    </body>
</html>
