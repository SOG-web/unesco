<x-app-layout title="Dashboard">
    <div class="w-full min-h-dvh">
        <div
            class="w-full min-h-dvh flex flex-col lg:flex-row items-center lg:items-start justify-start lg:justify-between bg-background">
            <div class="w-full lg:hidden flex flex-row items-center justify-between px-3 auth py-4">
                <x-logo/>
                <x-menu-icon/>
            </div>
            <div class="hidden lg:block w-[25%] max-w-[300px] bg-primary min-h-dvh h-full overflow-hidden">
                <x-layouts.sidebar/>
            </div>
            <div class="w-full min-h-dvh"></div>
            <div class="hidden lg:block w-[25%] max-w-[300px] bg-natural-100 min-h-dvh h-full overflow-hidden"></div>
        </div>
    </div>
</x-app-layout>
