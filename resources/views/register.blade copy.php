<x-guest-layout>
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
                <div class="text-center mb-3">
                    <div class="form-check">
                        <input type="checkbox" checked="checked" class="" id="consented" name="consented" value="1" /> 
                        <label class="form-check-label ml-2" for="consented">I Agree</label>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn-submit">Submit</button>
                </div>
            </form>
        </div>
    </div>    
</x-guest-layout>
