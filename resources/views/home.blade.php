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
    <body class="body-home">
        <div class="home-container">
            <div class="flex flex-wrap justify-end pt-5 px-5 bg-[#eff4f7]">
                <div class="basis-1/3 w-1/3">
                    <img src="{{ asset('img/logo-connext.png') }}" alt="">
                </div>
            </div>
            <div class="p-5 text-[.72rem] bg-[#eff4f7]">
                <p class="text-[#1a1449] font-medium">
                    ยินดีต้อนรับสู่ Medtronic CONNEXT ซึ่งเป็นบริการของเมดโทรนิค
                </p>
                <p>                    
                    ประเทศไทย ผ่านแอปพลิเคชั่น LINE คุณจะได้รับข่าวสารงาน ประชุมสัมมนา
                    และการฝึกอบรมด้านเทคโนโลยีทางการแพทย์ที่ทันสมัยและทันเวลา
                </p>
            </div>
            <div class="p-5 bg-[#e6e6e6]">
                <h2 class="text-center font-bold text-[#1a1449] text-[1.18rem] mb-5">
                    <span class="text-[#171ad7]">Medtronic CONNEXT</span>
                    มีเมนูหลักดังนี้
                </h2>
                <div class="home-card">
                    <div class="row">
                        <div class="col-left">
                            <div class="text-center">
                                <a href="https://www.medtronic.com/th-th/index.html" target="_blank" class="text-white bg-[#171ad7] py-1 px-3 text-[1.05rem] rounded-lg">
                                    WEBSITE
                                </a>
                            </div>
                        </div>
                        <div class="col-right">
                            <p class="title">
                                เข้าสู่เว็บไซต์อย่างเป็นทางการ
                            </p>
                            <div class="des">
                                ของ เมดโทรนิค ประเทศไทย
                            </div>
                        </div>
                    </div>
                </div>
                <div class="home-card">
                    <a href="{{env('URL_LIFF_EVENT')}}">
                        <div class="row">
                            <div class="col-left">
                                <div class="link-name">
                                        Education <br/>
                                        Event
                                </div>
                            </div>
                            <div class="col-right">
                                <p class="title">
                                    ติดตามตารางประชุมและฝึกอบรม
                                </p>
                                <div class="des">
                                    ทั้งจากเมดโทรนิค และในความร่วมมือ
                                    กับองค์กรการแพทย์ ทั้งรายเดือน
                                    รายสัปดาห์ พร้อมรับชมการถ่ายทอดสดรายวัน
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="home-card">
                    <a href="{{env('URL_LIFF_LEARNING')}}">
                        <div class="row">
                            <div class="col-left">
                                <div class="link-name">
                                        Connext <br/>
                                        Learning
                                </div>
                            </div>
                            <div class="col-right">
                                <p class="title">
                                    รับชมวีดีโอการฝึกอบรมทางการแพทย์ย้อนหลัง
                                </p>
                                <div class="des">
                                    เพื่อให้คุณไม่พลาดการเรียนรู้ไปกับเมดโทรนิค
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="home-card">
                    <a href="{{env('URL_LIFF_ISHOWROOM')}}">
                        <div class="row">
                            <div class="col-left">
                                <div class="link-name">
                                        iShowroom
                                </div>
                            </div>
                            <div class="col-right">
                                <p class="title">
                                    สัมผัสประสบการณ์ใหม่ เข้าถึงผลิตภัณฑ์
                                    เทคโนโลยีทางการแพทย์
                                </p>
                                <div class="des">
                                    ที่ทันสมัยของเมดโทรนิคในรูปแบบ Virtual Tour
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="home-card">
                    <a href="{{env('URL_LIFF_CONTACT')}}">
                        <div class="row">
                            <div class="col-left">
                                <div class="link-name">
                                        Contact us
                                </div>
                            </div>
                            <div class="col-right">
                                <div class="des">
                                    <span class="text-[#171ad7] font-medium mr-2">ติดต่อ – สอบถาม</span> ต้องการข้อมูลผลิตภัณฑ์
                                    หรือสอบถามข้อมูลเกี่ยวกับเมดโทรนิคเพิ่มเติม
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                
            </div>
        </div>
    </body>
</html>
