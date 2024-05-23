<x-auth-layout>
    <x-slot name="sidebar">
        <x-layouts.sidebar :notices="$notices"/>
    </x-slot>
    <div class="w-full min-h-dvh flex flex-col items-center justify-start">
        <x-sections.course-board/>
    </div>
    <x-slot name="rightSidebar">
        <x-layouts.notification-sidebar :notices="$notices" :activities="$activities"/>
    </x-slot>
</x-auth-layout>
