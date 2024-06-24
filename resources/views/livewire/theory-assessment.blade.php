<?php

use App\Models\Assessment;
use App\Models\AssessmentStudent;
use App\Models\User;
use Livewire\Volt\Component;

new class extends Component {

    public AssessmentStudent $assessment;
    public $student;
    public int $current = 0;
    public $answers;
    public $score;
    public Assessment $assess;

    public function mount($assessment, $student)
    {
        $this->assessment = $assessment;
        $this->student = $student[0];
        $this->answers = json_decode($assessment->answers);
        foreach ($this->answers as $answer) {
            $answer->score = null;
        }

        $this->assess = Assessment::find($assessment->assessment_id);
    }

    public function change($cur)
    {
        if ($this->answers[$cur]->score !== null) {
            $this->score = $this->answers[$this->current]->score;
        }
        $this->current = $cur;
    }

    public function grade()
    {
        if ($this->score === null) {
            return;
        }
        if ((int) $this->score !== $this->assess->mark_per_questions) {
            // return error
            $this->addError('score', 'The score does not match the mark per question.');
            return;
        }
        $this->answers[$this->current]->score = (int) $this->score;
        $this->current += 1;
        $this->score = null;
    }

    public function submit()
    {
        $this->assessment->answers = json_encode($this->answers);
        $this->assessment->status = 'completed';
        $this->assessment->total_mark = array_sum(array_column($this->answers, 'score'));
        $this->assessment->save();

        return redirect()->route('assessments');
    }


    public function goBack()
    {
        return redirect()->back();
    }
}; ?>

