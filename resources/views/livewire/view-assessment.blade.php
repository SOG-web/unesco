<?php

use App\Models\Assessment;
use Livewire\Volt\Component;

new class extends Component {

    public Assessment $assessment;

    public function mount($assessment): void
    {
        $this->assessment = $assessment;
    }

    public function goBack()
    {
        return redirect()->route('assessments');
    }

}; ?>


<div>
    <div
        class="w-full max-w-[692px] max-h-[80dvh] overflow-y-scroll scroll-smooth py-[31px] flex flex-col items-center justify-start gap-[25px] bg-white rounded-[10px] px-[21px] xl:px-[45px]">
        <div
            class="w-full self-start flex flex-row items-center justify-between gap-[30px] mb-[9px] flex-wrap">
            <h1 class="font-poppins font-semibold text-text-1 text-[16px] md:text-[18px] lg:text-[22px] cursor-pointer"
                wire:click="goBack">
                < View Assessment</h1>
            @if(auth()->user()->role == 'teacher')
                <form class="hidden" method="POST" id="createForm" action="{{ route('assessments.create') }}">
                    @csrf
                    @method('GET')
                </form>
                <button type="submit" form="createForm" id="createForm"
                        class="rounded-[10px] px-[15px] bg-primary py-[12px] text-white font-medium text-[12px] self-end"
                        data-target="tab1">+ Add New Assessment
                </button>
            @endif
        </div>
        <x-ui.assessment-card :assessment="$assessment"/>
        <div class="w-full flex-row items-start justify-center gap-[20px] flex-wrap">
            <div class="flex flex-col items-start justify-start gap-1.5">
                <p class="text-[#9E9E9E] text-[14px] font-medium text-left">Assessment Type</p>
                <p class="capitalize text-[#272835] text-[16px] md:text-[20px] font-semibold text-left"> {{ $assessment->type }}</p>
            </div>
        </div>
    </div>

    <div
        class="w-full mt-[30px] max-w-[692px] max-h-[80dvh] overflow-y-scroll scroll-smooth py-[31px] flex flex-col items-center justify-start gap-[25px] bg-white rounded-[10px] px-[21px] xl:px-[45px]">
        responses
    </div>
</div>
