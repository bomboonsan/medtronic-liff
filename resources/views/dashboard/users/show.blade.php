<x-app-layout>
    
    <x-dashboard.layout>
        <div class="max-w-screen-md md:mt-7 md:mb-5 mx-auto">
            <div class="mb-4">
                <a class="flex items-center gap-1 text-lg" href="{{ route('users-all') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" height="16" viewBox="0 -960 960 960" width="16"><path d="M400-80 0-480l400-400 71 71-329 329 329 329-71 71Z"/></svg>
                    รายชื่อผู้ใช้ทั้งหมด
                </a>                
            </div>
            <div class="dashboard-card">
                <h2 class="title mb-5">ข้อมูลผู้ใช้งาน</h2>               
                <div class="flex flex-wrap">
                    <div class="basis-1/4 w-1/4">
                        @if (is_null($userRegister->line_img) || empty($userRegister->line_img))
                        <div class="avatar">
                            <img class="rounded-xl shadow-lg w-full h-auto" src="{{ asset('img/default-avatar.jpg') }}" alt="default Avatar" loading="lazy" />
                        </div>
                        @else 
                        <div class="avatar">
                            <img class="rounded-xl shadow-lg w-full h-auto" src="{{ $userRegister->line_img }}" alt="" loading="lazy" />
                        </div>                        
                        @endif
                        <a href="{{ route('user_registers.edit', $userRegister->id) }}" class="btn btn-warning btn-sm mt-2">แก้ไข</a>
                    </div>
                    <div class="basis-3/4 w-3/4 pl-5">
                        <p class="text-user-detail"><b>ชื่อ</b> : {{ $userRegister->first_name }} {{ $userRegister->last_name }}</p>
                        <p class="text-user-detail"><b>อาชีพ</b> : {{ $userRegister->career->name }}</p>
                        <p class="text-user-detail"><b>ตำแหน่ง</b> : {{ $userRegister->specialty->name }}</p>
                        <p class="text-user-detail"><b>เลขที่ใบวิชาชีพ</b> : {{ $userRegister->license_number }}</p>
                        <p class="text-user-detail"><b>อีเมล</b> : {{ $userRegister->email }}</p>
                        <p class="text-user-detail"><b>เบอร์โทร</b> : {{ $userRegister->telephone }}</p>
                        <p class="text-user-detail"><b>สถานะ</b> : {{ $userRegister->status }}</p>
                    </div>
                </div>
            </div>

        </div>
    </x-dashboard.layout>

</x-app-layout>
