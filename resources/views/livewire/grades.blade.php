<div
    class="w-full max-w-[692px] max-h-[80dvh] overflow-y-scroll scroll-smooth py-[31px] flex flex-col items-center justify-start gap-[25px] bg-white rounded-[10px] px-[21px] xl:px-[45px]">
    <div
        class="w-full self-start flex flex-row items-center justify-between mb-[9px] flex-wrap">
        <h1 class="font-poppins font-semibold text-text-1 text-[16px] md:text-[18px] lg:text-[22px]">View Results</h1>
    </div>

    <div class="w-full flex flex-col items-start justify-start gap-4">
        @foreach($grades as $grade)
            @if(count($grade->assessment_student) !== 0 && $grade->assessment_student[0]->total_mark !== null)
                <div class="flex flex-row items-center justify-between w-full h-full course-card cursor-pointer">
                    <div class="flex flex-row items-center justify-start gap-4 w-full h-full">
                        <div class="w-[80px] h-[80px] rounded-[8px] bg-bg-2 flex justify-center items-center">
                            @if ($grade->type == 'video')
                                <svg class="w-[30px] h-[30px] text-secondary" viewBox="0 0 26 25" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M24.8083 8.70193C24.0766 8.33113 23.1977 8.40842 22.542 8.90125L20.5562 10.3757C20.2747 7.60953 17.9471 5.50419 15.1667 5.50068H15.0746L10.6091 1.03625C10.0014 0.424285 9.17384 0.0813087 8.31137 0.0840001H1.08332C0.485012 0.0840001 0 0.569063 0 1.16737C0 1.76567 0.485012 2.25068 1.08332 2.25068H8.31132C8.59848 2.25145 8.87372 2.3655 9.07725 2.56812L12.0098 5.50068H5.41668C2.42663 5.50429 0.00360547 7.92732 0 10.9174V19.5841C0.00360547 22.5741 2.42663 24.9971 5.41668 25.0007H15.1667C17.9472 24.9972 20.2747 22.8918 20.5562 20.1257L22.5387 21.6034C23.496 22.3213 24.8541 22.1273 25.5721 21.1701C25.8533 20.795 26.0054 20.3389 26.0054 19.8701V10.6389C26.0082 9.81785 25.544 9.06664 24.8083 8.70193ZM18.4167 19.584C18.4167 21.3789 16.9616 22.834 15.1667 22.834H5.41668C3.62177 22.834 2.16668 21.3789 2.16668 19.584V10.9174C2.16668 9.12245 3.62177 7.66737 5.41668 7.66737H15.1667C16.9616 7.66737 18.4167 9.12245 18.4167 10.9174V19.584ZM23.8333 19.8624L20.5833 17.4401V13.0613L23.8333 10.639V19.8624Z"
                                        fill="#8F00FF"/>
                                </svg>
                            @elseif ($grade->type == 'audio')
                                <x-iconic-headphones class="w-[30px] h-[30px] text-secondary"/>
                            @else
                                <x-iconic-link class="w-[30px] h-[30px] text-secondary"/>
                            @endif
                        </div>
                        <div class="w-full min-h-[60px] flex flex-col items-start justify-between">
                            <h1
                                class="max-w-[379px] max-h-[63px] font-poppins font-semibold text-[14px] text-text-1 text-left truncate text-wrap">
                                {{ $grade->title }}</h1>

                            @if(count($grade->progress) < 1)
                                <x-progress value="1" max="100"
                                            class="w-full max-w-[290px] h-1.5 progress-error"/>
                            @else
                                <x-progress value="{{ $grade->assessment_student[0]->total_mark }}" max="100"
                                            class="w-full max-w-[290px] h-1.5 {{ $grade->assessment_student[0]->total_mark < 20 ? 'progress-error' : ($grade->assessment_student[0]->total_mark < 60 ? 'progress-warning' : 'progress-success') }}"/>
                            @endif

                        </div>
                    </div>
                    {{--                    @if($grade->assessment_student[0]->total_mark !== null)--}}
                    <p
                        class="font-normal text-[40px] lg:text-[52px] leading-[60px] lg:leading-[78px] tracking-[-6%] {{ $grade->assessment_student[0]->total_mark < 30 ? 'text-[#FF4A4A]' : ($grade->assessment_student[0]->total_mark < 60 ? 'text-[#F1BF4E]' : 'text-[#13C525]') }}"
                    >{{ $grade->assessment_student[0]->total_mark }}%</p>
                    {{--                    @else--}}
                    {{--                        <p--}}
                    {{--                            class="font-normal w-[150px] text-[20px] leading-[36px] text-right tracking-[-6%] text-[#FF4A4A]"--}}
                    {{--                        >Not yet graded</p>--}}
                    {{--                    @endif--}}
                </div>
            @endif
        @endforeach
    </div>
</div>
