<div>
    <div class="flex flex-wrap items-stretch min-h-screen">
        <div class="basis-[200px] w-[200px] bg-white">
            <x-dashboard.menu />
        </div>
        <div class="flex-1 p-7">
            {{ $slot }}
        </div>
    </div>
</div>