<div class="w-full flex flex-col items-center justify-start gap-[33px] pt-[50px] px-[10px] xl:pl-0">
    <div class="max-w-[692px] w-full lg:pl-[20px]">
        <x-ui.wlecome/>
    </div>
    <div
        class="w-full max-w-[692px] max-h-[80dvh] overflow-y-scroll scroll-smooth py-[31px] flex flex-col items-center justify-start gap-[25px] bg-white rounded-[10px] px-[21px] xl:px-[45px]">

        <div class="w-full max-w-[518px] self-start justify-between flex flex-row items-center  mb-[9px] flex-wrap">
            <h1 class="font-poppins font-semibold text-text-1 text-[16px] md:text-[18px] lg:text-[22px]">
                Notices </h1>
            @if (auth()->user()->role !== 'students')
                <x-modal wire:model="createNotice" class="backdrop-blur">
                    <div class="mb-5 flex w-full flex-col items-center justify-start gap-4">
                        <h1
                            class="font-poppins font-semibold text-text-1 text-[16px] md:text-[18px] lg:text-[22px] self-start">
                            Add New Notice</h1>
                        <livewire:create-notice/>
                    </div>
                </x-modal>
                <x-button
                    class="rounded-[10px] px-[25px] bg-primary py-[12px] text-white font-medium text-[12px] self-end"
                    label="+ Add New Notice" @click="$wire.createNotice = true"/>
            @endif
        </div>
        <x-custom-tabs label-class="font-semibold text-[14px] text-[#9E9E9E]"
                       label-div-class="flex overflow-x-auto w-full"
                       active-class='bg-[#DAD9F5] rounded-[6px] !text-[#605C9D]'
                       wire:model="selectedTab"
                       class="!border-none w-full mt-[30px]">
            <x-tab id="all-tab" name="all-tab" label="All" class="!border-none">
                <div class="w-full flex flex-col items-start justify-start gap-4 !border-none">
                    @foreach($notices as $notice)
                        <div class="w-full cursor-pointer" wire:click="markAsRead({{ $notice->id }})">
                            <livewire:notice-card :notice="$notice"/>
                        </div>
                    @endforeach
                </div>
            </x-tab>
            <x-tab id="read" name="read" label="Read">
                <div class="w-full flex flex-col items-start justify-start gap-4">
                    @foreach($readNotices as $readNotice)
                        <livewire:notice-card :notice="$readNotice"/>
                    @endforeach
                </div>
            </x-tab>
            <x-tab id="unread" name="unread">
                <x-slot:label>
                    Unread
                    <x-badge value="{{ count($unreadNotices) }}" class="badge-error text-white"/>
                </x-slot:label>
                <div class="w-full flex flex-col items-start justify-start gap-4">
                    @foreach($unreadNotices as $unreadNotice)
                        <div class="w-full cursor-pointer" wire:click="markAsRead({{ $unreadNotice->id }})">
                            <livewire:notice-card :notice="$unreadNotice"/>
                        </div>
                    @endforeach
                </div>
            </x-tab>
        </x-custom-tabs>

    </div>
</div>
