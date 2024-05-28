<x-auth-layout>
    <div class="w-full flex flex-col items-center justify-start gap-[33px] pt-[50px] px-[10px] xl:pl-0">
        <div class="max-w-[692px] w-full lg:pl-[20px]" >
            <x-ui.wlecome />
        </div>
        <x-sections.course-board :courses="$courses" :view="true"/>
    </div>
</x-auth-layout>

