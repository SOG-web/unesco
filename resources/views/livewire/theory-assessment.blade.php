<?php

use App\Models\Assessment;
use App\Models\AssessmentStudent;
use App\Models\User;
use Livewire\Volt\Component;

new class extends Component {

    public AssessmentStudent $assessment;
    public $student;
    public string $group = 'group0';
    public $answers;

    public function mount($assessment, $student)
    {
        $this->assessment = $assessment;
        $this->student = $student[0];
        $this->answers = json_decode($assessment->answers);
    }


    public function goBack()
    {
        return redirect()->route('assessments');
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
        <x-ui.assessment-card :assessment="$assessment" :count="false"/>
        <div class="w-full flex flex-row items-start justify-between flex-wrap">
            <div class="flex flex-col items-start justify-start gap-1.5">
                <p class="text-[#9E9E9E] text-[14px] font-medium text-left">Assessment Type</p>
                <p class="capitalize text-[#272835] text-[16px] md:text-[20px] font-semibold text-left"> {{ $assessment->type }}</p>
            </div>
        </div>
    </div>
    <div
        class="w-full max-w-[692px] mt-[40px] flex flex-col items-center justify-start bg-white rounded-[10px] pb-[34px] md:pb-[40px] md:pr-[60px] pr-[22px] pl-[22px] pt-[29px] md:pt-[39px] md:pl-[78px] gap-[40px]">
        <div class="flex items-center w-[100%] flex-row justify-between">
            <div class="justify-start flex items-center flex-row gap-2">
                <p class="font-semibold text-[16px] md:text-[22px] text-[#272835] leading-[24px] md:leading-[33px]">
                    <</p>
                <p
                    class="font-semibold text-[16px] md:text-[22px] text-[#272835] leading-[24px] md:leading-[33px]"
                >
                    Grade response - {{ $student->first_name. ' '. $student->last_name }}
                </p>
            </div>
            <div class="w-[55px] hidden md:flex h-[55px] rounded-full bg-background items-center justify-center">
                <span
                    class="text-[20px] text-primary font-bold font-poppins">{{ substr($student->first_name, 0, 1) }} {{ substr($student->last_name, 0, 1) }}</span>
            </div>
        </div>
        <x-accordion class="w-full !border-none" wire:model="group">
            @foreach($answers as $index => $aq)
                <x-collapse :name="'group'.$index">
                    <x-slot:heading>
                        <div
                            class="max-w-[456px] items-center flex flex-row justify-between"
                        >
                            <p
                                class="font-semibold text-[#595B61] text-[14px] leading-[21px]"
                            >
                                Question {{ $index + 1 }}
                            </p>
                            <p
                                class="font-semibold hidden md:flex text-[14px] leading-[21px] text-[#002979]"
                            >
                                edit grade
                            </p>
                        </div>
                    </x-slot:heading>
                    <x-slot:content>
                        <div class="flex w-[456px] gap-[5px] flex-col">
                            <p
                                class="font-normal w-[350px] md:w-[456px] text-[12px] leading-[18px] text-[#9E9E9E]"
                            >
                                {{ $aq->question }}
                            </p>
                        </div>
                        <div class="flex flex-row max-w-[456px] justify-between items-center">
                            <div class="flex pt-4 md:pt-8 items-center md:flex-col gap-2">
                                <p
                                    class="font-semibold text-[#595B61] text-[16px] leading-[24px]"
                                >
                                    Score:
                                </p>
                                <p class="font-normal text-[32px] leading-[48px] text-[#595B61]">
                                    {{ $assessment->total_mark === null ? 'not graded' : $assessment->total_mark }}
                                </p>
                            </div>
                        </div>
                        {{ $aq->answer }}</x-slot:content>
                </x-collapse>
            @endforeach
        </x-accordion>
    </div>
</div>
