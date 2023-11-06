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
                @if(session('success'))
                    <div class="alert alert-success mb-10">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-success mb-10">
                        {{ session('error') }}
                    </div>
                @endif
                <h2 class="title mb-5">แก้ไขผู้ใช้งาน</h2>               
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
                    </div>
                    <div class="basis-3/4 w-3/4 pl-5">
                        {{-- <p class="text-user-detail"><b>ชื่อ</b> : {{ $userRegister->first_name }} {{ $userRegister->last_name }}</p>
                        <p class="text-user-detail"><b>อาชีพ</b> : {{ $userRegister->career->name }}</p>
                        <p class="text-user-detail"><b>ตำแหน่ง</b> : {{ $userRegister->specialty->name }}</p>
                        <p class="text-user-detail"><b>เลขที่ใบวิชาชีพ</b> : {{ $userRegister->license_number }}</p>
                        <p class="text-user-detail"><b>อีเมล</b> : {{ $userRegister->email }}</p>
                        <p class="text-user-detail"><b>เบอร์โทร</b> : {{ $userRegister->telephone }}</p>
                        <p class="text-user-detail"><b>สถานะ</b> : {{ $userRegister->status }}</p> --}}

                        <form action="{{ route('user_registers.update', $userRegister->id) }}" class="form-user-register" method="POST">
                            @csrf
                            @method('PUT') {{-- Use PUT method for updates --}}
                            <div class="mb-3 hidden">
                                <label for="line_img" class="form-label">Line Image</label>
                                <input type="text" class="form-control" id="line_img" name="line_img" value="{{ $userRegister->line_img }}">
                            </div>
                            <div class="mb-3 hidden">
                                <label for="line_token" class="form-label">Line Token</label>
                                <input type="text" class="form-control" id="line_token" name="line_token" value="{{ $userRegister->line_token }}" required>
                            </div>
                            <div class="flex gap-3 w-full">
                                <div class="mb-3 flex-auto">
                                    <label for="first_name" class="form-label">ชื่อ*</label>
                                    <input type="text" class="form-control w-full" id="first_name" name="first_name" value="{{ $userRegister->first_name }}" required>
                                </div>
                                <div class="mb-3 flex-auto">
                                    <label for="last_name" class="form-label">นามสกุล*</label>
                                    <input type="text" class="form-control w-full" id="last_name" name="last_name" value="{{ $userRegister->last_name }}" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="career_id" class="form-label">อาชีพ*</label>
                                <select class="form-select" id="career_id" name="career_id" required>
                                    @foreach($careers as $career)
                                        <option value="{{ $career->id }}" {{ $userRegister->career->id == $career->id ? 'selected' : '' }}>{{ $career->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="specialty_id" class="form-label">สาขา*</label>
                                <select class="form-select" id="specialty_id" name="specialty_id" required>
                                    @foreach($specialties as $specialty)
                                        <option value="{{ $specialty->id }}" {{ $userRegister->specialty->id == $career->id ? 'selected' : '' }}>{{ $specialty->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="license_number" class="form-label">เลขที่ใบประกอบวิชาชีพ*</label>
                                <input type="text" class="form-control" id="license_number" name="license_number" value="{{ $userRegister->license_number }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">อีเมล*</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $userRegister->email }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="telephone" class="form-label">เบอร์ติดต่อ</label>
                                <input type="text" class="form-control" id="telephone" value="{{ $userRegister->telephone }}" name="telephone">
                            </div>
                            <div class="text-center mt-6">
                                <button type="submit" class="btn btn-wide text-lg text-white btn-primary">บันทึก</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </x-dashboard.layout>

</x-app-layout>
