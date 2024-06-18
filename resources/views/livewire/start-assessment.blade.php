<div
    class="w-full max-w-[692px] max-h-[80dvh] overflow-y-scroll scroll-smooth py-[31px] flex flex-col items-center justify-start gap-[25px] bg-white rounded-[10px] px-[21px] xl:px-[45px]"
>
    <div class="w-full max-w-[518px] self-start justify-between flex flex-row items-center  mb-[9px] flex-wrap">
        <h1 class="font-poppins font-semibold text-text-1 text-[16px] md:text-[18px] lg:text-[22px]">
            < Time remaining: <span id="timer" class="text-red-500">00</span></h1>
    </div>
    <div class="w-full flex flex-col items-start justify-start gap-[12px] pt-8">
        <p
            class="font-semibold text-[24px] leading-[38px] tracking-tight-[0.3px]"
        >
            Question {{ $activeQuestion + 1 }} of {{ count($questions) }}
        </p>
        <div class="w-full flex flex-col items-start justify-center">
            @error('all')
            <p class="font-normal w-full text-center my-1.5 text-[16px] leading-[24px] text-red-500">
                {{ $message }}
            </p>
            @enderror
            @if($assessment->type === 'theory')
                <p class="font-normal text-[16px] leading-[24px] text-[#272835]">
                    {{ $questions[$activeQuestion]->question }}
                </p>
                <div class="w-full mt-4">
                    <x-textarea
                        label="Enter your answer"
                        wire:model="answer"
                        placeholder="Type or paste question here....."
                        hint="Max 1000 chars"
                        rows="7"
                        required
                    />
                </div>

            @endif
        </div>
    </div>
    <div class="w-full flex flex-row items-start justify-start gap-2">
        @if($activeQuestion !== count($questions) - 1)
            <x-button
                class="mt-[16px] w-[151px] select-none rounded-lg bg-primary max-w-[250px] py-3.5 px-5 text-center align-middle font-poppins text-sm font-bold uppercase text-white shadow-md leading-snug shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                label="next >" wire:click="nextQuestion"
                spinner="nextQuestion"
            />
        @endif
        @if($activeQuestion !== 0)
            <x-button
                class="mt-[16px] w-[151px] select-none rounded-lg bg-primary max-w-[250px] py-3.5 px-5 text-center align-middle font-poppins text-sm font-bold uppercase text-white shadow-md leading-snug shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                label="< prev" wire:click="previousQuestion"
                spinner="previousQuestion"
            />
        @endif
        @if($activeQuestion === count($questions) - 1)
            <x-button
                class="mt-[16px] w-[151px] select-none rounded-lg bg-primary max-w-[250px] py-3.5 px-5 text-center align-middle font-poppins text-sm font-bold uppercase text-white shadow-md leading-snug shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                label="Submit" wire:click="submitAssessment"
                spinner="submitAssessment"
            />
        @endif
    </div>
    <div class="w-full pt-4 gap-2 grid grid-cols-5 md:grid-cols-10">
        @foreach($questions as $index => $question)
            <x-button
                class="flex {{ $activeQuestion === $index ? 'bg-[#7792AC]' : 'bg-[#E8EFF6]' }} items-center justify-center w-[32px] h-[32px] rounded-[4px]"
                label="{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}" wire:click="setActiveQuestion({{ $index }})"
                spinner="setActiveQuestion"
            />
        @endforeach
    </div>
</div>


<script>
    // 50 minutes countdown timer
    var timed = 50 * 60;
    const timer = document.getElementById('timer');

    const countDown = setInterval(() => {
        const minutes = Math.floor(timed / 60);
        let seconds = timed % 60;
        seconds = seconds < 10 ? '0' + seconds : seconds;
        timer.textContent = `${minutes}:${seconds}`;
        timed--;
        if (timed < 0) {
            clearInterval(countDown);
            alert('Time is up!');
            // go to result page
        }
    }, 1000);
</script>
