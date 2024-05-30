<x-auth-layout>
    <div class="w-full flex flex-col items-center justify-start gap-[33px] pt-[50px] px-[10px] xl:pl-0">
        <div class="max-w-[692px] w-full lg:pl-[20px]">
            <x-ui.wlecome/>
        </div>
        <div
            class="w-full max-h-[70dvh] overflow-y-scroll max-w-[692px]
             bg-white rounded-[8px] flex flex-col items-center
             justify-start gap-[32px] px-[21px] xl:px-[45px] py-[41px]">
            <div class="w-full flex flex-row flex-wrap items-center justify-between gap-4">
                <p class="self-start">< <span class="w-[5px] inline-block"></span> View Course</p>
                @if(auth()->user()->role == 'admin')
                    <button data-ripple-light="true" data-dialog-target="dialog"
                            class="rounded-[10px] px-[15px] bg-primary py-[12px] text-white font-medium text-[12px] self-end">
                        + Assign students to course
                    </button>
                    <div data-dialog-backdrop="dialog" data-dialog-backdrop-close="true"
                         class="pointer-events-none fixed inset-0 z-[999] grid h-screen w-screen place-items-center bg-black bg-opacity-60 opacity-0 backdrop-blur-sm transition-opacity duration-300">
                        <div data-dialog="dialog"
                             class="relative m-4 w-full px-4 md:px-0 md:w-2/5 md:min-w-[40%] md:max-w-[40%] rounded-lg bg-white shadow-2xl">
                            <livewire:select-student :students="$allStudents" :course-id="$course->id"
                                                     :already-assigned-students="$students"/>
                        </div>
                    </div>
                @endif
            </div>
            <div class="flex flex-col items-center justify-start w-full gap-[31px]">
                @if($course->type == 'video' && (auth()->user()->role == 'admin' || auth()->user()->role == 'teacher'))
                    <div class="w-full flex flex-col md:flex-row justify-between items-end gap-4 md:gap-[31px]">
                        <video class="w-[308px] h-[196px] lg:w-[272px] lg:h-[289px] rounded-[8px]" controls>
                            <source src="{{ $course->video_url }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        <div class="flex flex-col justify-end items-start w-full gap-[20px]">
                            <h1 class="font-semibold text-[20px] max-h-[102px] truncate text-wrap lg:text-[24px] leading-[31px] lg:leading-[34px] text-text-5 md:w-[263px]">{{ $course->title }}</h1>
                            <p class="font-normal text-[12px] leading-[18px] text-text-2">
                                {{ $course->updated_at->format('d M, h:iA') }}
                            </p>
                            <div class="flex flex-row lg:flex-col w-full justify-between items-start">
                                <div class="flex flex-col items-start justify-start gap-1">
                                    <p class="font-normal text-[12px] lg:text-[13px] leading-[18px] lg:leading-[21px] lg:tracking-[0.3px] text-text-2">
                                        Duration</p>
                                    <p class="font-normal text-[17px] lg:text-[22px] leading-[25.5px] lg:leading-[33px] text-text-1 tracking-[-6%]">{{ $course->duration }}</p>
                                </div>
                                <div class="flex flex-col items-start justify-start gap-1">
                                    <p class="font-normal text-[12px] lg:text-[13px] leading-[18px] lg:leading-[21px] lg:tracking-[0.3px] text-text-2">
                                        Teacher</p>
                                    <p class="font-normal text-[17px] lg:text-[22px] leading-[25.5px] lg:leading-[33px] text-text-1 tracking-[-6%]">{{ $teacher->title. ' '. $teacher->first_name. ' '. $teacher->last_name }}</p>
                                    @if(auth()->user()->role == 'admin')
                                        <a href="#"
                                           class="font-semibold text-[12px] lg:text-[14px] leading-[18px] lg:leading-[21px] text-primary">Reassign
                                            new teacher >></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if($course->type == 'audio' || $course->type == 'video')
                    <div class="w-full flex flex-col justify-between items-end gap-4 md:gap-[31px]">
                        @if($course->type == 'video' && auth()->user()->role == 'student')
                            <video class="w-full h-[185px] md:h-[220px] lg:h-[302px] rounded-[8px]" controls>
                                <source src="{{ $course->video_url }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @endif
                        @if($course->type == 'audio')
                            <div
                                class="w-full h-[185px] md:h-[220px] lg:h-[302px] bg-bg-2 rounded-[8px] flex flex-col items-center justify-center">
                                <x-iconoir-headset
                                    class="w-[30px] h-[30px] flex-1 md:w-[40px] md:h-[40px] lg:w-[65px] lg:h-[65px] text-secondary"/>
                                <div class="self-baseline w-full mb-2">
                                    <div class="audio-player">
                                        <audio id="audio" preload="metadata">
                                            <source src="{{ $course->audio_url }}" type="audio/mpeg">
                                            Your browser does not support the audio element.
                                        </audio>
                                        <div class="controls">
                                            <button id="playPauseButton">
                                                <svg class="w-6 h-6 text-secondary " aria-hidden="true"
                                                     xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     fill="currentColor" viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd"
                                                          d="M8.6 5.2A1 1 0 0 0 7 6v12a1 1 0 0 0 1.6.8l8-6a1 1 0 0 0 0-1.6l-8-6Z"
                                                          clip-rule="evenodd"/>
                                                </svg>
                                            </button>
                                            <button class="hidden" id="stopButton">
                                                <svg class="w-6 h-6 text-secondary" aria-hidden="true"
                                                     xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     fill="currentColor" viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd"
                                                          d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm9-3a1 1 0 1 0-2 0v6a1 1 0 1 0 2 0V9Zm4 0a1 1 0 1 0-2 0v6a1 1 0 1 0 2 0V9Z"
                                                          clip-rule="evenodd"/>
                                                </svg>

                                            </button>
                                            <span id="duration" class="text-secondary">00:00 / 00:00</span>
                                        </div>
                                        <div class="progress-bar rounded-lg">
                                            <div id="progress rounded-lg"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="flex flex-col justify-end items-start w-full gap-[20px]">
                            <h1 class="font-semibold text-[20px] truncate text-wrap lg:text-[24px] leading-[31px] lg:leading-[34px] text-text-5 md:w-[263px]">{{ $course->title }}</h1>
                            <p class="font-normal text-[12px] leading-[18px] text-text-2">
                                {{ $course->updated_at->format('d M, h:iA') }}
                            </p>
                            <div class="flex flex-row w-full justify-between items-start">
                                <div class="flex flex-col items-start justify-start gap-1">
                                    <p class="font-normal text-[12px] lg:text-[13px] leading-[18px] lg:leading-[21px] lg:tracking-[0.3px] text-text-2">
                                        Duration</p>
                                    <p class="font-normal text-[17px] lg:text-[22px] leading-[25.5px] lg:leading-[33px] text-text-1 tracking-[-6%]">{{ $course->duration }}</p>
                                </div>
                                <div class="flex flex-col items-start justify-start gap-1">
                                    <p class="font-normal text-[12px] lg:text-[13px] leading-[18px] lg:leading-[21px] lg:tracking-[0.3px] text-text-2">
                                        Teacher</p>
                                    <p class="font-normal text-[17px] lg:text-[22px] leading-[25.5px] lg:leading-[33px] text-text-1 tracking-[-6%]">{{ $teacher->title. ' '. $teacher->first_name. ' '. $teacher->last_name }}</p>
                                    @if(auth()->user()->role == 'admin')
                                        <a href="#"
                                           class="font-semibold text-[12px] lg:text-[14px] leading-[18px] lg:leading-[21px] text-primary">Reassign
                                            new teacher >></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if($course->type == 'link')
                    <div class="w-full flex flex-row flex-wrap justify-between items-center">
                        <x-iconic-link class="w-[56px] h-[56px] lg:w-[78px] lg:h-[78px] text-secondary"/>
                        <div class="flex flex-col justify-end items-start w-full gap-[20px]">
                            <p class="font-normal text-[17px] lg:text-[22px] leading-[25.5px] lg:leading-[33px] text-text-1 tracking-[-6%]">{{ $teacher->title. ' '. $teacher->first_name. ' '. $teacher->last_name }}</p>
                            <h1 class="font-semibold text-[20px] max-h-[102px] truncate text-wrap lg:text-[24px] leading-[31px] lg:leading-[34px] text-text-5 md:w-[263px]">{{ $course->title }}</h1>
                        </div>
                    </div>
                @endif
                <div class="w-full flex flex-col gap-[10px] justify-start items-start">
                    <h1 class="font-semibold text-[13px] leading-[21px] text-text-5 uppercase">Description:</h1>
                    <p class="font-normal text-[13px] leading-[21px] text-text-2">{{ $course->description }}</p>
                </div>

                @if($course->type == 'link')
                    <div class="w-full flex flex-col gap-[10px] justify-start items-start">
                        <h1 class="font-semibold text-[13px] leading-[21px] text-text-5 uppercase">Link:</h1>
                        <p class="font-normal text-[24px] leading-[36px] text-secondary">{{ $course->link }}</p>
                    </div>

                    <div class="w-full flex flex-col gap-[10px] justify-start items-start">
                        <h1 class="font-semibold text-[13px] leading-[21px] text-text-5 uppercase">Date and Time:</h1>
                        <p class="font-normal text-[24px] leading-[36px] text-secondary">{{ $course->date->format('d/m/y H:i') . ' '. $course->time->format('h') }}</p>
                    </div>
                @endif
            </div>
        </div>
        <div
            class="w-full max-w-[692px] flex flex-col items-center md:items-start justify-start gap-[16px]">
            <h1 class="pl-[20px] font-semibold text-left leading-[24px] text-text-1 text-[16px] self-start">
                Students</h1>
            <x-ui.many-student-card :lists="$students"/>
        </div>
    </div>
