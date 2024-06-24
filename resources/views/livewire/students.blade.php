<div class="w-full flex flex-col items-center justify-start gap-[33px] pt-[50px] px-[10px] xl:pl-0">
    <div class="max-w-[692px] w-full lg:pl-[20px]">
        <x-ui.wlecome/>
    </div>
    <div
        class="w-full max-w-[692px] max-h-[80dvh] overflow-y-scroll scroll-smooth py-[31px] flex flex-col items-center justify-start gap-[25px] bg-white rounded-[10px] px-[21px] xl:px-[45px]">

        <div class="w-full max-w-[518px] self-start justify-between flex flex-row items-center  mb-[9px] flex-wrap">
            <h1 class="font-poppins font-semibold text-text-1 text-[16px] md:text-[18px] lg:text-[22px]">
                Students({{ count($students) }})</h1>
            @if (auth()->user()->role == 'admin')
                <x-modal wire:model="createStudent" class="backdrop-blur">
                    <div class="mb-5 flex w-full flex-col items-center justify-start gap-4">
                        <h1
                            class="font-poppins font-semibold text-text-1 text-[16px] md:text-[18px] lg:text-[22px] self-start">
                            Add New Student</h1>
                        <livewire:create-student/>
                    </div>
                </x-modal>
                <x-button
                    class="rounded-[10px] px-[15px] bg-primary py-[12px] text-white font-medium text-[12px] self-end"
                    label="Add New Student" @click="$wire.createStudent = true"/>
            @endif
        </div>
        <div class="flex w-full flex-row flex-wrap justify-between items-start gap-[30px]">
            @foreach ($students as $student)
                <div wire:key="{{ $student->id }}" class="flex flex-row items-center justify-start gap-4">
                    <div class="flex flex-row items-center justify-start gap-4">
                        <div class="w-[43px] h-[43px] lg:w-[67px] lg:h-[67px] bg-[#F3E4FF] rounded-full">
                            <img src="{{ $student->profile_photo_url }}" alt="profile image"
                                 class="w-full h-full object-cover rounded-full">
                        </div>
                        <div class="flex flex-col items-start justify-start">
                            <h1 class="font-poppins font-semibold text-text-1 text-[12px] w-[150px] truncate">
                                {{ $student->first_name . ' ' . $student->last_name }}</h1>
                            <p class="font-poppins font-normal text-text-2 text-[12px] truncate w-full md:w-[250px] lg:w-[200px]">
                                {{ $student->email }}
                            </p>
                            {{--                        <p @click="$wire.viewStudent = true"--}}
                            {{--                           class="text-[14px] font-semibold leading-5 text-primary cursor-pointer">--}}
                            {{--                            View ></p>--}}
                            @if(auth()->user()->role === 'admin')
                                <form class="hidden" method="POST" id="assForm"
                                      action="{{ route('students.show', ['id'=>$student->id]) }}">
                                    @csrf
                                    @method('GET')
                                </form>
                                <button
                                    type="submit" form="assForm" id="assForm"
                                    class="text-[14px] hidden lg:block font-semibold leading-5 text-primary cursor-pointer"
                                >
                                    View >
                                </button>
                            @endif
                        </div>
                    </div>
                    @if(auth()->user()->role === 'admin')
                        <form class="hidden" method="POST" id="assdForm"
                              action="{{ route('students.show', ['id'=>$student->id]) }}">
                            @csrf
                            @method('GET')
                        </form>
                        <button
                            type="submit" form="assdForm" id="assdForm"
                            class="text-[14px] font-semibold leading-5 text-primary cursor-pointer"
                        >
                            View >
                        </button>
                    @endif
                    {{--                    <x-modal wire:model="viewStudent" class="backdrop-blur">--}}
                    {{--                        <div class="mb-5 flex w-full flex-col items-center justify-start gap-4">--}}
                    {{--                            <livewire:view-profiles type="viewStudent" title="Student" :studentId="$student->id"/>--}}
                    {{--                        </div>--}}
                    {{--                    </x-modal>--}}
                </div>
            @endforeach
        </div>
    </div>
</div>
