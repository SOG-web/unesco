@php
    use Carbon\Carbon;
@endphp

@props(['image', 'title', 'view' => false, 'updated_at', 'teacher', 'duration', 'id'])

<div class="flex flex-row items-center justify-between w-full h-full course-card" id="{{ $id }}">
    <div class="flex flex-row items-start justify-start gap-4 w-full h-full" >
        <img src="{{ $image }}" alt="course_image" class="w-[122px] h-[108px] md:w-[123px] md:[82px] rounded-[8px]" />
        <div class="flex flex-col h-full items-start justify-between gap-[20px]">
            {{--        <div class="md:hidden flex flex-row gap-2 items-center justify-start">--}}
            {{--            <x-carbon-user class="w-[14px] h-[14px] text-gray-2" />--}}
            {{--            <p class="font-medium font-poppins text-[8px] text-gray-2">{{ $teacher }}</p>--}}
            {{--        </div>--}}
            <h1 class="max-w-[379px] max-h-[63px] font-poppins font-semibold text-[14px] text-text-1 text-left truncate text-wrap">
                {{ $title }}</h1>
            <div class="flex flex-row justify-between gap-4 items-center">
                <div class="flex flex-row gap-2 items-center justify-center">
                    <x-phosphor-calendar-dots-light class="w-[14px] h-[14px] text-gray-2" />
                    <p class="font-medium font-poppins text-[8px] text-gray-2">
                        {{ Carbon::parse($updated_at)->format('d M, h:iA') }}</p>
                </div>
                <div class="flex flex-row gap-2 items-center justify-start">
                    <x-phosphor-clock-countdown-light class="w-[14px] h-[14px] text-gray-2" />
                    <p class="font-medium font-poppins text-[8px] text-gray-2">{{ $duration }}</p>
                </div>
            </div>
        </div>
    </div>
    @if ($view)
        <a href="{{ '/courses/'. $id }}" class="hidden md:block font-poppins font-semibold text-[14px] text-left text-sky-900 w-[90px] view">View ></a>
    @endif
</div>


<script>
    const courseCard = document.querySelector('.course-card');
    // const view = courseCard.querySelector('.view');

    courseCard.addEventListener('click', () => {
        const id = courseCard.getAttribute('id');
        window.location.href = `/courses/${id}`;
    });

    // view.addEventListener('click', (e) => {
    //     e.stopPropagation();
    //     const id = courseCard.getAttribute('id');
    //     window.location.href = `/courses/${id}`;
    // });
</script>
