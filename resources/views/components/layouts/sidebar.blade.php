@props(['notices' => [], 'userRole' => 'student'])

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
        <x-layouts.sidebar-link href="/dashboard" :active="str_contains(request()->fullUrl(), 'dashboard')">
            <x-icons.dashboard :active="str_contains(request()->fullUrl(), 'dashboard')"/>
            <span>Dashboard</span>
        </x-layouts.sidebar-link>
        <x-layouts.sidebar-link
            :href="$userRole == 'admin' ? '/students' : '/courses'"
            :active="$userRole == 'admin' ? str_contains(request()->fullUrl(), 'students') : str_contains(request()->fullUrl(), 'courses')">
            <x-icons.student :active="$userRole == 'admin' ? str_contains(request()->fullUrl(), 'students') : str_contains(request()->fullUrl(), 'courses')"/>
            @if($userRole == 'admin')
                <span>Students</span>
            @else
                <span>My Courses</span>
            @endif
        </x-layouts.sidebar-link>
        <x-layouts.sidebar-link
            :href="$userRole == 'admin' ? '/courses' : '/assessments'"
            :active="$userRole == 'admin' ? str_contains(request()->fullUrl(), 'courses') : str_contains(request()->fullUrl(), 'assessments')">
            <x-icons.courses :active="$userRole == 'admin' ? str_contains(request()->fullUrl(), 'courses') : str_contains(request()->fullUrl(), 'assessments')"/>
            @if($userRole == 'admin')
                <span>Courses</span>
            @else
                <span>Assessments</span>
            @endif
        </x-layouts.sidebar-link>
        <x-layouts.sidebar-link
            href="/notices"
            :active="str_contains(request()->fullUrl(), 'notices')">
            <x-icons.notify :active="str_contains(request()->fullUrl(), 'notices')"/>
            <span>Notices</span>
            @if(count($notices) > 0)
                <div class="flex ml-auto items-center justify-center rounded-full h-4 w-4 bg-red-500">
                    <p class="text-white text-[10px] font-semibold">{{ count($notices) }}</p>
                </div>
            @endif
        </x-layouts.sidebar-link>
        <x-layouts.sidebar-link
            :href="$userRole == 'admin' ? '/grades' : ($userRole == 'teacher' ? '/students' : '/grades')"
            :active="($userRole == 'admin' ? str_contains(request()->fullUrl(), 'teachers') : ($userRole == 'teacher' ? str_contains(request()->fullUrl(), 'students') : str_contains(request()->fullUrl(), 'grades')))">
            <x-icons.teachers
                :active="($userRole == 'admin' ? str_contains(request()->fullUrl(), 'teachers') : ($userRole == 'teacher' ? str_contains(request()->fullUrl(), 'students') : str_contains(request()->fullUrl(), 'grades')))"/>
            @if($userRole == 'admin')
                <span>Teachers</span>
            @elseif($userRole == 'teacher')
                <span>My Students</span>
            @else
                <span>Grades</span>
            @endif
        </x-layouts.sidebar-link>

    </div>
</div>
