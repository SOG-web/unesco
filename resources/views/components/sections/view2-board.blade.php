@props(['teachers', 'students', 'assessment', 'title1' => 'Teachers', 'title2' => 'Students'])

<div class="w-full max-w-[692px] flex flex-col md:flex-row items-center md:items-start justify-between gap-[44px]" >
    <div
        class="w-full flex flex-col items-center justify-start gap-[16px]">
        <h1 class="pl-[20px] font-semibold text-left leading-[24px] text-text-1 text-[16px] self-start" >{{ $title1 }}</h1>
        <x-ui.view3-board type="course" />
    </div>
    <div
        class="w-full flex flex-col items-center justify-start gap-[16px]">
        <h1 class="pl-[20px] font-semibold text-left leading-[24px] text-text-1 text-[16px] self-start" >{{ $title2 }}</h1>
        <x-ui.view3-board />
    </div>
</div>
