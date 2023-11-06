<x-app-layout>
    
    <x-dashboard.layout>
        <div class="">
            <div class="dashboard-card">
                <h2 class="title mb-3">รายชื่อผู้ใช้งานสถานะ Suspend </h2>

                <button class="btn btn-sm btn-success btn-wide" onclick="openCustomSizeTab()">ตรวจสอบเลขที่ใบวิชาชีพแพทย์</button>

                <script>
                    function openCustomSizeTab() {
                        // Specify the custom size (width and height)
                        var customWidth = 400;
                        var customHeight = 600;
                    
                        // Calculate the position to center the new window on the screen
                        var leftPosition = (screen.width - customWidth) / 2;
                        var topPosition = (screen.height - customHeight) / 2;
                    
                        // Construct window features as a string
                        var windowFeatures = `width=${customWidth},height=${customHeight},left=${leftPosition},top=${topPosition}`;
                    
                        // Open the new tab with the specified features
                        window.open('https://checkmd.tmc.or.th/', '_blank', windowFeatures);
                    }
                </script>
        
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
