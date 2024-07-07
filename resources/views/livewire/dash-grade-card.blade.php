<?php

use App\Models\Course;
use Livewire\Volt\Component;

new class extends Component {
    public $grades;

    public function mount($grades)
    {
        $this->grades = $grades;


    }
}; ?>

<div
    class="w-full max-w-[323px] py-[31px] flex flex-col items-start justify-start gap-[30px] bg-white rounded-[10px] px-[21px]">
    @foreach($grades as $grade)
        <div class="w-full flex flex-row items-center justify-between">
            <div class="flex flex-row items-center justify-start gap-[10px]">
                <div
                    class="flex items-center justify-center w-[43px] h-[36px] bg-[#F3E4FF] rounded-[8px] px-1.5 overflow-hidden">
                    <p class="max-w-[33px] h-[30px] truncate font-semibold text-center leading-[11.87px] text-text-1 text-[12px] text-wrap">
                        {{ $grade['course']['slug'] }}</p>
                </div>
                <h1 class="max-w-[98px] truncate font-poppins font-medium text-text-1 text-[12px]">
                    {{ $grade['title'] }}</h1>
            </div>
            <div class="flex flex-col items-center justify-center self-end">
                <p
                    class="font-normal text-[24px] leading-[36px] tracking-[-6%] {{ $grade['pivot_total_mark'] < 30 ? 'text-[#FF4A4A]' : ($grade['pivot_total_mark'] < 60 ? 'text-[#FFB200]' : 'text-[#13C525]') }}"
                >{{ $grade['pivot_total_mark'] }}%</p>
                <x-progress value="{{ $grade['pivot_total_mark'] }}" max="100"
                            class="w-full max-w-[290px] h-1.5 {{ $grade['pivot_total_mark'] < 30 ? 'progress-error' : ($grade['pivot_total_mark'] < 60 ? 'progress-warning' : 'progress-success') }}"/>
            </div>
        </div>
    @endforeach
</div>
