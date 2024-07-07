@php
    use Carbon\Carbon;
@endphp

<div
    class="w-full max-w-[692px] max-h-[80dvh] overflow-y-scroll scroll-smooth py-[31px] flex flex-col items-center justify-start gap-[25px] bg-white rounded-[10px] px-[21px] xl:px-[45px]">
    <div class="flex items-center w-[100%] justify-start">
        <p class="font-semibold text-[22px] text-[#272835] leading-[33px]">
            Active Assessments
        </p>
    </div>
    <div class="w-full flex gap-[18px] flex-col">
        @foreach($assessments as $assessment)
            @if(!$assessment->completed)
                <div
                    class="max-w-[582px] bg-[#E8EFF6] h-[147px] md:h-[142px] pl-4 pr-4 justify-between w-full items-start pb-4 pt-4 flex flex-col md:flex-row rounded-lg"
                >
                    <div class="flex gap-[21px] flex-row">
                        <div
                            class="flex items-center justify-center bg-[#F3E4FF] w-[36px] h-[36px]"
                        >
                            <svg class="w-[20px] h-[20px] text-[#8F00FF]" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg"
                                 width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="1.5"
                                      d="M15 4h3a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h3m0 3h6m-3 5h3m-6 0h.01M12 16h3m-6 0h.01M10 3v4h4V3h-4Z"/>
                            </svg>
                        </div>
                        <div class="flex flex-col gap-[8px]">
                            <x-button
                                class="w-[73px] md:hidden h-[18px] rounded-md font-medium text-[8px] leading-[12px] text-white flex items-center justify-center bg-[#FF0000]"
                            >
                                NOT SUBMITTED
                            </x-button>
                            <div class="flex flex-col gap-[4px]">
                                <p
                                    class="font-semibold text-[12px] leading-[18px] text-[#272835]"
                                >
                                    {{ $assessment->course_name }}
                                </p>
                                <p class="font-light text-[10px] text-[#9E9E9E] leading-[15px]">
                                    {{ Carbon::parse($assessment->end_date)->format('d M, h:iA') }}
                                </p>
                            </div>
                            <form class="hidden" method="POST" id="assForm"
                                  action="{{ route('assessments.start', ['id'=>$assessment->id]) }}">
                                @csrf
                                @method('GET')
                            </form>
                            <button
                                type="submit" form="assForm" id="assForm"
                                class="w-[157px] rounded-lg leading-[20px] text-[12px] justify-center text-[#002979] font-semibold tracking-tight-[-0.2px] flex items-center h-[41px] bg-white"
                            >
                                Take assessment
                            </button>
                        </div>
                    </div>
                    <button
                        class="w-[73px] hidden h-[18px] rounded-md font-medium text-[8px] leading-[12px] text-white md:flex items-center justify-center bg-[#FF0000]"
                    >
                        NOT SUBMITTED
                    </button>
                </div>
            @else
                <div
                    class="max-w-[582px] bg-[#E8EFF6] h-[105px] md:h-[75px] pb-4 pl-4 pr-4 justify-between w-full items-start pt-4 flex flex-col md:flex-row rounded-lg"
                >
                    <div class="w-full flex gap-[21px] flex-row">
                        <div
                            class="flex items-center justify-center bg-[#F3E4FF] w-[36px] h-[36px]"
                        >
                            <svg class="w-[20px] h-[20px] text-[#8F00FF]" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg"
                                 width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="1.5"
                                      d="M15 4h3a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h3m0 3h6m-3 5h3m-6 0h.01M12 16h3m-6 0h.01M10 3v4h4V3h-4Z"/>
                            </svg>
                        </div>

                        <div class="flex flex-col gap-[4px]">
                            <button
                                class="w-[56px] flex md:hidden h-[18px] rounded-md font-medium text-[8px] leading-[12px] text-[#E8EFF6] items-center justify-center bg-[#13C525]"
                            >
                                Submitted
                            </button>
                            <p
                                class="font-semibold text-[12px] leading-[18px] text-[#272835]"
                            >
                                {{ $assessment->course_name }}
                            </p>
                            <p class="font-light text-[10px] text-[#9E9E9E] leading-[15px]">
                                {{ Carbon::parse($assessment->end_date)->format('d M, h:iA') }}
                            </p>
                        </div>
                    </div>
                    <button
                        class="w-[56px] md:flex hidden h-[18px] rounded-md font-medium text-[8px] leading-[12px] text-[#E8EFF6] items-center justify-center bg-[#13C525]"
                    >
                        Submitted
                    </button>
                </div>
            @endif
        @endforeach
    </div>
</div>
