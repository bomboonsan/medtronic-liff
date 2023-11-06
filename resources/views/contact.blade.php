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
        <main class="max-w-screen-sm px-3 mx-auto pt-3">
            <div class="rounded-lg shadow-xl bg-white border border-neutral-200 overflow-hidden pt-5 p-3 min-h-screen relative">
                <h1 class="text-center text-xl mb-4 text-neutral-400">
                    Contact us
                </h1>
                @if(session('success'))
                    {{-- <div class="alert alert-success">
                        {{ session('success') }}
                    </div> --}}
                    <div class="contact_popup">
                        <p class="text-center">
                            The system has sent the matter to the moderator. <br/>
                            will hurry to contact you as quickly as possible
                        </p>
                        <div class="text-center mt-5">
                            <button type="button" class="btn btn-sm bg-red-600 text-white" onclick="closeProcess()">OK</button>
                        </div>
                    </div>
                @endif                

                <form action="{{ route('contacts.store') }}" method="post">
                    @csrf
                    <div class="form-control w-full hidden mb-3">
                        <label for="user_register_id">ID</label>
                        <input type="text" class="input input-sm input-bordered w-full" id="user_register_id" name="user_register_id">
                    </div>
                    <div class="flex gap-3">
                        <div class="form-control w-full  mb-3">
                            <label for="first_name">First Name</label>
                            <input type="text" class="input input-sm input-bordered w-full" id="first_name" name="first_name">
                        </div>
                        <div class="form-control w-full  mb-3">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="input input-sm input-bordered w-full" id="last_name" name="last_name">
                        </div>
                    </div>
                    <div class="form-control w-full  mb-3">
                        <label for="telephone">Phone Number</label>
                        <input type="text" class="input input-sm input-bordered w-full" id="telephone" name="telephone">
                    </div>
                    <div class="form-control w-full  mb-3">
                        <label for="hospital">Hospital</label>
                        <input type="text" class="input input-sm input-bordered w-full" id="hospital" name="hospital">
                    </div>                    
                    <div class="form-control w-full  mb-3">
                        <label for="available_time_contact">Available Time Contact</label>
                        <input type="datetime-local" class="input input-sm input-bordered w-full" id="available_time_contact" name="available_time_contact">
                    </div>
                    <div class="form-control w-full  mb-3">
                        <label for="topic">Topic</label>
                        <textarea class="rounded-lg border border-neutral-200 p-3 min-h-48" id="topic" name="topic"></textarea>
                    </div>
                    <div class="form-check hidden">
                        <input type="checkbox" class="form-check-input" id="already_read" name="already_read">
                        <label class="form-check-label" for="already_read">Already Read</label>
                    </div>
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-wide btn-primary mt-3">SEND</button>
                    </div>
                </form>
            </div>
        </main>

        <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
        <!-- START LIFF -->
        <script charset="utf-8" src="https://static.line-scdn.net/liff/edge/2/sdk.js"></script>
        <script>
            function initializeLiff(myLiffId) {
            return liff
                .init({
                    liffId: myLiffId
                })
                .then(() => {
                    // start to use LIFF's api
                    if (!liff.isLoggedIn()) {
                        liff.login({ redirectUri: window.location.href });
                    }
                    else {
                        const idToken = liff.getDecodedIDToken();
                        getUserDataToken(idToken.sub);
                    }

                })
                .catch((err) => {
                    console.log('err');
                });
            }
            initializeLiff("{{ env('LINE_LIFFF_CONTACT_ID') }}");

            // function ดึงข้อมูลผู้ใช้งาน
            function getUserDataToken( lineUserId ) {
                $.ajax({
                    url: '{{ route('get-user-data-token') }}',
                    type: 'GET',
                    data: { line_token: lineUserId },
                    success: function (response) {
                        console.log(response);
                        if (response.user != null) {
                            // Display user information
                            $('#user_register_id').val(response.user.id);
                            $('#first_name').val(response.user.first_name);
                            $('#last_name').val(response.user.last_name);
                            $('#telephone').val(response.user.telephone);
                        } else {
                            console.log('User not found');
                        }
                    },
                    error: function () {
                        console.log('Error getting user data');
                    }
                });
            }
            function closeProcess() {
                liff.closeWindow();
                history.back();
                window.stop();
            }
        </script>

        @livewireScripts
    </body>
</html>
