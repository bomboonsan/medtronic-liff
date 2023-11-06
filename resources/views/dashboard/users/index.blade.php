<x-app-layout>
    
    <x-dashboard.layout>
        <div class="">
            <div class="dashboard-card">
                <h2 class="title mb-5">รายชื่อผู้ใช้งาน ({{ count($userRegisters) }} คน)</h2>
        
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <x-dashboard.table-users :users="$userRegisters" />
                
                <div class="mt-5">
                    {{ $userRegisters->links() }}
                </div>
            </div>
        </div>
    </x-dashboard.layout>

</x-app-layout>
