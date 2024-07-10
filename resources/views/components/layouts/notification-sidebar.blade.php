@props(['notices' => [], 'activities' => [], 'noticeCount'=> 0])

<div
    class="bg-inherit w-full min-h-dvh px-[15px] xl:px-[30px] xl2:px-[43px]
    h-full flex flex-col items-start justify-start pt-[30px] pb-[41px] xl:pt-[41px]
    gap-[65px] max-w-[300px] hover:overflow-y-scroll scroll-smooth"
>
    <div class="flex flex-row justify-between items-center w-full max-w-[200px]">
        <x-ui.cu-badge :content="$noticeCount">
            <form class="hidden" method="POST" id="assForm"
                  action="{{ route('notices') }}">
                @csrf
                @method('GET')
            </form>
            <button
                type="submit" form="assForm" id="assForm"
            >
                <x-heroicon-o-bell class="w-[22px] h-[22px] text-[#8B8C8C]"/>
            </button>
        </x-ui.cu-badge>
        <x-heroicon-o-cog-8-tooth class="w-[22px] h-[22px] text-[#8B8C8C]"/>
        <button
            form="logoutForm"
            type="submit"
            data-ripple-light="true"
            class="xl:w-[85px] xl:h-[41px] w-[65px] h-[31px] bg-primary rounded-2xl flex items-center justify-center">
            <p class="text-center text-white text-xs font-medium xl:font-semibold font-poppins leading-tight">
                Log out</p>
        </button>
        <form id="logoutForm" class="hidden" action="/logout" method="post">
            @csrf
        </form>
    </div>
    <x-sections.notices-sidebar-sec :notices="$notices" :notice-count="$noticeCount"/>
    <x-sections.activity-sidebar-sec :activities="$activities"/>
</div>
