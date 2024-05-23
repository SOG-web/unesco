<x-app-layout title="Dashboard">
    <div class="w-full min-h-dvh">
        <div
            class="w-full relative min-h-dvh flex flex-col lg:flex-row items-center lg:items-start justify-start lg:justify-between bg-background">
            <div class="w-full lg:hidden flex flex-row items-center justify-between px-3 auth py-4">
                <x-logo/>
                <x-menu-icon/>
            </div>
            <div class="w-full max-w-[200px] xl:max-w-[250px]
                xl2:max-w-[300px] hidden min-h-dvh lg:flex relative">
                <div class="w-full h-full max-w-[200px] xl:max-w-[250px]
                xl2:max-w-[300px] bg-primary overflow-hidden fixed">
                    {{ $sidebar }}
                </div>
            </div>
            <div class="w-full min-h-dvh h-[1200px]">{{ $slot }}</div>
            <div class="w-full max-w-[200px] xl:max-w-[250px]
                xl2:max-w-[300px] hidden min-h-dvh lg:flex relative">
                <div class="w-full h-full max-w-[200px] xl:max-w-[250px]
                xl2:max-w-[300px] bg-natural-100 overflow-hidden fixed">
                    {{ $rightSidebar }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
