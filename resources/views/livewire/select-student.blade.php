<div class="w-full md:w-[650px] flex flex-col justify-center items-center bg-white">
    <div
        class="py-[31px] w-full md:w-[650px] max-h-[70dvh] overflow-y-scroll flex flex-row flex-wrap items-center justify-center gap-[30px] bg-white rounded-[10px] px-[21px]">
        <div class="w-full flex flex-wrap flex-row items-center justify-between py-[30px]">
            <h1
                class="font-semibold text-[16px] md:text-[18px]
                text-left text-text-1 lg:text-[22px] leading-[28px] lg:leading-[33px]">
                Select students to assign</h1>
            {{--            search box --}}
            <div
                class="w-[217px] h-[41px] rounded-[10px] flex flex-row items-center justify-start gap-2 px-[10px] border-[2px] border-gray-4">
                <svg class="w-[15px] h-[15px] text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                        d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                </svg>
                <input wire:model.live="search" wire:keydown.enter="$wire.filterStudents()" name="search"
                    type="text" placeholder="Search students"
                    class="rounded-[9px] w-full h-full border-none focus:border-none active:border-none
                    outline-none text-text-2 font-normal text-[12px]">
            </div>
        </div>
        @foreach ($filteredStudents as $student)
            <div wire:key="{{ $student->id }}" class="flex flex-row items-center justify-start gap-4">
                <input type="checkbox" name="{{ $student->id }}"
                    wire:change.prevent="addOrRemoveStudent({{ $student->id }})"
                    class="before:content[''] peer relative h-5 w-5 cursor-pointer appearance-none rounded-md border border-blue-gray-200 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-blue-gray-500 before:opacity-0 before:transition-opacity checked:border-gray-900 checked:bg-gray-900 checked:before:bg-gray-900 hover:before:opacity-10"
                    id="{{ $student->id }}" {{ in_array($student->id, $selectedStudents) ? 'checked' : '' }} />
                <div class="w-[43px] h-[43px] bg-[#F3E4FF] rounded-full">
                    <img src="{{ $student->profile_photo_url }}" alt="profile image"
                        class="w-full h-full object-cover rounded-full">
                </div>
                <div class="flex flex-col items-start justify-start">
                    <h1 class="font-poppins font-semibold text-text-1 text-[12px] w-[150px] truncate">
                        {{ $student->first_name . ' ' . $student->last_name }}</h1>
                    <p class="font-poppins font-normal text-text-2 text-[12px] truncate w-[150px]">{{ $student->email }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
    <button wire:click="save"
        class="rounded-[10px] px-[15px] bg-primary py-[12px] text-white font-medium text-[12px] mb-[20px]">
        {{ $loading ? 'Saving...' : 'Assign students' }}
    </button>
</div>
