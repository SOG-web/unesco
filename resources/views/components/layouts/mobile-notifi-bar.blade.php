@props(['notices' => [], 'activities' => [], 'noticeCount'=> 0])

<div
    class="bg-white w-full lg:hidden px-[12px] mt-[40px]
    h-full flex flex-row items-start justify-between pt-[30px]"
>
    <x-sections.notices-sidebar-sec :notices="$notices" :notice-count="$noticeCount"/>
    <x-sections.activity-sidebar-sec :activities="$activities"/>
</div>
