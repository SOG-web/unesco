<div class="w-full flex flex-col items-center justify-start gap-[33px] pt-[50px] px-[10px] xl:pl-0">
    <div class="max-w-[692px] w-full lg:pl-[20px]">
        <x-ui.wlecome/>
    </div>
    <x-sections.course-board :courses="$courses"/>
    @if(auth()->user()->role === 'admin')
        <x-sections.view2-board :teachers="$teachers" :students="$students"/>
    @elseif(auth()->user()->role === 'teacher')
        <x-sections.view2-board title1="Assessment" :teachers="$teachers" :assessments="$assessments"
                                :students="$students"/>
    @else
        <x-sections.view2-board title2="Grades" title1="Assessments" :assessments="$assessments" :teachers="$teachers"
                                :grades="$grades"/>
    @endif
</div>
