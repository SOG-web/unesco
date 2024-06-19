<?php

use App\Models\Assessment;
use Illuminate\Support\Facades\DB;
use Livewire\Volt\Component;

new class extends Component {
    public $list;
    public $pivot;
    public $assessment;

    public function mount($list): void
    {
        $this->list = $list;
        $this->pivot = $list['pivot'];

        // get the assessment where assessment_id is equal to the pivot assessment_id and user_id is equal to the pivot user_id
        $this->assessment = DB::table('assessment_student')
            ->where('assessment_id', $this->pivot['assessment_id'])
            ->where('user_id', $this->pivot['user_id'])
            ->first();
    }
}; ?>

<div class="w-full flex flex-row flex-wrap items-center justify-between">
    <div class="flex flex-row items-center justify-start gap-4">
        <div class="w-[43px] h-[43px] bg-[#F3E4FF] rounded-full">
            <img src="{{ $list['profile_pic'] }}" alt="profile image"
                 class="w-full h-full object-cover rounded-full">
        </div>
        <div class="flex flex-col items-start justify-start">
            <h1 class="max-w-[150px] truncate font-poppins font-semibold text-text-1 text-[12px]">
                {{ $list['first_name'] . ' ' . $list['last_name'] }}</h1>
            <p class="max-w-[120px] truncate font-poppins font-normal text-text-2 text-[12px]">{{ $list['email'] }}</p>
        </div>
    </div>
    @if($assessment->status === 'completed' && $assessment->total_mark === null)
        <a href="#"
           class="hidden md:block font-poppins font-semibold text-[14px] text-left text-sky-900 w-full view"
        >View response and grade ></a>
    @elseif($assessment->status === 'completed' && $assessment->total_mark !== null)
        <x-progress value="{{$assessment->total_mark }}" max="100"
                    class="w-[123px] h-1.5 {{ $assessment->total_mark < 20 ? 'progress-error' : ($assessment->total_mark < 60 ? 'progress-warning' : 'progress-success') }}"/>
        <p
            class="font-normal text-[24px] leading-[36px] tracking-[-6%] {{ $assessment->total_mark < 30 ? 'text-[#FF4A4A]' : ($assessment->total_mark < 60 ? 'text-[#FFB200]' : 'text-[#13C525]') }}"
        >{{ $assessment->total_mark }}%</p>
    @endif

</div>
