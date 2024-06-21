<x-auth-layout>
    <div class="w-full flex flex-col items-center justify-start gap-[33px] pt-[50px] px-[10px] xl:pl-0">
        <div class="max-w-[692px] w-full lg:pl-[20px]">
            <x-ui.wlecome/>
        </div>
        <livewire:theory-assessment :assessment="$assessment" :student="$student"/>
    </div>
</x-auth-layout>
