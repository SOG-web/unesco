<div class="w-full flex flex-col items-center justify-start gap-[33px] pt-[50px] px-[10px] xl:pl-0">
    <div class="max-w-[692px] w-full lg:pl-[20px]">
        <x-ui.wlecome/>
    </div>
    <div
        class="w-full max-w-[692px] max-h-[80dvh] overflow-y-scroll scroll-smooth py-[31px] flex flex-col items-center justify-start gap-[25px] bg-white rounded-[10px] px-[21px] xl:px-[45px]">

        <div class="w-full max-w-[518px] self-start justify-between flex flex-row items-center  mb-[9px] flex-wrap">
            <h1 class="font-poppins font-semibold text-text-1 text-[16px] md:text-[18px] lg:text-[22px]">
                Notices </h1>
            @if (auth()->user()->role == 'admin')
                <x-modal wire:model="createStudent" class="backdrop-blur">
                    <div class="mb-5 flex w-full flex-col items-center justify-start gap-4">
                        <h1
                            class="font-poppins font-semibold text-text-1 text-[16px] md:text-[18px] lg:text-[22px] self-start">
                            Add New Notice</h1>
                        <livewire:create-notice/>
                    </div>
                </x-modal>
                <x-button
                    class="rounded-[10px] px-[15px] bg-primary py-[12px] text-white font-medium text-[12px] self-end"
                    label="Add New Student" @click="$wire.createNotice = true"/>
            @endif
        </div>
    </div>
</div>
