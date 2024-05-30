<x-app-layout title="Dashboard">
    <div class="w-full">
        <div
            class="w-full relative h-full flex flex-col lg:flex-row items-center lg:items-start justify-start lg:justify-between bg-background">
            <div class="w-full lg:hidden flex flex-row items-center justify-between px-3 auth py-4">
                <x-logo/>
                <x-menu-icon/>
            </div>
            <div
                class="w-full max-w-[200px] xl:max-w-[250px]
                xl2:max-w-[300px] hidden min-h-dvh lg:flex relative">
                <div
                    class="w-full h-full max-w-[200px] xl:max-w-[250px]
                xl2:max-w-[300px] bg-primary overflow-hidden fixed">
                    <x-layouts.sidebar :notices="$notices"/>
                    {{-- <x-layouts.sidebar /> --}}
                </div>
            </div>
            <div class="w-full lg:pb-[40px] ">
                {{ $slot }}
                <x-layouts.mobile-notifi-bar :notices="$notices" :activities="$activities"/>
            </div>
            <div
                class="w-full max-w-[200px] xl:max-w-[250px]
                xl2:max-w-[300px] hidden min-h-dvh lg:flex relative">
                <div
                    class="w-full h-full max-w-[200px] xl:max-w-[250px]
                xl2:max-w-[300px] bg-natural-100 overflow-hidden fixed">
                    <x-layouts.notification-sidebar :notices="$notices" :activities="$activities"/>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
