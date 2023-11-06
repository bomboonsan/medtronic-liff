<x-app-layout>
    
    <x-dashboard.layout>
        <div class="">
            <div class="dashboard-card">
                <h1 class="title">{{ $career->name }}</h1>        
                

                @if(count($users) > 0)
                    <p class="subtitle">รายชื่อสมาชิกในอาชีพ {{ $career->name }} จำนวน <span class="badge badge-primary">{{ count($users) }}</span> คน</p>
                    <x-dashboard.table-users :users="$users" />
                
                    <div class="mt-5">
                        {{ $users->links() }}
                    </div>
                @else
                    <div class="alert alert-error">
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span>ไม่มีสมาชิกในอาชีพ {{ $career->name }}</span>
                    </div>
                @endif
            </div>
        </div>
    </x-dashboard.layout>

</x-app-layout>
