<x-app-layout>
    
    <x-dashboard.layout>
        <div class="max-w-lg mx-auto px-3">
            <div class="mb-5">
                <a href="{{ route('contacts-all') }}" class="text-primary text-lg flex items-center gap-2">                  
                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M360-240 120-480l240-240 56 56-144 144h568v80H272l144 144-56 56Z"/></svg>
                    <span>กลับ</span>
                </a>
            </div>
            <div class="dashboard-card">
                <h1 class="title text-center">กล่องข้อความ</h1>      
                <hr class="mb-4 mt-1" />
                <h2 class="text-xl font-medium mb-2">หัวข้อ</h2>  
                <p>{{ $contact->topic }}</p>
                <hr class="my-5" />
                <h2 class="text-xl font-medium mb-2">ข้อมูลติดต่อ</h2>  
                <div class="font-light text-[.9rem]">
                    <p class="mb-1">
                        <strong>ชื่อ : </strong> {{ $contact->userRegister->first_name }} {{ $contact->userRegister->last_name }}
                    </p>
                    <p class="mb-1">
                        <strong>เบอร์โทร : </strong> <a class="text-blue-600 font-normal hover:underline" href="tel:{{ $contact->telephone }}">{{ $contact->telephone }}</a>
                    </p>
                    <p class="mb-1">
                        <strong>Hospital : </strong> {{ $contact->hospital }}
                    </p>
                    <p>
                        <strong>เวลาให้ติดต่อกลับ : </strong> {{ $contact->available_time_contact_formatted }}
                    </p>  
                </div>
                @if ( $contact->already_read == 0)
                <div class="mt-5">
                    <form action="{{ route('contacts.changeAlreadyRead', $contact->id) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-primary text-white" onclick="return confirm('Are you sure?')">ทำเครื่องหมาย อ่านแล้ว</button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </x-dashboard.layout>

</x-app-layout>
