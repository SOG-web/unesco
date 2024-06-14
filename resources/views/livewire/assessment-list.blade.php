<div
    class="w-full max-w-[692px] max-h-[80dvh] overflow-y-scroll scroll-smooth py-[31px] flex flex-col items-center justify-start gap-[25px] bg-white rounded-[10px] px-[21px] xl:px-[45px]">
    <div
        class="w-full self-start flex flex-row items-center justify-between mb-[9px] flex-wrap">
        <h1 class="font-poppins font-semibold text-text-1 text-[16px] md:text-[18px] lg:text-[22px]">
            Manage Assessments</h1>
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
    <x-custom-tabs label-class="font-semibold text-[14px] text-[#9E9E9E]" label-div-class="flex overflow-x-auto w-full"
                   active-class='bg-[#DAD9F5] rounded-[6px] !text-[#605C9D]'
                   wire:model="selectedTab"
                   class="!border-none w-full">
        <x-tab id="all-tab" name="all-tab" label="All" class="!border-none">
            <div class="w-full flex flex-col items-start justify-start gap-4 !border-none">
                @foreach($allAssessments as $assessment)
                    <x-ui.assessment-card :assessment="$assessment" :show="true"/>
                @endforeach
            </div>
        </x-tab>
        <x-tab id="graded" name="graded" label="Graded">
            <div class="w-full flex flex-col items-start justify-start gap-4">
                @foreach($gradedAssessments as $assessment)
                    <x-ui.assessment-card :assessment="$assessment" :show="true"/>
                @endforeach
            </div>
        </x-tab>
        <x-tab id="ungraded" name="ungraded">
            <x-slot:label>
                Ungraded
                <x-badge value="{{ count($ungradedAssessments) }}" class="badge-error text-white"/>
            </x-slot:label>
            <div class="w-full flex flex-col items-start justify-start gap-4">
                @foreach($ungradedAssessments as $assessment)
                    <x-ui.assessment-card :assessment="$assessment" :show="true"/>
                @endforeach
            </div>
        </x-tab>
    </x-custom-tabs>
</div>
