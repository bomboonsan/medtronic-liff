<x-app-layout>
    
    <x-dashboard.layout>
        <div class="">
            <div class="dashboard-card">
                <h2 class="title mb-5">ข้อความติดต่อทั้งหมด</h2>
        
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <table class="table">
                    <thead>
                        <tr>
                            <th>ผู้ส่ง</th>
                            <th>วันที่ส่ง</th>
                            <th>สถานะ</th>                            
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($contacts as $contact)
                            <tr>                                
                                <td>
                                    <a href="{{ route('contacts.show', $contact->id) }}" class="table-link">
                                        {{ $contact->userRegister->first_name }} {{ $contact->userRegister->last_name }}
                                    </a>
                                </td>
                                <td>
                                    {{ $contact->created_at }}                                   
                                </td>
                                <td>
                                    @if ( $contact->already_read == 0)
                                        ยังไม่อ่าน
                                    @else 
                                        อ่านแล้ว
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-error" onclick="return confirm('Are you sure?')">ลบ</button>
                                    </form>
                                </td>
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
        </div>
    </x-dashboard.layout>

</x-app-layout>
