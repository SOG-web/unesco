

<x-auth-layout>
    <div class="w-full flex flex-col items-center justify-start gap-[33px] pt-[50px] px-[10px] xl:pl-0">
        <div class="max-w-[692px] w-full lg:pl-[20px]" >
            <x-ui.wlecome />
        </div>
        <div
            class="w-full max-h-[70dvh] overflow-y-scroll max-w-[692px]
             bg-white rounded-[8px] flex flex-col items-center
             justify-start gap-[32px] lg:gap-[42px] px-[21px] xl:px-[45px] py-[41px]">
            <div class="w-full flex flex-row flex-wrap items-center justify-between gap-4" >
                <p class="self-start" >< <span class="w-[5px] inline-block" ></span> View Course</p>
                @if(auth()->user()->role == 'admin')
                    <button data-ripple-light="true" data-dialog-target="dialog"
                            class="rounded-[10px] px-[15px] bg-primary py-[12px] text-white font-medium text-[12px] self-end">
                        + Assign students to course
                    </button>
                    <div data-dialog-backdrop="dialog" data-dialog-backdrop-close="true"
                         class="pointer-events-none fixed inset-0 z-[999] grid h-screen w-screen place-items-center bg-black bg-opacity-60 opacity-0 backdrop-blur-sm transition-opacity duration-300">
                        <div data-dialog="dialog"
                             class="relative m-4 w-full px-4 md:px-0 md:w-2/5 md:min-w-[40%] md:max-w-[40%] rounded-lg bg-white shadow-2xl">
                            <livewire:select-student :students="$allStudents" :course-id="$course->id" :already-assigned-students="$students" />
                        </div>
                    </div>
                @endif
            </div>
            <div class="flex flex-col items-center justify-start w-full gap-[31px]" >
                <div class="w-full flex flex-col md:flex-row justify-between items-end gap-4 md:gap-[31px]" >
{{--                    @if($course->type == 'video') @endif--}}
                    <video class="w-[308px] h-[196px] lg:w-[272px] lg:h-[289px] rounded-[8px]" controls>
                        <source src="{{ $course->video_url }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <div class="flex flex-col justify-end items-start w-full gap-[20px]" >
                        <h1 class="font-semibold text-[20px] max-h-[102px] truncate text-wrap lg:text-[24px] leading-[31px] lg:leading-[34px] text-text-5 md:w-[263px]" >{{ $course->title }}</h1>
{{--                        <p class="font-normal text-[12px] leading-[18px] text-text-2" >--}}
{{--                            {{ Cabon::parse($course->updated_at)->format('d M, h:iA') }}--}}
{{--                        </p>--}}
                        <div class="flex flex-row lg:flex-col w-full justify-between items-start" >
                            <div class="flex flex-col items-start justify-start gap-1" >
                                <p class="font-normal text-[12px] lg:text-[13px] leading-[18px] lg:leading-[21px] lg:tracking-[0.3px] text-text-2" >Duration</p>
                                <p class="font-normal text-[17px] lg:text-[22px] leading-[25.5px] lg:leading-[33px] text-text-1 tracking-[-6%]" >{{ $course->duration }}</p>
                            </div>
                            <div class="flex flex-col items-start justify-start gap-1" >
                                <p class="font-normal text-[12px] lg:text-[13px] leading-[18px] lg:leading-[21px] lg:tracking-[0.3px] text-text-2" >Teacher</p>
                                <p class="font-normal text-[17px] lg:text-[22px] leading-[25.5px] lg:leading-[33px] text-text-1 tracking-[-6%]" >{{ $teacher->title. ' '. $teacher->first_name. ' '. $teacher->last_name }}</p>
                                <a href="#" class="font-semibold text-[12px] lg:text-[14px] leading-[18px] lg:leading-[21px] text-primary" >Reassign new teacher >></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full flex flex-col gap-[10px] justify-start items-start" >
                    <h1 class="font-semibold text-[13px] leading-[21px] text-text-5 uppercase" >Description:</h1>
                    <p class="font-normal text-[13px] leading-[21px] text-text-2" >{{ $course->description }}</p>
                </div>
            </div>
        </div>
        <div
            class="w-full max-w-[692px] flex flex-col items-center md:items-start justify-start gap-[16px]">
            <h1 class="pl-[20px] font-semibold text-left leading-[24px] text-text-1 text-[16px] self-start" >Students</h1>
            <x-ui.many-student-card :lists="$students" />
        </div>
    </div>
</x-auth-layout>
