@php
    $user = \App\Models\User::find(auth()->id());
    $userRole = $user->role;
    $sidebarLinks = [
        'admin' => [
            ['href' => '/students', 'icon' => 'students', 'label' => 'Students'],
            ['href' => '/courses', 'icon' => 'courses', 'label' => 'Courses'],
            ['href' => '/teachers', 'icon' => 'teachers', 'label' => 'Teachers'],
        ],
        'teacher' => [
            ['href' => '/courses', 'icon' => 'students', 'label' => 'My Courses'],
            ['href' => '/assessments', 'icon' => 'courses', 'label' => 'Assessments'],
            ['href' => '/students', 'icon' => 'teachers', 'label' => 'My Students'],
        ],
        'students' => [
            ['href' => '/courses', 'icon' => 'students', 'label' => 'My Courses'],
            ['href' => '/assessments', 'icon' => 'courses', 'label' => 'Assessments'],
            ['href' => '/grades', 'icon' => 'teachers', 'label' => 'Grades'],
        ],
    ];
    $links = $sidebarLinks[$userRole] ?? [];
@endphp

@props(['notices' => []])

<div
    class="bg-inherit w-full
    h-full flex flex-col items-center justify-between
    xl:justify-start pt-[20px] xl:pt-[41px] sidebar-scroll
    xl:gap-[65px] xl2:gap-[80px] max-w-[300px] overflow-hidden overflow-y-scroll scroll-smooth"
>
    <x-logo/>
    <div class="flex w-full flex-col max-w-[80%] items-center justify-start gap-3 px-[12px]">
        @if($user->profile_pic)
            <img src="{{ $user->profile_pic }}" alt="user picture"
                 class="w-[60px] h-[60px] 2xl:w-[80px] 2xl:h-[80px] xl2:w-[100px] xl2:h-[100px] rounded-full bg-background"/>
        @else
            {{--name avatar--}}
            <x-ui.name-avatar :first_name="$user->first_name" :last_name="$user->last_name"/>
        @endif
        <div class="flex w-full flex-col items-center justify-start gap-1">
            <h1 class="text-[14px] 2xl:text-[18px] text-center font-medium font-poppins text-white">{{ $user->first_name  }} {{ $user->last_name }}</h1>
            <p
                class="text-[12px] w-full text-center text-wrap font-light font-poppins text-[#cccccc] break-words">{{ $user->email }}</p>
        </div>
    </div>
    <div class="flex w-full flex-col items-center justify-start gap-3 pb-[30px]">
        <x-layouts.sidebar-link href="/dashboard" :active="str_contains(request()->fullUrl(), 'dashboard')">
            <x-icons.dashboard :active="str_contains(request()->fullUrl(), 'dashboard')"/>
            <span>Dashboard</span>
        </x-layouts.sidebar-link>

        @foreach($links as $link)
            <x-layouts.sidebar-link
                href="{{ $link['href'] }}"
                :active="str_contains(request()->fullUrl(), $link['href'])">
                <x-ui.dynamic-icon :icon="$link['icon']" :active="str_contains(request()->fullUrl(), $link['href'])"/>
                <span>{{ $link['label'] }}</span>
            </x-layouts.sidebar-link>
        @endforeach
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
    </div>
</div>
