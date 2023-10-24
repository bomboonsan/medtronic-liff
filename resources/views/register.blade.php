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
    <body class="bg-register min-h-screen">
        <header class="bg-white text-[#1A1449] py-5">
            <div class="text-center">
                <img width="200" src="{{ asset('img/LOGO-TEXT.png') }}" class="mx-auto max-w-full h-auto" alt="medtronic" loading="lazy" />
            </div>
        </header>
        <div class="bg-register">
            <div class="register-container">
    
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
    
                <h1 class="text-3xl font-[300] my-5 text-center">
                    Register
                </h1>
        
                <form action="{{ route('user_registers.store') }}" class="form-user-register" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="line_img" class="form-label">Line Image</label>
                        <input type="text" class="form-control" id="line_img" name="line_img" required>
                    </div>
                    <div class="mb-3">
                        <label for="line_token" class="form-label">Line Token</label>
                        <input type="text" class="form-control" id="line_token" name="line_token" required>
                    </div>
                    <div class="flex gap-3">
                        <div class="mb-3">
                            <label for="first_name" class="form-label">ชื่อ*</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="last_name" class="form-label">นามสกุล*</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="career_id" class="form-label">อาชีพ*</label>
                        <select class="form-select" id="career_id" name="career_id" required>
                            <option>กรุณาเลือกอาชีพ</option>
                            @foreach($careers as $career)
                                <option value="{{ $career->id }}">{{ $career->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="specialty_id" class="form-label">สาขา*</label>
                        <select class="form-select" id="specialty_id" name="specialty_id" required>
                        <option>กรุณาเลือกอาชีพ</option>
                            @foreach($specialties as $specialty)
                                <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="license_number" class="form-label">เลขที่ใบประกอบวิชาชีพ*</label>
                        <input type="text" class="form-control" id="license_number" name="license_number" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">อีเมล*</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="telephone" class="form-label">เบอร์ติดต่อ</label>
                        <input type="text" class="form-control" id="telephone" name="telephone">
                    </div>
                    <div class="mb-3 hidden">
                        <label for="agent" class="form-label">agent</label>
                        <input type="text" class="form-control" id="agent" name="agent">
                    </div>
                    <div class="mb-3 hidden">
                        <label for="event" class="form-label">event</label>
                        <input type="text" class="form-control" id="event" name="event">
                    </div>
                    <div class="text-center mb-3">
                        <div class="form-check flex justify-center gap-4 items-center">
                            <svg id="Layer_2" class="icon-consent" data-name="Layer 2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14.59 12.09"> <defs> <style>.cls-1{fill: #fff;}</style> </defs> <g id="Layer_1-2" data-name="Layer 1"> <g> <g> <path class="cls-1" d="m0,12.09s.22-5.99,2.29-7.4c0,0,1.74-.76,2.61,2.18,0,0,.44,2.29,2.61,2.39v1.52s-1.96-.22-2.61-.76v2.07H0Z"/> <circle class="cls-1" cx="3.54" cy="2.24" r="2.24"/> </g> <g> <path class="cls-1" d="m14.59,12.09s-.22-5.99-2.29-7.4c0,0-1.74-.76-2.61,2.18,0,0-.44,2.29-2.61,2.39v1.52s1.96-.22,2.61-.76v2.07s4.9,0,4.9,0Z"/> <circle class="cls-1" cx="11.04" cy="2.24" r="2.24"/> </g> </g> </g></svg>
                            <input type="checkbox" checked="checked" class="" id="consented" name="consented" value="1" /> 
                            <label class="form-check-label" for="consented">I Agree</label>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn-submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        

        <script>
            // Function to get URL parameters
            function getParameterByName(name, url) {
                if (!url) url = window.location.href;
                name = name.replace(/[\[\]]/g, "\\$&");
                const regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                    results = regex.exec(url);
                if (!results) return null;
                if (!results[2]) return '';
                return decodeURIComponent(results[2].replace(/\+/g, " "));
            }
    
            // Set values for agent and event inputs from URL parameters
            document.addEventListener("DOMContentLoaded", function () {
                const agentValue = getParameterByName('agent');
                const eventValue = getParameterByName('event');
    
                // Set values to input fields
                document.getElementById('agent').value = agentValue || '';
                document.getElementById('event').value = eventValue || '';
            });
        </script>

        @livewireScripts
    </body>
</html>
