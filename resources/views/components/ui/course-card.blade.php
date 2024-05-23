@props(['image', 'title', 'view' => false, 'updated_at', 'teacher', 'duration'])

<div class="flex flex-row items-center justify-between w-full h-full">
    <img src="{{ $image }}" alt="course_image" class="w-[122px] h-[108px] md:w-[123px] md:[82px]"/>
    <div class="flex flex-col items-start justify-between">
        <div class="md:hidden flex flex-row gap-2 items-center justify-start">
            <x-carbon-user class="w-[14px] h-[14px] text-gray-2"/>
            <p class="font-medium font-poppins text-[8px] text-gray-2">{{ $teacher }}</p>
        </div>
        <h1 class="max-w-[379px] font-poppins font-semibold text-[14px] text-text-1 text-left truncate">{{ $title }}</h1>
        <div class="flex flex-row justify-between items-center">
            <div class="flex flex-row gap-2 items-center justify-start">
                <x-phosphor-calendar-dots-light class="w-[14px] h-[14px] text-gray-2"/>
                <p class="font-medium font-poppins text-[8px] text-gray-2">{{ Carbon::parse($updated_at)->format('d M, h:iA') }}</p>
            </div>
            <div class="hidden md:flex flex-row gap-2 items-center justify-start">
                <x-phosphor-clock-countdown-light class="w-[14px] h-[14px] text-gray-2"/>
                <p class="font-medium font-poppins text-[8px] text-gray-2">{{ $duration }}</p>
            </div>
        </div>
    </div>
    @if($view)
        <p class="hidden md:block font-poppins font-semibold text-[14px] text-left text-sky-900">View ></p>
    @endif
</div>
