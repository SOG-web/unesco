@props(['assessment', 'show' => false])
<div class="w-full gap-6 items-center flex flex-row h-[94px]">
    <div class="w-[80px] h-[80px] rounded-lg bg-bg-2 flex justify-center items-center">
        <x-gmdi-assessment-o class="w-[30px] h-[30px] text-secondary"/>
    </div>
    <div class="flex gap-2 flex-col">
        <div class="flex flex-row gap-4">

            @if($assessment->status == 'active')
                <div
                    class="flex w-[44px] h-[15px] rounded-sm bg-[#13C525] items-center justify-center bg"
                >
                    <p class="font-semibold text-[8px] leading-[12px] text-white">
                        ACTIVE
                    </p>
                </div>
                {{--                <input type="checkbox" class="toggle toggle-success toggle-xs" checked/>--}}
            @else
                <div
                    class="flex w-[44px] h-[15px] rounded-sm bg-[#FF0000] items-center justify-center bg"
                >
                    <p class="font-semibold text-[8px] leading-[12px] text-white">
                        INACTIVE
                    </p>
                </div>
                {{--                <input type="checkbox" class="toggle toggle-error toggle-xs" checked/>--}}
            @endif
        </div>
        <p class="font-semibold text-[18px] leading-[27px]">
            <span class="max-w-[150px] truncate">{{ $assessment->title }}</span> ({{ count($assessment->students) }}
            responses)
        </p>
        <p class="font-light text-[12px] leading-[18px] text-[#9E9E9E]">
            {{ $assessment->end_date }}
        </p>
    </div>
    @if($show)
        <div class="flex gap-4 ml-auto">
            <a href="{{ route('assessments.show', $assessment->id) }}"
               class="flex items-start justify-center text-[#002979] text-right text-[14px] font-semibold">
                <span class="hidden md:inline">Grade </span>
                >
            </a>
        </div>
    @endif
</div>


{{--<div class="w-full flex flex-row items-center justify-between gap-4 bg-white rounded-[10px] px-[15px] py-[10px] border border-[#E0E0E0]">--}}
{{--    <div class="flex flex-col items-start justify-start gap-1">--}}
{{--        <h1 class="font-poppins font-semibold text-[14px] text-[#605C9D]">{{ $assessment->title }}</h1>--}}
{{--        <p class="font-poppins font-normal text-[12px] text-[#9E9E9E]">{{ $assessment->description }}</p>--}}
{{--    </div>--}}
{{--    <div class="flex flex-col items-end justify-start gap-1">--}}
{{--        <p class="font-poppins font-normal text-[12px] text-[#9E9E9E]">{{ $assessment->created_at->format('M d, Y') }}</p>--}}
{{--        <p class="font-poppins font-normal text-[12px] text-[#9E9E9E]"></p>--}}
{{--    </div>--}}
{{--</div>--}}