</x-auth-layout>

<style>
    .audio-player {
        width: 100%;
        background-color: transparent;
        padding: 20px;
        box-sizing: border-box;
    }

    .controls {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .progress-bar {
        width: 100%;
        height: 10px;
        background-color: #fff;
        margin-top: 10px;
    }

    #progress {
        height: 10px;
        background-color: #8F00FF;
        width: 0;
    }
</style>


<script>
    const audio = document.getElementById('audio');
    const playPauseButton = document.getElementById('playPauseButton');
    const stopButton = document.getElementById('stopButton');
    const durationLabel = document.getElementById('duration');
    const progressBar = document.getElementById('progress');

    playPauseButton.addEventListener('click', function () {
        audio.play();
        playPauseButton.classList.add('hidden');
        stopButton.classList.remove('hidden');
    });

    stopButton.addEventListener('click', function () {
        audio.pause();
        audio.currentTime = 0;
        playPauseButton.classList.remove('hidden');
        stopButton.classList.add('hidden');
    });

    audio.addEventListener('timeupdate', function () {
        const progress = (audio.currentTime / audio.duration) * 100;
        progressBar.style.width = progress + '%';

        const currentMinutes = Math.floor(audio.currentTime / 60);
        const currentSeconds = Math.floor(audio.currentTime - currentMinutes * 60);

        const totalMinutes = Math.floor(audio.duration / 60);
        const totalSeconds = Math.floor(audio.duration - totalMinutes * 60);

        durationLabel.textContent = currentMinutes.toString().padStart(2, '0') + ':' + currentSeconds.toString().padStart(2, '0') + '/' + totalMinutes.toString().padStart(2, '0') + ':' + totalSeconds.toString().padStart(2, '0');
    });
</script>
