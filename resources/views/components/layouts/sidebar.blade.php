<div
    class="bg-inherit w-full
    h-full flex flex-col items-center justify-between
    xl:justify-start pt-[20px] xl:pt-[41px] sidebar-scroll
    xl:gap-[65px] xl2:gap-[80px] max-w-[300px] overflow-hidden overflow-y-scroll scroll-smooth"
>
    <x-logo/>
    <div class="flex w-full flex-col max-w-[80%] items-center justify-start gap-3 px-[12px]">
        @if(auth()->user()->profile_pic)
            <img src="{{ auth()->user()->profile_pic }}" alt="user picture"
                 class="w-[60px] h-[60px] 2xl:w-[80px] 2xl:h-[80px] xl2:w-[100px] xl2:h-[100px] rounded-full bg-background"/>
        @else
            {{--name avatar--}}
            <x-ui.name-avatar :first_name="auth()->user()->first_name" :last_name="auth()->user()->last_name"/>
        @endif
        <div class="flex w-full flex-col items-center justify-start gap-1">
            <h1 class="text-[14px] 2xl:text-[18px] text-center font-medium font-poppins text-white">{{ auth()->user()->first_name  }} {{ auth()->user()->last_name }}</h1>
            <p
                class="text-[12px] w-full text-center text-wrap font-light font-poppins text-[#cccccc] break-words">{{ auth()->user()->email }}</p>
        </div>
    </div>
    <div class="flex w-full flex-col items-center justify-start gap-3 pb-[30px]">
        <x-layouts.sidebar-link href="{{ route('dashboard') }}" :active="request()->is('dashboard')">
            <x-icons.dashboard :active="request()->is('dashboard')"/>
            <span>Dashboard</span>
        </x-layouts.sidebar-link>
        <x-layouts.sidebar-link :active="request()->is('students')">
            <x-icons.student :active="request()->is('students')"/>
            <span>Students</span>
        </x-layouts.sidebar-link>
        <x-layouts.sidebar-link :active="request()->is('courses')">
            <x-icons.courses :active="request()->is('courses')"/>
            <span>Courses</span>
        </x-layouts.sidebar-link>
        <x-layouts.sidebar-link :active="request()->is('notices')">
            <x-icons.notify :active="request()->is('notices')"/>
            <span>Notices</span>
            <div class="flex ml-auto items-center justify-center rounded-full h-4 w-4 bg-red-500">
                <p class="text-white text-[10px] font-semibold">2</p>
            </div>
        </x-layouts.sidebar-link>
        <x-layouts.sidebar-link :active="request()->is('teachers')">
            <x-icons.teachers :active="request()->is('teachers')"/>
            <span>Teachers</span>
        </x-layouts.sidebar-link>

    </div>
</div>
