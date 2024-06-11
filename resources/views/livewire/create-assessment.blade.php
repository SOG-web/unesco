<div
    x-data="{
    type: @entangle('type'), currentStep: @entangle('currentStep'),
    add_question: @entangle('add_question'), correct_options: @entangle('correct_options')
    }"
    class="w-full max-w-[692px] max-h-[80dvh] overflow-y-scroll scroll-smooth py-[31px] flex flex-col items-center justify-start gap-[25px] bg-white rounded-[10px] px-[21px] xl:px-[45px]">
    <div class="w-full max-w-[518px] justify-start gap-[10px] flex flex-row items-center  mb-[9px] flex-wrap">
        <p class="text-primary"> < </p>
        <h1 class="font-poppins font-semibold text-text-1 text-[16px] md:text-[18px] lg:text-[22px]">
            {{ $currentStep === 1 ? 'Add New Assessment' : 'Add Question 1 of '. $number_of_question_allowed}}
        </h1>
    </div>
    <template x-if="currentStep === 1">
        <div class="w-full max-w-[518px]">
            <x-form wire:submit="saveStepOne" class="w-full gap-[32px] mb-[20px]">
                <x-select placeholder="Select a Course" required label="Select Course" :options="$courses"
                          wire:model="selectedCourse"/>
                <div class="flex flex-col items-start justify-start gap-[10px] w-full">
                    <p class="font-semibold text-[14px] lg:text-[16px] leading-[21px] lg:leading-[24px] text-text-4">
                        Assessment active:</p>
                    <div class="flex flex-row items-center justify-between gap-[20px] w-full">

                        <x-datetime class="w-full" label="From" wire:model="start_date" icon="o-calendar"/>

                        <x-datetime class="w-full" label="To" wire:model="end_date" icon="o-calendar"/>

                    </div>
                </div>
                <x-select placeholder="Multiple-choice or theory (select one)" required label="Select assessment type"
                          :options="$types"
                          wire:model="type"/>
                <template x-if="type === 'multiple-choice'">
                    <x-input label="Marks per question (for multiple choice question types only)"
                             wire:model="mark_per_question" type="number"/>
                </template>
                <x-select placeholder="Yes or no (select one)" required
                          label="Show results immediately after assessment?" :options="$show_results"
                          wire:model="show_result"/>
                <x-button
                    class="mt-[16px] select-none rounded-lg bg-primary w-full max-w-[200px] py-3.5 px-7 text-center align-middle font-poppins text-sm font-bold uppercase text-white shadow-md leading-snug shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                    label="Add questions >" type="submit" spinner="saveStepOne"/>
            </x-form>
        </div>
    </template>
    <template x-if="currentStep === 2">
        <div class="w-full max-w-[518px]">
            <template x-if="add_question === true">
                <x-form class="w-full gap-[32px] mb-[20px]">
                    @if($type === 'multiple-choice')
                        <x-textarea
                            label="Enter Question"
                            required
                            wire:model="multi_choice_question"
                            placeholder="Type or paste question here....."
                            hint="Max 1000 chars"
                            rows="7"
                        />
                        <x-input required label="Option A" wire:change.debounce="setCorrectOption" wire:model="option_a"
                                 placeholder="Enter Option A"/>
                        <x-input required label="Option B" wire:change.debounce="setCorrectOption" wire:model="option_b"
                                 placeholder="Enter Option B"/>
                        <x-input required label="Option C" wire:change.debounce="setCorrectOption" wire:model="option_c"
                                 placeholder="Enter Option C"/>
                        <x-input required label="Option D" wire:change.debounce="setCorrectOption" wire:model="option_d"
                                 placeholder="Enter Option D"/>
                        <x-select required placeholder="Select correct option" required label="Correct Option"
                                  :options="$correct_options"
                                  hint="Not seeing option? Wait till it update and click again."
                                  wire:model="correct_option"/>
                    @endif
                    @if($type === 'theory')
                        <x-textarea
                            label="Enter Question"
                            wire:model="theory_question"
                            placeholder="Type or paste question here....."
                            hint="Max 1000 chars"
                            rows="7"
                        />
                    @endif
                    <x-button
                        class="mt-[16px] select-none rounded-lg bg-primary w-full max-w-[200px] py-3.5 px-7 text-center align-middle font-poppins text-sm font-bold uppercase text-white shadow-md leading-snug shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                        label="Add question >" wire:click="addQuestion"
                        spinner="addQuestion"/>
                </x-form>
            </template>
            <template x-if="add_question === false && type === 'multiple-choice'">
                <div class="w-full flex flex-col gap-[30px] items-center justify-center">
                    @foreach($questions as $question)
                        <div class="w-full flex flex-col gap-[20px] items-center justify-center">
                            <p class="text-[#9E9E9E] text-[12px] md:text-[14px] leading-[18px] md:leading-[24px] font-normal">{{ $question['question'] }}</p>
                            <div class="w-full flex flex-col gap-[10px] items-center justify-center">
                                <div class="flex w-full flex-row items-center justify-center gap-[20px]">
                                    <div class="w-full flex flex-row items-center justify-start gap-[10px]">
                                        <div
                                            class="w-[50px] h-[50px] bg-[#F2F2F2] rounded-[10px] flex items-center justify-center">
                                            <p class="text-[#9E9E9E] text-[12px] md:text-[14px] leading-[18px] md:leading-[24px] font-normal">
                                                A</p>
                                        </div>
                                        <p class="text-[#9E9E9E] max-w-[200px] truncate text-[12px] md:text-[14px] leading-[18px] md:leading-[24px] font-normal">{{ $question['options']['option_a'] }}</p>
                                    </div>
                                    <div class="w-full flex flex-row items-center justify-start gap-[10px]">
                                        <div
                                            class="w-[50px] h-[50px] bg-[#F2F2F2] rounded-[10px] flex items-center justify-center">
                                            <p class="text-[#9E9E9E] text-[12px] md:text-[14px] leading-[18px] md:leading-[24px] font-normal">
                                                B</p>
                                        </div>
                                        <p class="text-[#9E9E9E] max-w-[200px] truncate text-[12px] md:text-[14px] leading-[18px] md:leading-[24px] font-normal">{{ $question['options']['option_b'] }}</p>
                                    </div>
                                </div>
                                <div class="flex w-full flex-row items-center justify-center gap-[20px]">
                                    <div class="w-full flex flex-row items-center justify-between gap-[10px]">
                                        <div
                                            class="w-[50px] h-[50px] bg-[#F2F2F2] rounded-[10px] flex items-center justify-center">
                                            <p class="text-[#9E9E9E] text-[12px] md:text-[14px] leading-[18px] md:leading-[24px] font-normal">
                                                C</p>
                                        </div>
                                        <p class="text-[#9E9E9E] max-w-[200px] truncate text-[12px] md:text-[14px] leading-[18px] md:leading-[24px] font-normal">{{ $question['options']['option_c'] }}</p>
                                    </div>
                                    <div class="w-full flex flex-row items-center justify-between gap-[10px]">
                                        <div
                                            class="w-[50px] h-[50px] bg-[#F2F2F2] rounded-[10px] flex items-center justify-center">
                                            <p class="text-[#9E9E9E] text-[12px] md:text-[14px] leading-[18px] md:leading-[24px] font-normal">
                                                D</p>
                                        </div>
                                        <p class="text-[#9E9E9E] max-w-[200px] truncate text-[12px] md:text-[14px] leading-[18px] md:leading-[24px] font-normal">{{ $question['options']['option_d'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @if(count($questions) !== $number_of_question_allowed)
                        <x-button
                            class="mt-[16px] select-none rounded-lg bg-primary w-full max-w-[250px] py-3.5 px-5 text-center align-middle font-poppins text-sm font-bold uppercase text-white shadow-md leading-snug shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                            label="+ Add next question >" wire:click="add_question = true"
                        />
                    @endif
                </div>
            </template>
            @if(count($questions) > 0)
                <x-button
                    class="mt-[16px] mx-auto select-none rounded-lg bg-primary w-full max-w-[250px] py-3.5 px-5 text-center align-middle font-poppins text-sm font-bold uppercase text-white shadow-md leading-snug shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                    disabled="{{ count($questions) !== $number_of_question_allowed }}"
                    label="Submit Assessment" wire:click="createAssessment"
                    spinner="createAssessment"/>
            @endif
        </div>
    </template>
</div>
