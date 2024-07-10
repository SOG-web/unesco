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

@props(['notices' => [], 'noticeCount'=> 0])

<div
    class="bg-primary w-full min-h-[100dvh] flex flex-col items-start justify-start pt-[64px]">
    <div class="flex flex-row items-start justify-start gap-[40px] pl-[42px] mb-[67px]">
        <p class="text-[24px] font-medium leading-5 text-white cursor-pointer !bg-none"><</p>
        <x-ui.cu-badge :content="$noticeCount">
            <form class="hidden" method="POST" id="asseForm"
                  action="{{ route('notices') }}">
                @csrf
                @method('GET')
            </form>
            <button
                type="submit" form="asseForm" id="asseForm"
            >
                <x-heroicon-o-bell class="w-[22px] h-[22px] text-white"/>
            </button>
        </x-ui.cu-badge>
        <x-heroicon-o-cog-8-tooth class="w-[22px] h-[22px] text-white"/>
    </div>
    <div class="flex w-full flex-col items-center justify-start gap-3 mb-[46px]">
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
            @if($noticeCount > 0)
                <div class="flex ml-auto items-center justify-center rounded-full h-4 w-4 bg-red-500">
                    <p class="text-white text-[10px] font-semibold">{{ $noticeCount }}</p>
                </div>
            @endif
        </x-layouts.sidebar-link>
    </div>
    <div class="pl-[42px] pb-[10%] flex-1 flex flex-col items-start justify-end">
        <button
            form="logoutForm"
            type="submit"
            data-ripple-light="true"
            class="w-[85px] h-[41px] bg-[#808080] rounded-2xl flex items-center justify-center">
            <p class="text-center text-white text-xs font-medium xl:font-semibold font-poppins leading-tight">
                Log out</p>
        </button>
        <form id="logoutForm" class="hidden" action="/logout" method="post">
            @csrf
        </form>
    </div>
</div>
