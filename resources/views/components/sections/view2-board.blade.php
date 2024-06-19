@props(['teachers', 'students' => [], 'assessments', 'title1' => 'Teachers', 'title2' => 'Students', 'grades' => []])

<div class="w-full max-w-[692px] flex flex-col md:flex-row items-center md:items-start justify-between gap-[44px]">
    <div class="w-full flex flex-col items-center justify-start gap-[16px]">
        <h1 class="pl-[20px] font-semibold text-left leading-[24px] text-text-1 text-[16px] self-start">
            {{ $title1 }}</h1>
        @if($teachers)
            <x-ui.view3-board type="course" :lists="$teachers"/>
        @else
            @foreach($assessments as $assessment)
                <livewire:type-one-assessment-card :assessment="$assessment"/>
            @endforeach
        @endif
    </div>
    <div
        class="w-full {{ auth()->user()->role !== 'admin' ? 'max-w-[284px]' : '' }} flex flex-col items-center justify-start gap-[16px]">
        <h1 class="pl-[20px] font-semibold text-left leading-[24px] text-text-1 text-[16px] self-start">
            {{ $title2 }}</h1>
        @if($students)
            <x-ui.view3-board :lists="$students"/>
        @endif
        @if($grades)
            <livewire:dash-grade-card :grades="$grades"/>
        @endif
    </div>
</div>