<div>
    <div
        class="w-full max-w-[692px] lg:min-w-[600px] max-h-[80dvh] overflow-y-scroll scroll-smooth py-[31px] flex flex-col items-center justify-start gap-[25px] bg-white rounded-[10px] px-[21px] xl:px-[45px]">
        <div
            class="w-full self-start flex flex-row items-center justify-between gap-[30px] mb-[9px] flex-wrap">
            <h1 class="font-poppins font-semibold text-text-1 text-[16px] md:text-[18px] lg:text-[22px] cursor-pointer"
                wire:click="goBack">
                < View Assessment</h1>
            <form class="hidden" method="POST" id="createForm" action="{{ route('assessments.create') }}">
                @csrf
                @method('GET')
            </form>
            <button type="submit" form="createForm" id="createForm"
                    class="rounded-[10px] px-[15px] bg-primary py-[12px] text-white font-medium text-[12px] self-end"
                    data-target="tab1">+ Add New Assessment
            </button>
        </div>
        <x-ui.assessment-card :assessment="$assess" :count="true"/>
        <div class="w-full flex flex-row items-start justify-between flex-wrap">
            <div class="flex flex-col items-start justify-start gap-1.5">
                <p class="text-[#9E9E9E] text-[14px] font-medium text-left">Assessment Type</p>
                <p class="capitalize text-[#272835] text-[16px] md:text-[20px] font-semibold text-left"> {{ $assess->type }}</p>
            </div>
            <div class="flex flex-col items-start justify-start gap-1.5">
                <p class="text-[#9E9E9E] text-[14px] font-medium text-left">Mark Per Question</p>
                <p class="capitalize text-[#272835] text-[16px] md:text-[20px] font-semibold text-left"> {{ $assess->mark_per_questions }}</p>
            </div>
        </div>
    </div>
    <div
        class="w-full max-w-[692px] mt-[40px] flex flex-col items-center justify-start bg-white rounded-[10px] pb-[34px] md:pb-[40px] px-[22px] md:px-[30px] pt-[29px] md:pt-[39px] gap-[40px]">
        <div class="flex items-center w-[100%] flex-row justify-between">
            <div class="justify-start flex items-center flex-row gap-2">
                <p class="font-semibold text-[16px] md:text-[22px] text-[#272835] leading-[24px] md:leading-[33px]">
                    <</p>
                <p
                    class="font-semibold text-[16px] md:text-[22px] text-[#272835] leading-[24px] md:leading-[33px] truncate"
                >
                    Grade response - {{ $student->first_name. ' '. $student->last_name }}
                </p>
            </div>
            <div class="w-[55px] hidden md:flex h-[55px] rounded-full bg-background items-center justify-center">
                <span
                    class="text-[20px] text-primary font-bold font-poppins">{{ substr($student->first_name, 0, 1) }} {{ substr($student->last_name, 0, 1) }}</span>
            </div>
        </div>
        @foreach($answers as $index => $aq)
            <div class="collapse collapse-arrow">
                <input wire:click="change({{ $index }})" type="radio"
                       name="my-accordion-2" {{ $index === $current ? 'checked' : '' }} />
                <div class="collapse-title flex flex-row items-center justify-between w-full">
                    <p class="font-semibold text-[14px] leading-[21px] text-[#595B61]">Question {{ $index + 1 }}</p>
                    @if($index !== $current)
                        <div class="flex flex-row items-center justify-start gap-4 pr-[40px]">
                            <div class="flex flex-row items-center justify-start gap-2">
                                <p class="font-semibold text-[14px] leading-[21px] text-[#595B61]">Score:</p>
                                <p class="text-primary text-[14px] leading-[21px] text-right">
                                    {{ $aq->score === null ? 'not graded' : $aq->score }}
                                </p>
                            </div>
                            <button wire:click="change({{ $index }})"
                                    class="text-primary text-[14px] leading-[21px] text-right">edit grade
                            </button>
                        </div>
                    @endif
                </div>
                <div class="collapse-content">
                    <p class="font-normal w-full text-[12px] leading-[18px] text-[#9E9E9E] border-[#CCCCCC] border-2 rounded-[9px] py-[15px] px-[30px]">
                        {{ $aq->question }}
                    </p>
                    {{--                    <div class="flex flex-row max-w-[456px] justify-between items-center">--}}
                    {{--                        <div class="flex pt-4 md:pt-8 items-center md:flex-col gap-2">--}}
                    {{--                            <p class="font-semibold text-[#595B61] text-[16px] leading-[24px]">--}}
                    {{--                                Score:--}}
                    {{--                            </p>--}}
                    {{--                            <p class="font-normal text-[32px] leading-[48px] text-[#595B61]">--}}
                    {{--                                {{ $assessment->total_mark === null ? 'not graded' : $assessment->total_mark }}--}}
                    {{--                            </p>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                    <div class="flex flex-col items-start justify-start mt-[20px] gap-2">
                        <p class="font-semibold text-[14px] leading-[21px] text-[#595B61]">Answer</p>
                        <p class="font-normal w-full text-[12px] leading-[18px] text-[#9E9E9E] border-[#CCCCCC] border-2 rounded-[9px] py-[15px] px-[30px]">
                            {{ $aq->answer }}
                        </p>
                    </div>
                    <div class="flex flex-col items-start justify-start w-full mt-[20px] gap-2">
                        <p class="font-semibold text-[14px] leading-[21px] text-[#595B61]">Score</p>
                        <x-form wire:submit="grade" class="w-full gap-[32px]">
                            <x-input type="number" wire:model="score" required/>
                            <x-button label="Grade" spinner="grade" type="submit"
                                      class="select-none rounded-lg bg-primary w-full max-w-[200px] py-3.5 px-7 text-center align-middle font-poppins text-sm font-bold uppercase text-white shadow-md leading-snug shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"/>
                        </x-form>
                    </div>
                </div>
            </div>
        @endforeach
        @if($current + 1 > count($answers))
            <x-form class="w-full gap-[32px]">
                <x-button label="Submit" spinner="submit" wire:click="submit"
                          class="select-none rounded-lg bg-primary w-full max-w-[200px] py-3.5 px-7 text-center align-middle font-poppins text-sm font-bold uppercase text-white shadow-md leading-snug shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"/>
            </x-form>
        @endif
    </div>
</div>
